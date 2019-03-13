<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\StudentDetail;
use App\Student;
use App\ClassTable;
use App\Subject;
use App\Season;
use App\StudentSummary;
use App\Result;
use PDF;

class DownloadController extends Controller
{
    //
    public function downloadTemplate($csvContent){
        $template = implode("\n", $csvContent);
        return response($template)
                    ->header('Content-Type', 'text/csv')
                    ->header('Content-type', 'application/force-download')
                    ->header('X-Header-One', 'Header Value');
    }

    public function classTemplate() {
    	$csvContent = array();
		$csvContent[] = "sn, name";
		$csvContent[] = "1, 2J";
		$csvContent[] = "2, 3J";
		$csvContent[] = "3, 4J";
		$csvContent[] = "4, 5J";
		return $this->downloadTemplate($csvContent);
    }
    public function subjectTemplate() {
    	$csvContent = array();
    	$csvContent[] = "S/N, name, short_name";
		$csvContent[] = "1, English Language, Eng";
		$csvContent[] = "2, Mathematics, Maths";
		$csvContent[] = "3, Chemistry, CHM";
		$csvContent[] = "4, Physics, PHY";
		$csvContent[] = "5, Elementary Science, El. Sc.";
		$csvContent[] = "6, Civic, civic";
		$csvContent[] = "7, Yoruba, Yor";
		return $this->downloadTemplate($csvContent);
    }
    public function teacherTemplate() {
    	$csvContent = array();
		$csvContent[] = "SN, lastname, firstname, othernames, phone, phone2, email, birthdate";
		$csvContent[] = "1, James, Titilayo, Adeoni, 08032421232, 08045436211, titilayjames@gmail.com, Sept 3";
		$csvContent[] = "2, James, BUsola, Adeolu, 08042421832, 08045436271, busolajames@gmail.com, Sept 7";
		$csvContent[] = "3, Aina, Daggs, Sherrah, 08035421832, 08045736271, ainadaggs@gmail.com, Sept 9";
		return $this->downloadTemplate($csvContent);
    }
    public function studentTemplate() {
        $csvContent = array();
        $csvContent[] = "sn, parent_name, student_name, Sex, class, email, phone, phone2, birthdate";
        $csvContent[] = "1, Mr. & Mrs.|AMOWOGBAJE Gideon Ifedayo, AMOWOGBAJE Eunice Babalola, male, 5J, amowogbajegideon@gmail.com, 08174007780, 07045673242, Sep-4";
        $csvContent[] = "1, Mr. & Mrs.|AMOWOGBAJE Gideon Ifedayo, AMOWOGBAJE Aina Babamuda, female, 5J, amowogbajegideon@gmail.com, 08174007780, 07045673242, Sep-4";
        $csvContent[] = "1, Mr. & Mrs.|AMOWOGBAJE Gideon Ifedayo, AMOWOGBAJE Aina Babamuda, male, 5J, amowogbajegideon@gmail.com, 08174007780, 07045673242, Sep-4";
        return $this->downloadTemplate($csvContent);
    }

    public function studentTeacherTemplate() {
    	$csvContent = array();
		$csvContent[] = "sn, parent_name, student_name, Sex, email, phone, phone2, birthdate";
		$csvContent[] = "1, Mr. & Mrs.|AMOWOGBAJE Gideon Ifedayo, AMOWOGBAJE Eunice Babalola, male, amowogbajegideon@gmail.com, 08174007780, 07045673242, Sep-4";
		$csvContent[] = "1, Mr. & Mrs.|AMOWOGBAJE Gideon Ifedayo, AMOWOGBAJE Aina Babamuda, female, amowogbajegideon@gmail.com, 08174007780, 07045673242, Sep-4";
		$csvContent[] = "1, Mr. & Mrs.|AMOWOGBAJE Gideon Ifedayo, AMOWOGBAJE Aina Babamuda, male, amowogbajegideon@gmail.com, 08174007780, 07045673242, Sep-4";
		return $this->downloadTemplate($csvContent);
    }
    public function resultTemplate($seasonId, $classId, $subjectId) {
    	$resultDetails = StudentDetail::where('subject_id', $subjectId)->where('class_id', $classId)->where('season_id', $seasonId)->get();
    	$csvContent =array();
    	$sn = 0;
    	$csvContent[] = "SN, Student Name, ID No, Assessment, Exam Score"; 
        foreach ($resultDetails as $resultDetail) {
            $sn++;
    		$csvContent[] = $sn. ", ". $resultDetail->student($resultDetail->student_id). ", ".$resultDetail->student_id.",0".",0";
    	}
        $template = implode("\n", $csvContent);
    	return response($template)
                    ->header('Content-Type', 'text/csv')
                    ->header('Content-type', 'application/force-download')
                    ->header('X-Header-One', 'Header Value'); 
    }


    public function downloadResultInPDFFormat($seasonId, $classId, $studentId) {
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
        

        $pdf = PDF::loadView('pages.pdf-result-student-index', compact('results', 'studentSummary', 'student', 'class', 'season'));
        // return view('pages.pdf-result-student-index', compact('results', 'studentSummary', 'student', 'class', 'season'));
        // return $pdf;
        return $pdf->download( $student->student_name. '.pdf');
        set_time_limit(300);
    }

    
}
