<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/test','App\Http\Controllers\TestController@index');

Route::get('/departmentgetAll','App\Http\Controllers\DepartmentController@getAll');

Route::get('/coursesgetAll','App\Http\Controllers\CoursesController@getAll');

Route::get('/coursesgetByDeptId/{deptId}','App\Http\Controllers\CoursesController@getByDeptId');

Route::get('/gradegetAll','App\Http\Controllers\GradeController@getAll');

Route::get('/strandAll','App\Http\Controllers\StrandController@getAll');

Route::get('/gradesByDepId/{deptId}','App\Http\Controllers\GradeController@getGrades');

Route::get('/classesgetAll','App\Http\Controllers\ClassesController@getAll');

Route::get('/studentgetAll','App\Http\Controllers\StudentController@getAll');

Route::post('/students','App\Http\Controllers\StudentController@createStudent');

//enrolment here
Route::get('/enrollmentgetAll','App\Http\Controllers\EnrollmentController@getAll');
Route::get('/enrollmentgetByEnrolNo/{enrolNo}', 'App\Http\Controllers\EnrollmentController@getEnrolByEnrlNo');
Route::get('/enrollmentgetByReff/{refNo}', 'App\Http\Controllers\EnrollmentController@getByEnrolRefNo');
Route::get('/paymentEnrollmentgetByReff/{refNo}', 'App\Http\Controllers\EnrollmentController@getPaymentByEnrolRefNo');
Route::get('/enrollmentinquiry/{page?}/{pageSize?}/{searchField?}', 'App\Http\Controllers\EnrollmentController@inquiry');
Route::post('/enrollmentUpload','App\Http\Controllers\EnrollmentController@uploadFile');
Route::post('/enrol','App\Http\Controllers\EnrollmentController@enrol');
Route::post('/updateEnrol','App\Http\Controllers\EnrollmentController@updateEnrol');
Route::post('/enrolVerify','App\Http\Controllers\EnrollmentController@enrolVerify');
Route::post('/updateInquiry','App\Http\Controllers\EnrollmentController@updateInquiry');
Route::get('/enrollgetForverification','App\Http\Controllers\EnrollmentController@getForverification');
Route::get('/enrollmentretrievefile','App\Http\Controllers\EnrollmentController@retrieveFile');
Route::get('/enrollmentgetPayment/{refNo}','App\Http\Controllers\EnrollmentController@getPayment');
Route::post('/getEnrolment','App\Http\Controllers\EnrollmentController@getEnrolment');


//payment here
Route::get('/forapprovalPayment/{page?}/{pageSize?}/{searchField?}', 'App\Http\Controllers\EnrollmentController@paymentListForApproval');

Route::get('/inquiryPayment/{page?}/{pageSize?}/{searchField?}', 'App\Http\Controllers\EnrollmentController@paymentList');

Route::get('/approvePayment/{refNo}', 'App\Http\Controllers\EnrollmentController@approvePayment');

Route::get('/disapprovePayment/{refNo}', 'App\Http\Controllers\EnrollmentController@disapprovePayment');

Route::post('/enrollmentMakePayment','App\Http\Controllers\EnrollmentController@makePayment');

//users here
Route::post('/login','App\Http\Controllers\UserController@login');

//Student here
Route::post('/createStudent','App\Http\Controllers\StudentController@createStudent');
Route::get('/studentlist/{page?}/{pageSize?}/{searchField?}', 'App\Http\Controllers\StudentController@studentlist');
Route::get('/studentViewlist/{page?}/{pageSize?}/{searchField?}', 'App\Http\Controllers\StudentController@studentViewlist');

//billing here
Route::get('/getBillingAllFee', 'App\Http\Controllers\BillingController@getAllFee');
Route::get('/getYearlyFeeAccordingtoStudent/{departmentId?}/{gradeId?}/{strandId?}/{semester?}/{schoolyearfrom?}/{schoolyearto?}', 'App\Http\Controllers\BillingController@getYearlyFeeAccordingtoStudent');
Route::get('/getYearlyFeeById/{id?}', 'App\Http\Controllers\YearlyFeeController@getYearlyFeeById');
Route::get('/getYearlyFeeDetailByMastereId/{masterId?}', 'App\Http\Controllers\YearlyFeeController@getYearlyFeeDetailByMastereId');
Route::post('/saveYearlyFee','App\Http\Controllers\YearlyFeeController@saveYearlyFee');
Route::post('/updateYearlyFee','App\Http\Controllers\YearlyFeeController@updateYearlyFee');
Route::post('/saveYearlyFeeDetail','App\Http\Controllers\YearlyFeeController@saveYearlyFeeDetail');
Route::post('/updateYearlyFeeDetail','App\Http\Controllers\YearlyFeeController@updateYearlyFeeDetail');
Route::get('/yearlyfee/{schoolYearFrom?}/{schoolYearTo?}/{page?}/{pageSize?}/{searchField?}', 'App\Http\Controllers\YearlyFeeController@yearlyfee');
Route::get('/generateBill/{yearFrom?}/{yearTo?}', 'App\Http\Controllers\BillingController@generateBill');
Route::get('/generatePdf', 'App\Http\Controllers\BillingController@generatePdf');
Route::get('/getStudentForPayment/{studentId?}/{schoolyearfrom?}/{schoolyearto?}', 'App\Http\Controllers\BillingController@getStudentForPayment');
Route::get('/getStudentForPaymentByBillId/{billid?}/{detailNo?}', 'App\Http\Controllers\BillingController@getStudentForPaymentByBillId');
Route::get('/getStudentPaidPayment/{studentId?}/{schoolyearfrom?}/{schoolyearto?}', 'App\Http\Controllers\BillingController@getStudentPaidPayment');
Route::get('/getAssesmentbydetailNo/{schoolYearFrom?}/{schoolYearTo?}/{detailNo}', 'App\Http\Controllers\BillingController@getAssesmentbydetailNo');



/*
getStudentFeeById
getStudentFeeDetailByMastereId
*/
//schoolyear
Route::get('/getActiveSchoolYear', 'App\Http\Controllers\SchoolYearController@getActiveSchoolYear');

//student fee
Route::post('/saveStudentFee','App\Http\Controllers\StudentFeeController@saveStudentFee');
Route::post('/updateStudentFee','App\Http\Controllers\StudentFeeController@updateStudentFee');
Route::post('/saveStudentFeeDetail','App\Http\Controllers\StudentFeeController@saveStudentFeeDetail');
Route::post('/updateStudentFeeDetail','App\Http\Controllers\StudentFeeController@updateStudentFeeDetail');
Route::get('/getIndividualStudentFee/{studentId?}/{yearFrom?}/{yearTo?}', 'App\Http\Controllers\StudentFeeController@getIndividualStudentFee');
Route::get('/getIndividualListStudentFee/{schoolYearFrom?}/{schoolYearTo?}/{page?}/{pageSize?}/{searchField?}', 'App\Http\Controllers\StudentFeeController@getIndividualListStudentFee');
Route::get('/getStudentFeeById/{id?}', 'App\Http\Controllers\StudentFeeController@getStudentFeeById');
Route::get('/getStudentFeeDetailByMastereId/{masterId?}', 'App\Http\Controllers\StudentFeeController@getStudentFeeDetailByMastereId');



//transaction
Route::post('/saveTransaction','App\Http\Controllers\TransactionController@saveTransaction');
Route::post('/updateTransaction','App\Http\Controllers\TransactionController@updateTransaction');



