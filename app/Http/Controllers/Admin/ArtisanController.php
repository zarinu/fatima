<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function index($param): string
    {
        if($param == 'migrate') {
            Artisan::call($param);
            return 'done';
        } else {
            return 'invalid php artisan command';
        }
    }
}