<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index()
    {
        $organizers = Organizer::all();
        return view('organizers.index', compact('organizers'));
    }

    public function create()
    {
        return view('organizers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:organizers,email',
            'phone' => 'nullable|string|max:20',
        ]);

        Organizer::create($request->all());

        return redirect()->route('organizers.index')->with('success', 'Організатор доданий.');
    }

    public function edit(Organizer $organizer)
    {
        return view('organizers.edit', compact('organizer'));
    }

    public function update(Request $request, Organizer $organizer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:organizers,email,{$organizer->id}",
            'phone' => 'nullable|string|max:20',
        ]);

        $organizer->update($request->all());

        return redirect()->route('organizers.index')->with('success', 'Організатор оновлений.');
    }

    public function destroy(Organizer $organizer)
    {
        $organizer->delete();

        return redirect()->route('organizers.index')->with('success', 'Організатор видалений.');
    }
}