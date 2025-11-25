<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Student::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);
        $student = Student::create($validated);
        return response()->json([
            'status' => 'success',
            'data' => $student
        ], 201);
    }

    public function show(Student $student)
    {
        return response()->json([
            'status' => 'success',
            'data' => $student
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
        ]);
        $student->update($validated);
        return response()->json([
            'status' => 'success',
            'data' => $student
        ]);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Student deleted.'
        ]);
    }
}
