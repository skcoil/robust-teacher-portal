<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'marks' => 'required|numeric|between:0,100',
        ]);

        // Check if a record with the same name and subject exists but with different marks
        $existingRecord = Student::where('name', $request->name)
                                 ->where('subject', $request->subject)
                                 ->first();

        if ($existingRecord) {
            if ($existingRecord->marks != $request->marks) {
                return back()->withErrors([
                    'duplicate' => 'You cannot enter different marks for the same student and subject. Please use the edit button to update the existing record.'
                ])->withInput();
            }
        }

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'marks' => 'required|numeric|between:0,100',
        ]);

        $student = Student::findOrFail($id);

        // Check for duplicate entry except the current student being updated
        $duplicate = Student::where('name', $request->name)
                            ->where('subject', $request->subject)
                            ->where('marks', $request->marks)
                            ->where('id', '!=', $student->id)
                            ->exists();

        if ($duplicate) {
            return back()->withErrors([
                'duplicate' => 'Duplicate entry: The combination of name, subject, and marks already exists.'
            ])->withInput();
        }

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
