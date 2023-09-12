<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        return view('pages.students.index', compact('students'));
    }

    public function create()
    {
        return view('pages.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:3",
            "gender" => "required",
            "age" => "required|numeric",
            "address" => "required",
            "images" => "required|image"
        ]);

        // dd($request->all());

        DB::beginTransaction();
        try {
            $student = new Student;
            $student->student_name = $request->name;
            $student->gender = $request->gender;
            $student->age = $request->age;
            $student->address = $request->address;
            $student->images = $request->file('images')->store('images');
            $student->save();
            DB::commit();
            return redirect()->route('student.index');
        } catch (\Exception $ex) {
            //throw $th;
            DB::rollBack();
            echo $ex->getMessage();
        }
    }

    public function destroy($id)
    {
        Student::where('id', $id)->delete();

        return redirect()->route('student.index');
    }
}
