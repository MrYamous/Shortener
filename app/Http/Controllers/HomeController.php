<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class HomeController extends Controller
{

public function index()
    {
        return view('links.home');
    }
}
