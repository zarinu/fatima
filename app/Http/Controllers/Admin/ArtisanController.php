<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function index($param): string
    {
        if($param === 'migrate') {
            Artisan::call('migrate');
            return 'done';
        } else if($param === 'key') {
            Artisan::call('key:generate');
            return 'done';
        } else if($param === 'clear') {
            Artisan::call('cache:clear');
            return 'done';
        } else if($param === 'config') {
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            return 'done';
        } else {
            return 'invalid php artisan command';
        }
    }
}