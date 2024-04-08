<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Redirect;
use Log;

class StudentController extends Controller
{
    //
    public function create(){
        return Inertia::render('Create');
    }

    public function index(){
        
        Log::info('Index method started.');
        $students = Student::all()->map(function ($student) {
            return [
                'id'=> $student->id,
                'name'=> $student->name,
                'age'=> $student->age,
                'status'=> $student->status,
                'image'=> asset('storage/'.$student->image)
            ];
         });
        return Inertia::render('dashboard', [
             'students' => $students
        ]);

        
    }

    public function store(){
        $image = Request::file('image')->store('student','public');
        Student::create([
            'name' =>Request::input('name'),
            'age' => Request::input('age'),
            'status' => Request::input('status'),
            'image' => $image

        ]);

        return Redirect::route('dashboard');
        
    }
}
