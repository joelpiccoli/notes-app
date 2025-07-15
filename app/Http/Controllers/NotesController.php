<?php

namespace App\Http\Controllers;

use App\Models\Note;
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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|array',
        ]);
        $request->user()->notes()->create([
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
        ]);

        return redirect()->route('dashboard');
    }

    public function show(Note $note)
    {
        return Inertia::render('notes/ShowNote', [
            'note' => $note,
        ]);
    }

    public function edit(Note $note)
    {
        return Inertia::render('notes/EditNote', [
            'note' => $note,
        ]);
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|array',
        ]);

        $note->update([
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
        ]);
    }
}
