<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function index(){
        return view('teste');
    }

    public function getData(){
        $data = "ndsjfsj";

        return view('data', compact('data'));
    }
}
