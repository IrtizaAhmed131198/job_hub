<?php

while (true) {
    shell_exec('php artisan job:check-applications');
    sleep(1); // wait for 1 second
}
