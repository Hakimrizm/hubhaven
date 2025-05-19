<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function welcome() {
        return view('welcome', [
            'places' => Place::latest()->take(6)->get()
        ]);
    }
}
