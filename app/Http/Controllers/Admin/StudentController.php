<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Package;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::with(['program', 'package'])->latest()->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    public function create(): View
    {
        $programs = Program::where('is_active', true)->orderBy('urutan')->get();
        $packages = Package::where('is_active', true)->latest()->get();

        return view('admin.students.create', compact('programs', 'packages'));
    }

    public function store(StudentRequest $request): RedirectResponse
    {
        Student::create($request->validated());

        return redirect()->route('admin.students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Student $student): View
    {
        $programs = Program::where('is_active', true)->orderBy('urutan')->get();
        $packages = Package::where('is_active', true)->latest()->get();

        return view('admin.students.edit', compact('student', 'programs', 'packages'));
    }

    public function update(StudentRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->validated());

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}