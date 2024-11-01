<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

class GenerateCrud extends Command
{
    protected $signature = 'make:crud {model} {--fields=*}';
    protected $description = 'Generate CRUD for a given model with specified fields';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $model = $this->argument('model');
        $fields = $this->option('fields');
        // $table = Str::snake($model) . 's';
        // $this->addColumnsToMigration($table, $fields);
        // exit;

        $this->info("Generating CRUD for model: $model");

        // Check if the model file exists
        $modelPath = app_path("Models/{$model}.php");

        if (!file_exists($modelPath)) {
            // Generate Model
            Artisan::call('make:model', ['name' => $model]);
            $this->customizeModel($model, $fields);
        } else {
            $this->info("Model {$model} already exists, skipping model generation.");
        }

        // Check if the controller file exists
        $controllerPath = app_path("Http/Controllers/{$model}Controller.php");

        if (!file_exists($controllerPath)) {
            // Generate Controller
            $this->generateController($model, $fields);
        } else {
            $this->info("Controller {$model}Controller already exists, skipping controller generation.");
        }

        // Check if the migration file exists
        $table = Str::snake($model) . 's';
        $migrationName = "create_{$table}_table";
        $migrationPath = base_path("database/migrations/*_{$migrationName}.php");

        if (count(glob($migrationPath)) === 0) {
            // Generate Migration
            Artisan::call('make:migration', ['name' => $migrationName]);
            $this->addColumnsToMigration($table, $fields);
            Artisan::call('migrate');
        } else {
            $this->info("Migration for {$table} already exists, skipping migration generation.");
        }

        // Generate Views
        $this->generateView($model, $fields);

        $this->info('CRUD files generated successfully!');
    }

    protected function addColumnsToMigration($table, $fields)
    {
        $migrationPath = database_path('migrations');
        $migrationFiles = File::files($migrationPath);

        // Get the latest migration file (assuming it was just created)
        $latestMigrationFile = collect($migrationFiles)->last();

        if ($latestMigrationFile) {
            $content = File::get($latestMigrationFile);

            // Generate the schema fields based on the provided options
            $fieldsArray = explode(',', implode('', $fields));
            $columns = '';
            foreach ($fieldsArray as $field) {
                [$name, $type] = explode(':', $field);

                if ($type === 'file') {
                    $type = 'string'; // Use 'string' to store file paths
                }

                $columns .= "\$table->$type('$name');\n";
            }

            // Insert the columns into the migration file
            $content = str_replace(
                '$table->id();',
                '$table->id();' . "\n" . $columns,
                $content
            );

            File::put($latestMigrationFile, $content);

            $this->info("Columns added to the migration: " . $latestMigrationFile->getFilename());
        } else {
            $this->error('No migration file found.');
        }
    }

    private function formatString($string) {
        $string = str_replace('_', ' ', $string);
        $string = ucwords($string);
        return $string;
    }

    protected function generateView($modelName)
    {
        $modelCamelCase = Str::camel($modelName);
        $modelSnakeCase = Str::snake($modelName);
        $title = ucfirst($modelName);

        $table = Str::snake(Str::plural($modelName));

        // Retrieve the table's columns
        $columns = Schema::getColumnListing($table);

        $fields = [];
        foreach ($columns as $column) {
            $fields[] = [
                'name' => $column,
                'type' => $this->getFieldType($table, $column),
            ];
        }

        $viewFiles = [
            // 'index' => resource_path("stubs/index.blade.stub"),
            // 'create' => resource_path("stubs/create.blade.stub"),
            'edit' => resource_path("stubs/edit.blade.stub"),
        ];

        foreach ($viewFiles as $viewName => $stubPath) {
            $destinationPath = resource_path("views/admin/{$modelSnakeCase}/{$viewName}.blade.php");
            $this->createDirectoryIfNotExists($destinationPath);

            $stubContent = file_get_contents($stubPath);

            if ($viewName === 'index') {
                // Ensure that 'id', 'created_at', and 'action' columns are always included
                // $requiredColumns = ['id', 'created_at'];
                $counter = 0;
                $maxIterations = 3;
                $fieldsArr = [];

                foreach ($fields as $field) {
                    if ($counter >= $maxIterations) {
                        break;
                    }
                    // if (!in_array($requiredColumn, array_column($fields, 'name'))) {
                        $fieldsArr[] = ['name' => $field['name'], 'type' => ucwords(str_replace('_', ' ', $field['name']))];
                    // }
                    $counter++;
                }

                // Always add 'action' column at the end
                $fieldsArr[] = ['name' => 'action', 'label' => 'Action', 'orderable' => false, 'searchable' => false];

                // Generate the column definitions for the DataTable
                $columnsPlaceholder = '';
                $columnsTable = '';
                foreach ($fieldsArr as $field) {
                    if ($field['name'] == 'action') {
                        $columnsPlaceholder .= "    { data: 'action', name: 'action', orderable: false, searchable: false },\n";
                    } else {
                        $columnsPlaceholder .= "    { data: '{$field['name']}', name: '{$field['name']}' },\n";
                    }

                    $columnsTable .= '
                        <td>'. $this->formatString($field['name']) .'</td>
                    ';

                }

                // Replace the {{columns}} placeholder in the stub with the actual column definitions
                $stubContent = str_replace(
                    ['{{columns}}', '{{columnsTable}}', '{{modelSnakeCase}}', '{{modelCamelCase}}'],
                    [$columnsPlaceholder, $columnsTable, $modelSnakeCase, $modelName],
                    $stubContent
                );
            }

            if ($viewName == 'create' || $viewName == 'edit') {
                // Generate the form fields HTML
                $formFields = '';
                foreach ($fields as $field) {
                    $type = $field['type'] ?? 'text';
                    $label = ucfirst($field['name']);
                    $placeholder = "Enter {$label}";

                    $value = ($viewName == 'edit') ? "{{ \$data->{$field['name']} ?? '' }}" : '';

                    if($field['name'] != 'created_at' && $field['name'] != 'updated_at'){
                        if ($type === 'textarea') {
                            $formFields .= "<div class=\"form-group col-md-12\">
                                <label for=\"{$field['name']}\">{$label}</label>
                                <textarea name=\"{$field['name']}\" class=\"form-control\" id=\"{$field['name']}\" rows=\"5\" placeholder=\"{$placeholder}\">{$value}</textarea>
                            </div>";
                        } elseif ($type === 'file') {
                            if ($viewName == 'edit') {
                                $formFields .= "<div class=\"form-group col-md-6\">
                                    <label for=\"{$field['name']}\">{$label}</label>
                                    <input type=\"file\" name=\"{$field['name']}\" class=\"form-control\" id=\"{$field['name']}\">
                                    @if (\$data->{$field['name']})
                                        <input type='hidden' name='hidden_{$field['name']}' value=\"{{ \$data->{$field['name']} }}\">
                                        <div class=\"mt-2\">
                                            <img src=\"{{ asset(\$data->{$field['name']}) }}\" alt=\"Image\" width=\"100\">
                                        </div>
                                    @endif
                                </div>";
                            } else {
                                $formFields .= "<div class=\"form-group col-md-6\">
                                    <label for=\"{$field['name']}\">{$label}</label>
                                    <input type=\"file\" name=\"{$field['name']}\" class=\"form-control\" id=\"{$field['name']}\">
                                </div>";
                            }
                        } else {
                            $formFields .= "<div class=\"form-group col-md-6\">
                                <label for=\"{$field['name']}\">{$label}</label>
                                <input type=\"{$type}\" name=\"{$field['name']}\" class=\"form-control\" id=\"{$field['name']}\" placeholder=\"{$placeholder}\" value=\"{$value}\">
                            </div>";
                        }
                    }

                }

                // Replace the {{formFields}} placeholder in the stub with the actual form fields
                $stubContent = str_replace('{{formFields}}', $formFields, $stubContent);
            }

            // Replace other placeholders with actual values
            $stubContent = str_replace(
                ['{{modelCamelCase}}', '{{modelSnakeCase}}', '{{modelName}}', '{{title}}'],
                [$modelCamelCase, $modelSnakeCase, $modelName, 'Posts'],
                $stubContent
            );
            var_dump($stubContent);

            file_put_contents($destinationPath, $stubContent);
        }
    }

    protected function getFieldType($table, $column)
    {
        $type = Schema::getColumnType($table, $column);

        // Map the database column types to HTML input types
        $fieldTypeMap = [
            'string' => 'text',
            'text' => 'textarea',
            'integer' => 'number',
            'boolean' => 'checkbox',
            'date' => 'date',
            'datetime' => 'datetime-local',
            'timestamp' => 'datetime-local',
        ];

        return $fieldTypeMap[$type] ?? 'text';
    }

    protected function createDirectoryIfNotExists($filePath)
    {
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    protected function generateController($model, $fields)
    {
        $modelName = Str::studly($model);
        $modelSnakeCase = Str::snake($model);

        // Define paths for stub and destination controller file
        $stubPath = resource_path('stubs/ControllerTemplate.stub');
        $destinationPath = app_path("Http/Controllers/Admin/{$modelName}Controller.php");

        // Get stub content
        $stubContent = file_get_contents($stubPath);

        // Get the fields for the model
        // $fields = $this->getFieldsForModel($model);
        $fieldsArray = explode(',', implode('', $fields));
        // Generate validation rules dynamically
        $validationRules = '';
        foreach ($fieldsArray as $field) {
            $fieldName = explode(':', $field)[0];
            $fieldType = explode(':', $field)[1];
            if ($fieldType == 'file') {
                $validationRules .= "        '{$fieldName}' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',\n";
            } else {
                $validationRules .= "        '{$fieldName}' => 'required|{$fieldType}',\n";
            }
        }

        // Handle file upload and image logic in the stub content
        $fileUploadLogicForStore = '';
        $fileUploadLogicForUpdate = '';
        $indexImage = '';
        $indexImageName = '';
        foreach ($fieldsArray as $field) {
            $fieldName = explode(':', $field)[0];
            $fieldType = explode(':', $field)[1];
            if ($fieldType == 'file') {
                $fileUploadLogicForStore .= <<<EOD

            // Handle file upload for '{$fieldName}'
            if (\$request->hasFile('{$fieldName}')) {
                \$file = \$request->file('{$fieldName}');
                \$fileName = time() . '.' . \$file->getClientOriginalExtension();
                \$file->move(public_path('assets/{$modelSnakeCase}_images'), \$fileName);
                \$data['{$fieldName}'] = 'assets/{$modelSnakeCase}_images/' . \$fileName;
            }
            EOD;

                $fileUploadLogicForUpdate .= <<<EOD

            // Handle file update for '{$fieldName}'
            if (\$request->hasFile('{$fieldName}')) {
                // Delete the old file if it exists
                if (!empty(\$data->{$fieldName})) {
                    File::delete(public_path(\$data->{$fieldName}));
                }

                \$file = \$request->file('{$fieldName}');
                \$fileName = time() . '.' . \$file->getClientOriginalExtension();
                \$file->move(public_path('assets/{$modelSnakeCase}_images'), \$fileName);
                \$data->{$fieldName} = 'assets/{$modelSnakeCase}_images/' . \$fileName;
            } elseif (\$request->has('hidden_' . '{$fieldName}')) {
                // Use the existing file if not updated
                \$data->{$fieldName} = \$request->input('hidden_' . '{$fieldName}');
            }
            EOD;

            $indexImage .= <<<EOD
            ->addColumn('{$fieldName}', function (\$row) {
                    // Add any custom action buttons here
                    \$imageUrl = \$row->image_link;
                    return \$imageUrl ? '<img src="'.\$imageUrl.'" style="height: 50px; width: auto;">' : 'No Image';
                })
            EOD;

            $indexImageName .= $fieldName;
            }
        }

        // Handle file deletion logic
        $fileDeletionLogic = '';
        foreach ($fieldsArray as $field) {
            $fieldName = explode(':', $field)[0];
            $fieldType = explode(':', $field)[1];
            if ($fieldType == 'file') {
                $fileDeletionLogic .= <<<EOD

            // Delete file if necessary for '{$fieldName}'
            if (!empty(\$data->{$fieldName})) {
                File::delete(public_path(\$data->{$fieldName}));
            }
            EOD;
            }
        }


        // Replace placeholders in stub content with actual values
        $stubContent = str_replace(
            ['{{ModelName}}', '{{modelSnakeCase}}', '{{validationRules}}', '{{fileUploadLogicForStore}}', '{{fileUploadLogicForUpdate}}', '{{fileDeletionLogic}}', '{{indexImage}}', '{{indexImageName}}'],
            [$modelName, $modelSnakeCase, rtrim($validationRules), $fileUploadLogicForStore, $fileUploadLogicForUpdate, $fileDeletionLogic, $indexImage, $indexImageName],
            $stubContent
        );

        // Write the updated content to the destination path
        file_put_contents($destinationPath, $stubContent);

        $this->info("Custom controller for {$modelName} created successfully!");
    }



    protected function getFieldsForModel($model)
    {
        // Example implementation: Adjust this method to fetch fields for your model
        // This could involve introspection, configuration, or other methods
        $modelName = Str::studly($model);
        $fields = [];

        // Fetch fields from the model or configuration (example implementation)
        $modelInstance = app("App\\Models\\{$modelName}");
        $fillable = $modelInstance->getFillable();

        foreach ($fillable as $field) {
            $fields[] = [
                'name' => $field,
                'type' => 'string' // Default type; adjust as needed based on your model's fields
            ];
        }

        return $fields;
    }

    protected function customizeModel($model, $fields)
    {
        // Define the table name
        $tableName = Str::snake($model) . 's'; // Default table name

        // Path to the generated model
        $modelPath = app_path("Models/{$model}.php");

        // Check if the model file exists
        if (File::exists($modelPath)) {
            $modelContent = File::get($modelPath);

            // Add the custom table name
            $tableProperty = "\n    protected \$table = '{$tableName}';\n";

            // Add the fillable fields
            // var_dump($fields);exit;
            $fieldsArray = explode(',', implode('', $fields));
            $fillableProperty = "\n    protected \$fillable = [\n";
            foreach ($fieldsArray as $field) {
                $fieldName = explode(':', $field)[0];
                $fillableProperty .= "        '{$fieldName}',\n";
            }
            $fillableProperty .= "    ];\n";

            // Insert the properties into the model class
            $modelContent = str_replace(
                "use HasFactory;\n",
                "use HasFactory;{$tableProperty}{$fillableProperty}\n",
                $modelContent
            );

            // Save the modified content back to the model file
            File::put($modelPath, $modelContent);

            $this->info("Custom model for {$model} created successfully with table name and fillable fields!");
        } else {
            $this->error("Model file for {$model} not found.");
        }
    }

}
