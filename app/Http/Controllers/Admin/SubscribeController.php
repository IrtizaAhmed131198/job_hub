<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscribe;
use Yajra\DataTables\DataTables;

class SubscribeController extends Controller
{
    public function getSubscribe(Request $request)
    {
        if ($request->ajax()) {
            $data = Subscribe::all();

            return DataTables::of($data)
                ->addColumn('id', function ($row) {
                    // Add row counter
                    static $counter = 0;
                    $counter++;
                    return $counter;
                })
                ->addColumn('action', function ($row) {
                    // Add any custom action buttons here
                    $deleteButton = '<button class="btn btn-danger delete-user" data-id="' . $row->id . '" data-model="subscribe" data-toggle="modal" data-target="#deleteUserModal">Delete</button>';

                    return '<div class="d-flex">'.$deleteButton.'</div>';
                })
                ->rawColumns(['id','action'])
                ->make(true);
        }

        return view('admin.subscribe.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subscribe.index', ['title' => 'List Subscribe User']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('id');
            $subscribe = Subscribe::find($id);

            if ($subscribe) {
                $subscribe->delete();
                return response()->json(['message' => 'Subscribe User deleted successfully']);
            } else {
                return response()->json(['message' => 'Subscribe User not found'], 404);
            }
        }
    }
}
