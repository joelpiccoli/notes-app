<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class NotesController extends Controller
{
    public function create()
    {
        return Inertia::render('notes/CreateNote');
    }

    public function store(Request $request)
    {
        $request->user()->notes()->create($request->all());

        return redirect()->route('dashboard');
    }
}
