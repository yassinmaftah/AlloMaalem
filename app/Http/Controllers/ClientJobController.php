<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientJobController extends Controller
{
    public function index()
    {
        return view('client.jobs.index');
    }

    public function create()
    {
        return view('client.jobs.create');
    }

    public function show($id)
    {
        return view('client.jobs.show');
    }
}
