<?php

namespace App\Http\Controllers;

use App\Models\Monografia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $monografias = Monografia::get();

        return view('home', compact(['monografias']));
    }
}
