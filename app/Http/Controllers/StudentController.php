<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show all students
    public function index()
    {
        $students = Student::with('section')->get();
        return view('students.index', compact('students'));
    }

    // Show form to create a student
    public function create()
    {
        $sections = Section::all();
        return view('students.create', compact('sections'));
    }

    // Save new student
    public function store(Request $request)
    {
        $request->validate([
            'studentNumber' => 'required|string|max:9|unique:students,studentNumber',
            'name'          => 'required|string|max:150',
            'email'         => 'required|email|max:150|unique:students,email',
            'contactNumber' => 'required|string|max:20',
            'year'          => 'required|integer|in:1,2,3,4',
            'section_id'    => 'required|exists:sections,id',
        ]);

        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    // Show form to edit a student
    public function edit(Student $student)
    {
        $sections = Section::all();
        return view('students.edit', compact('student', 'sections'));
    }

    // Update student
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'studentNumber' => 'required|string|max:9|unique:students,studentNumber,' . $student->id,
            'name'          => 'required|string|max:150',
            'email'         => 'required|email|max:150|unique:students,email,' . $student->id,
            'contactNumber' => 'required|string|max:20',
            'year'          => 'required|integer|in:1,2,3,4',
            'section_id'    => 'required|exists:sections,id',
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // Delete student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}