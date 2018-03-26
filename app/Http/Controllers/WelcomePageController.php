<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Discussion;

class WelcomePageController extends Controller
{
    public function index()
    {
        $discussions=Discussion::latest()->paginate(10);
        return view('welcome', compact('discussions'));
    }
}
