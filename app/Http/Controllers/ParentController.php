<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User;
use App\Student;
use App\Season;
use App\StudentSummary;
use App\Result;
use App\ClassTable;
use App\StudentDetail;
use Auth;
use PDF;

class ParentController extends Controller
{
    //
    public function dashboard() {
        // return "hi";
        $children = Student::where('parent_name', Auth::user()->fullname)->get();
        $countChildren = Student::where('parent_name', Auth::user()->fullname)->count();
        $season = Season::where('current', true)->first();

        if($countChildren == 1) {
            $child = $children[0];
            $processedResult = StudentSummary::where('class_id', $child->class_id)->where('season_id', $season->id)->count();
            if($processedResult > 0) {
                $isProcessedResult = true;
            }
            else {
                $isProcessedResult = false;
            }
            return view('pages.parent-students-profile', compact('child', 'countChildren', 'isProcessedResult', 'season'));
        }
        else if($countChildren > 1) {
            return view('pages.parent-student-index', compact('children', 'countChildren'));
        }

        else {
            return view('pages.parent-dashboard');
        }
    }


    public function teacherProfile($id) {
        $teacher = user::where('id', $id)->first();
        return view('pages.parent-teacher-profile', compact('teacher'));
    }

    public function viewChild($studentId) {
        $season = Season::where('current', 1)->first();
        $seasonId = $season->id;
        // return $student;
        $result = StudentSummary::where('student_id', $studentId)->where('season_id', $seasonId)->count();
        $countChildren = Student::where('parent_name', Auth::user()->fullname)->count();
        $child = Student::where('id', $studentId)->first();
        // return $child
        $processedResult = StudentSummary::where('class_id', $child->class_id)->where('season_id', $season->id)->count();
        if($processedResult > 0) {
            $isProcessedResult = true;
        }
        else {
            $isProcessedResult = false;
        }
        return view('pages.parent-students-profile', compact('child', 'countChildren', 'isProcessedResult', 'season'));
    }

    public function viewStudentResult($seasonId, $classId, $studentId) {
        $student = Student::where('id', $studentId)->first();
        $season = Season::where('id', $seasonId)->first();
        $class = ClassTable::where('id', $classId)->first();
        $studentSummary = StudentSummary::where('season_id', $seasonId)
                                        ->where('class_id', $classId)
                                        ->where('student_id', $studentId)
                                        ->first();
        $results =  Result::where('season_id', $seasonId)
                                ->where('class_id', $classId)
                                ->where('student_id', $studentId)
                                ->get();

        return view('pages.parent-result-student-index', compact('results', 'studentSummary', 'student', 'class', 'season'));

    }


    public function viewChildResult($id) {

        $seasonId = Season::where('current', true)->first()->id;
        $student = Student::where('id', $id)->first();
        $summary = StudentSummary::where('student_id', $id)->where('season_id', $seasonId)->first();
        $resultObject = Result::where('season_id', $seasonId)->where('class_id', $student->class_id)->where('student_id', $id);
        $results = $resultObject->orderBy('subject_id')->get();
        // return $results;
        return view('pages.parent-students-result-index', compact('results', 'summary', 'student'));
    }

    public function profilePicsUpdatePage($id) {
        $student = Student::where('id', $id)->first();
        return view('pages.parent-student-upload-pics', compact('student')); 
    }

    
    public function profilePicsUpdateAction(Request $request) {

        $id = $request->id;
        $student = Student::find($id);
        $studentInfo = Student::where('id', $id)->first();
        $file = $request->file('photo');

        if($request->hasFile('photo')) {
        $previousFilename = $file->getClientOriginalName();
        $filename = $studentInfo->email ."_". $studentInfo->student_name .".". explode(".", $previousFilename)[count(explode(".", $previousFilename)) - 1];



            if ($file->isValid()) {
                
                if($file->move('uploads/images' , $filename)) {
                    $student->img_url = $filename;

                }

            }
        }
        else {
            return redirect()->back()->with(['message'=>"You didn't choose your picture", 'style' =>'alert-danger']);
        }
        $isSaved = $student->save();

        if ($isSaved) {
            return redirect()->back()->with(['message' => 'Picture has been changed', 'style' => 'alert-success']);
        }
        else {
            return redirect()->back()->with(['message' => 'Picture has been changed', 'style' => 'alert-danger']);
        }
    }

    public function children() {
        $children = Student::where('parent_name', Auth::user()->fullname)->get();
        $countChildren = Student::where('parent_name', Auth::user()->fullname)->count();
        return view('pages.parent-student-index', compact('children', 'countChildren'));
    }

    public function sendAdminMessagePage(){
        $adminPhone = User::where('role', 'admin')->first()->phone;
        // $adminPhone = implode(',', $adminPhone);
        return view('pages.parent-message-compose', compact('adminPhone'));
    }

    public function pdfview($seasonId, $classId, $studentId) {
        $class = ClassTable::where('id', $classId)->first();
        $season = Season::where('id', $seasonId)->first();
        $student = Student::where('id', $studentId)->first();
        $summary = StudentSummary::where('student_id', $studentId)->where('season_id', $seasonId)->first();
        $resultObject = Result::where('season_id', $seasonId)->where('class_id', $student->class_id)->where('student_id', $studentId);
        $results = $resultObject->orderBy('subject_id')->get();$seasonId = Season::where('current', true)->first()->id;
        $student = Student::where('id', $studentId)->first();
        $studentSummary = StudentSummary::where('student_id', $studentId)->where('season_id', $seasonId)->first();
        $resultObject = Result::where('season_id', $seasonId)->where('class_id', $student->class_id)->where('student_id', $studentId);
        $results = $resultObject->orderBy('subject_id')->get();
        // return [$results, $summary, $student, $class, $season];
        

        $pdf = PDF::loadView('pages.parent-result-student-index', compact('results', 'studentSummary', 'student', 'class', 'season'));
        // return $pdf;
        return $pdf->download('pdfview.pdf');
        // set_time_limit(300);
        // return view('pdfview');
    }

   
}
