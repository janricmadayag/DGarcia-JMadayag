<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('sections.index', compact('sections'));
    }

    public function create()
    {
        return view('sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course' => 'required|string|max:255',
            'section' => 'required|string|max:10',
        ]);

        Section::create($request->only(['course','section']));

        return redirect()->route('sections.index')
                         ->with('success', 'Section added successfully.');
    }

    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'course' => 'required|string|max:255',
            'section' => 'required|string|max:10',
        ]);

        $section->update($request->only(['course','section']));

        return redirect()->route('sections.index')
                         ->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')
                         ->with('success', 'Section deleted successfully.');
    }
}
