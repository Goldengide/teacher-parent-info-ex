<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::intended("http://localhost/PTIE/index.html");

});


// Route::get('pdfview',array('as'=>'pdfview','uses'=>'ItemController@pdfview')); I'm coming to you
Route::get('/send/sms', 'SMSController@sendSms'); //I'm coming to you
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/welcome', 'HomeController@indexf');
Route::get('/about', 'HomeController@index');
// Route::get('/login', 'Auth\LoginController@loginPage');
// Route::post('/login', 'Auth\LoginController@loginPost');
Route::post('/logina', 'Auth\LoginController@loginPost');
Route::get('/change-password', 'AdminController@changePasswordPage')->middleware('auth');
Route::post('/change-password', 'AdminController@changePassword')->middleware('auth');


# Parent Module
Route::group(['middleware' => ['auth', 'can:parent'], 'prefix' => 'parent'], function() {
 
	Route::get('/dashboard', 'ParentController@dashboard');
	Route::get('/child/profile', 'ParentController@dashboard');
	Route::get('/child/profile/{id}', 'ParentController@viewChild');
	Route::get('/children', 'ParentController@children');
	Route::get('/child/result/{id}', 'ParentController@viewChildResult');
	Route::post('/child/profile/pics', 'ParentController@profilePicsUpdateAction');
	Route::get('/teacher/profile/{id}', 'ParentController@teacherProfile');
	Route::get('/result/student/{seasonId}/{classId}/{studentId}', 'ParentController@viewStudentResult');
	Route::get('/result/student/{seasonId}/{classId}/{studentId}/{studentName}.pdf','DownloadController@downloadResultInPDFFormat');
	
	Route::group(['prefix' => 'message'], function() {
		Route::post('/send', 'SMSController@sendteacherMessage');
		Route::get('/compose', 'ParentController@sendAdminMessagePage');
	});

});


# Teachers module
Route::group(['middleware' => ['auth', 'can:teacher'], 'prefix' => 'teacher'], function() {

	Route::get('/dashboard', 'TeacherController@dashboard');
	Route::get('/students/all', 'TeacherController@students');
	Route::get('/students', 'TeacherController@studentsByClass');
	Route::get('/students/upload', 'TeacherController@uploadStudentsPage');
	Route::post('/students/upload', 'TeacherController@uploadStudentsAction');

	Route::get('/students/new', 'TeacherController@addStudentPage');
	Route::post('/students/new', 'TeacherController@addStudentAction');

	Route::post('/students/add-comment', 'TeacherController@addCommentToStudentResult');

	Route::get('/students/edit/{id}', 'TeacherController@updateStudentPage');
	Route::post('/students/edit', 'TeacherController@updateStudentAction');
	Route::get('/students/profile/{id}', 'TeacherController@viewStudent');


	Route::get('/subjects', 'TeacherController@subjectIndex');
	Route::get('/result', 'TeacherController@sessionIndex');


	Route::get('/result/seasons/{id}', 'TeacherController@seasonforResult');

	Route::get('/result/upload/{seasonId}/{classId}/{subjectId}', 'TeacherController@uploadResult');
	Route::post('/result/upload', 'TeacherController@uploadResultAction');

	Route::get('/result/view/{seasonId}/{classId}/{subjectId}', 'TeacherController@resultIndex');

	Route::get('/result/view/{id}', 'TeacherController@viewResult');
	Route::get('/result/edit/{id}', 'TeacherController@editResult');
	Route::post('/result/edit', 'TeacherController@editResultAction');

	Route::get('/result/student/view/{id}/{seasonId}', 'TeacherController@viewResultForStudent');
	Route::get('/result/student/{seasonId}/{classId}/{studentId}/{studentName}.pdf','DownloadController@downloadResultInPDFFormat');


	
	Route::get('/parents', 'TeacherController@parents');
	Route::get('/parent/profile/{id}', 'TeacherController@viewParent');


	Route::group(['prefix' => 'template'], function(){
		Route::get('student.csv', 'DownloadController@studentTeacherTemplate');
		Route::get('/result/{seasonId}/{classId}/{subjectId}/{result}.csv', 'DownloadController@resultTemplate');


	});
	Route::get('/result/student/{seasonId}/{classId}/{studentId}', 'TeacherController@viewStudentResult');

	Route::group(['prefix' => 'message'], function() {
		Route::post('/send', 'SMSController@sendTeacherMessage');
		Route::get('/compose', 'TeacherController@sendAdminMessagePage');
	});

});

	
# SuperAdmin module
Route::group(['middleware' => ['auth', 'can:super-admin'], 'prefix' => 'super-admin', ''], function() {

	Route::get('/dashboard', 'AdminController@dashboard');

	Route::get('/teacher/new', 'AdminController@newTeacherPage');
	Route::post('/teacher/add', 'AdminController@newTeacherAction');
	// Route::post('/parent/add', 'AdminController@newParentAction');

	Route::get('/teacher/edit/{id}', 'AdminController@updateTeacherPage');
	Route::post('/teacher/edit', 'AdminController@updateTeacherAction');
	Route::get('/teacher/assign-class/{id}', 'AdminController@assignTeacherClassPage');
	Route::post('/teacher/assign-class', 'AdminController@assignTeacherClassAction');
	Route::get('/parent/edit/{id}', 'AdminController@updateParentPage');
	Route::post('/parent/edit', 'AdminController@updateParentAction');

	Route::get('/teacher/profile/{id}', 'AdminController@teacherProfile');
	Route::get('/parent/profile/{id}', 'AdminController@parentProfile');

	Route::get('/teachers', 'AdminController@teachers');
	Route::get('/parents', 'AdminController@parents');

	Route::get('/teacher/upload', 'AdminController@uploadTeachersPage');
	Route::post('/teacher/upload', 'AdminController@uploadTeachersAction');
	Route::get('/parent/extract', 'AdminController@extractParent');

	// Students 
	Route::get('/students/all', 'AdminController@students');
	Route::get('/students/{classId}', 'AdminController@studentsByClass');
	Route::get('/student/upload', 'AdminController@uploadStudentsPage');
	Route::post('/student/upload', 'AdminController@uploadStudentsAction');
	Route::get('/student/new', 'AdminController@addStudentPage');
	Route::post('/student/new', 'AdminController@addStudentAction');
	Route::get('/student/edit/{id}', 'AdminController@editStudentPage');
	Route::post('/student/edit', 'AdminController@editStudentAction');
	Route::get('/students/grad', 'AdminController@graduatingStudents');

	Route::get('student/profile/{id}', 'AdminController@studentProfile');
	

	Route::get('/result/student/{seasonId}/{classId}/{studentId}/{studentName}.pdf','DownloadController@downloadResultInPDFFormat');



	// Classes Upload 
	Route::get('/classes', 'AdminController@classes');
	Route::get('/classes/new', 'AdminController@addClass');
	Route::post('/classes/new', 'AdminController@addClassAction');
	Route::get('/classes/edit/{id}', 'AdminController@editClass');
	Route::post('/classes/edit', 'AdminController@editClassAction');
	Route::get('/classes/view/{id}', 'AdminController@viewClass');
	Route::get('/classes/assign-teacher/{id}', 'AdminController@assignClassTeacherPage');
	Route::post('/classes/assign-teacher', 'AdminController@assignClassTeacherAction');
	Route::get('classes/upload', 'AdminController@classesUploadPage');
	Route::post('/classes/upload', 'AdminController@classesUpload');


	// Subject Upload 
	Route::get('/subjects', 'AdminController@subjects');
	Route::get('/subject/new', 'AdminController@addSubjectPage');
	Route::post('/subject/new', 'AdminController@addSubjectAction');
	Route::get('/subject/edit/{id}', 'AdminController@editSubjectPage');
	Route::post('/subject/edit', 'AdminController@editSubjectAction');
	Route::get('subject/upload', 'AdminController@uploadSubjectsPage');
	Route::post('/subject/upload', 'AdminController@uploadSubjects');


	// Seasons Upload
	Route::get('/seasons', 'SeasonController@index');
	Route::get('/seasons/generate/{start}/{stop}', 'SeasonController@generateSeasonsFromIntervals');
	Route::get('/seasons/generator', 'SeasonController@generateSeasonsInterface');
	Route::post('/seasons/generator', 'SeasonController@generateSeasonsAction');
	Route::get('/seasons/clear', 'SeasonController@clearSeason');
	Route::get('/season/activate/{id}', 'SeasonController@activate');
	Route::get('/season/make-current/{id}', 'SeasonController@makeCurrent');
	Route::get('/season/launch/{id}', 'SeasonController@launchSeason');
	Route::get('/season/check', 'SeasonController@check');


	// Result Upload

	Route::get('/result/session', 'AdminController@seasonforResult');
	Route::get('/result/season/{seasonId}/', 'AdminController@classForResult');
	Route::get('/result/season/{seasonId}/class/{classId}', 'AdminController@subjectsforResult');
	Route::get('/result/view/{seasonId}/{classId}/{subjectId}', 'AdminController@resultIndex');

	Route::post('/result/approve', 'AdminController@approveResult');

	Route::get('/result/upload/{seasonId}/{classId}/{subjectId}', 'AdminController@uploadResult');
	Route::post('/result/upload', 'AdminController@uploadResultAction');

	Route::get('/result/details/{id}', 'AdminController@viewResult');
	Route::get('/result/edit/{id}', 'AdminController@editResult');
	Route::post('/result/edit', 'AdminController@editResultAction');
	
	Route::post('/result/process', 'AdminController@processStudentResult');

	Route::get('/result/summary/{id}', 'AdminController@resultSummary');
	Route::get('/result/overall/best', 'AdminController@bestStudents');

	Route::get('/result/student/{seasonId}/{classId}/{studentId}', 'AdminController@viewStudentResult');


	// Template download 
	Route::group(['prefix' => 'template'], function(){
		Route::get('class.csv', 'DownloadController@classTemplate');
		Route::get('subject.csv', 'DownloadController@subjectTemplate');
		Route::get('teacher.csv', 'DownloadController@teacherTemplate');
		Route::get('student.csv', 'DownloadController@studentTemplate');
		Route::get('/result/{seasonId}/{classId}/{subjectId}/{result}.csv', 'DownloadController@resultTemplate');


	});


	// Message
	Route::group(['prefix' => 'message'], function() {
		Route::post('/compose', 'SMSController@sendAdminMessagePage');
		Route::post('/send', 'SMSController@sendAdminMessage');
	});

});