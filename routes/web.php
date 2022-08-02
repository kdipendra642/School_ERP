<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\setup\StudentClassController;
use App\Http\Controllers\Backend\setup\StudentYearController;
use App\Http\Controllers\Backend\setup\StudentGroupController;
use App\Http\Controllers\Backend\setup\StudentShiftController;
use App\Http\Controllers\Backend\setup\FeeCategoryController;
use App\Http\Controllers\Backend\setup\FeeAmountController;
use App\Http\Controllers\Backend\setup\ExamTypeController;
use App\Http\Controllers\Backend\setup\SchoolSubjectController;
use App\Http\Controllers\Backend\setup\AssignSubjectController;
use App\Http\Controllers\Backend\setup\DesignationController;
use App\Http\Controllers\Backend\setup\StudentRegistrationController;
use App\Http\Controllers\Backend\Student\StudentRollGeneratorController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Marks\MarksController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\Marks\GradeController;
use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Backend\Report\ProfitController;
use App\Http\Controllers\Backend\Report\MarksheetController;
use App\Http\Controllers\Backend\Report\AttendanceReportController;
use App\Http\Controllers\Backend\Report\ResultReportController;




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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});


Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');


// Prevent backhistory
Route::group(['middleware' => 'prevent-back-history'], function () {
    // Middleware
    Route::group(['middleware' => 'auth'], function () {

        // User Mangement All routes
        Route::prefix('users')->group(function () {
            Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
            Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');
            Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');
            Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');
            Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');
            Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');
        });

        // User Profile and Password
        Route::prefix('profile')->group(function () {
            Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
            Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');
            Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
            Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
            Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
        });

        //Student class CRUD
        Route::prefix('setups')->group(function () {
            Route::get('/student/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');
            Route::get('/student/class/add', [StudentClassController::class, 'StudentClassAdd'])->name('student.class.add');
            Route::post('/student/class/store', [StudentClassController::class, 'StudentClassStore'])->name('store.student.class');
            Route::get('/student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');
            Route::post('/student/class/update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('update.student.class');
            Route::get('/student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');

            // Student Year Routes
            Route::get('/student/year/view', [StudentYearController::class, 'ViewYear'])->name('student.year.view');
            Route::get('/student/year/add', [StudentYearController::class, 'StudentYearAdd'])->name('student.year.add');
            Route::post('/student/year/store', [StudentYearController::class, 'StudentYearStore'])->name('store.student.year');
            Route::get('/student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');
            Route::post('/student/year/update/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('update.student.year');
            Route::get('/student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');

            // Student Group Routes
            Route::get('/student/group/view', [StudentGroupController::class, 'ViewGroup'])->name('student.group.view');
            Route::get('/student/group/add', [StudentGroupController::class, 'StudentGroupAdd'])->name('student.group.add');
            Route::post('/student/group/store', [StudentGroupController::class, 'StudentGroupStore'])->name('store.student.group');
            Route::get('/student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');
            Route::post('/student/group/update/{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('update.student.group');
            Route::get('/student/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');

            // Student shift routes
            Route::get('/student/shift/view', [StudentShiftController::class, 'ViewShift'])->name('student.shift.view');
            Route::get('/student/shift/add', [StudentShiftController::class, 'StudentShiftAdd'])->name('student.shift.add');
            Route::post('/student/shift/store', [StudentShiftController::class, 'StudentShiftStore'])->name('store.student.shift');
            Route::get('/student/shift/edit/{id}', [StudentShiftController::class, 'StudentShiftEdit'])->name('student.shift.edit');
            Route::post('/student/shift/update/{id}', [StudentShiftController::class, 'StudentShiftUpdate'])->name('update.student.shift');
            Route::get('/student/shift/delete/{id}', [StudentShiftController::class, 'StudentShiftDelete'])->name('student.shift.delete');

            // Student fee routes
            Route::get('/fee/category/view', [FeeCategoryController::class, 'ViewFeecategory'])->name('fee.category.view');
            Route::get('/fee/category/add', [FeeCategoryController::class, 'feecategoryAdd'])->name('fee.category.add');
            Route::post('/fee/category/store', [FeeCategoryController::class, 'feecategoryStore'])->name('store.fee.category');
            Route::get('/fee/category/edit/{id}', [FeeCategoryController::class, 'feecategoryEdit'])->name('fee.category.edit');
            Route::post('/fee/category/update/{id}', [FeeCategoryController::class, 'feecategoryUpdate'])->name('update.fee.category');
            Route::get('/fee/category/delete/{id}', [FeeCategoryController::class, 'feecategoryDelete'])->name('fee.category.delete');

            // Student fee routes
            Route::get('/fee/amount/view', [FeeAmountController::class, 'ViewFeeamount'])->name('fee.amount.view');
            Route::get('/fee/amount/add', [FeeAmountController::class, 'feeamountAdd'])->name('fee.amount.add');
            Route::post('/fee/amount/store', [FeeAmountController::class, 'feeamountStore'])->name('store.fee.amount');
            Route::get('/fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'feeamountEdit'])->name('fee.amount.edit');
            Route::post('/fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'feeamountUpdate'])->name('update.fee.amount');
            Route::get('/fee/amount/details/{id}', [FeeAmountController::class, 'feeamountDetails'])->name('fee.amount.details');

            // StudentExam Type routes
            Route::get('/exam/type/view', [ExamTypeController::class, 'ViewExamType'])->name('exam.type.view');
            Route::get('/exam/type/add', [ExamTypeController::class, 'ExamTypeAdd'])->name('exam.type.add');
            Route::post('/exam/type/store', [ExamTypeController::class, 'ExamTypeStore'])->name('store.exam.type');
            Route::get('/exam/type/edit/{id}', [ExamTypeController::class, 'ExamTypeEdit'])->name('exam.type.edit');
            Route::post('/exam/type/update/{id}', [ExamTypeController::class, 'ExamTypeUpdate'])->name('update.exam.type');
            Route::get('/exam/type/delete/{id}', [ExamTypeController::class, 'ExamTypeDelete'])->name('exam.type.delete');

            // Student Subject routes
            Route::get('/school/subject/view', [SchoolSubjectController::class, 'ViewSchoolSubject'])->name('school.subject.view');
            Route::get('/school/subject/add', [SchoolSubjectController::class, 'SchoolSubjectAdd'])->name('school.subject.add');
            Route::post('/school/subject/store', [SchoolSubjectController::class, 'SchoolSubjectStore'])->name('store.school.subject');
            Route::get('/school/subject/edit/{id}', [SchoolSubjectController::class, 'SchoolSubjectEdit'])->name('school.subject.edit');
            Route::post('/school/subject/update/{id}', [SchoolSubjectController::class, 'SchoolSubjectUpdate'])->name('update.school.subject');
            Route::get('/school/subject/delete/{id}', [SchoolSubjectController::class, 'SchoolSubjectDelete'])->name('school.subject.delete');

            // Assign Subject routes
            Route::get('/assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject'])->name('assign.subject.view');
            Route::get('/assign/subject/add', [AssignSubjectController::class, 'AssignSubjectAdd'])->name('assign.subject.add');
            Route::post('/assign/subject/store', [AssignSubjectController::class, 'AssignSubjectStore'])->name('store.assign.subject');
            Route::get('/assign/subject/edit/{class_id}', [AssignSubjectController::class, 'AssignSubjectEdit'])->name('assign.subject.edit');
            Route::post('/assign/subject/update/{class_id}', [AssignSubjectController::class, 'AssignSubjectUpdate'])->name('update.assign.subject');
            Route::get('/assign/subject/details/{id}', [AssignSubjectController::class, 'AssignSubjectDetails'])->name('assign.subject.details');

            // Designation routes
            Route::get('/designation/view', [DesignationController::class, 'ViewDesignation'])->name('designation.view');
            Route::get('/designation/add', [DesignationController::class, 'DesignationAdd'])->name('designation.add');
            Route::post('/designation/store', [DesignationController::class, 'DesignationStore'])->name('store.designation');
            Route::get('/designation/edit/{id}', [DesignationController::class, 'DesignationEdit'])->name('designation.edit');
            Route::post('/designation/update/{id}', [DesignationController::class, 'DesignationUpdate'])->name('update.designation');
            Route::get('/designation/delete/{id}', [DesignationController::class, 'DesignationDelete'])->name('designation.delete');
        });

        // Student Registration routes
        Route::prefix('students')->group(function () {
            Route::get('/registration/view', [StudentRegistrationController::class, 'StudentRegView'])->name('student.registration.view');
            Route::get('/registration/student/all', [StudentRegistrationController::class, 'StudentListView'])->name('student.list.view');
            Route::get('/registration/add', [StudentRegistrationController::class, 'StudentRegAdd'])->name('student.registration.add');
            Route::post('/registration/store', [StudentRegistrationController::class, 'StudentRegStore'])->name('store.student.registration');
            Route::get('/registration/edit/{student_id}', [StudentRegistrationController::class, 'StudentRegEdit'])->name('student.registration.edit');
            Route::post('/registration/update/{student_id}', [StudentRegistrationController::class, 'StudentRegUpdate'])->name('update.student.registration');
            Route::get('/registration/promotion/{student_id}', [StudentRegistrationController::class, 'StudentRegPromotion'])->name('student.registration.promotion');
            Route::post('/registration/promote/{student_id}', [StudentRegistrationController::class, 'StudentRegPromote'])->name('promote.student.registration');
            Route::get('/registration/details/{student_id}', [StudentRegistrationController::class, 'StudentRegDetails'])->name('student.registration.details');

            Route::get('/year/class/wise', [StudentRegistrationController::class, 'StudentYearClassWise'])->name('student.year.class.wise');

            // Roll Generator
            Route::get('/roll/generate/view', [StudentRollGeneratorController::class, 'StudentRollView'])->name('roll.generate.view');
            Route::get('/registration/getstudents', [StudentRollGeneratorController::class, 'GetStudents'])->name('student.registration.getstudents');
            Route::post('/roll/generate/store', [StudentRollGeneratorController::class, 'StudentRollStore'])->name('roll.generate.store');

            // Registration fee routes
            Route::get('/reg/fee/view', [RegistrationFeeController::class, 'RegFeeView'])->name('registration.fee.view');
            Route::get('/reg/fee/classwisedata', [RegistrationFeeController::class, 'RegFeeClassData'])->name('student.registration.fee.classwise.get');
            Route::get('/reg/fee/payslip', [RegistrationFeeController::class, 'RegFeePaySlip'])->name('student.registration.fee.payslip');

            // Monthly fee routes
            Route::get('/month/fee/view', [MonthlyFeeController::class, 'MonthFeeView'])->name('month.fee.view');
            Route::get('/month/fee/classwisedata', [MonthlyFeeController::class, 'MonthFeeClassData'])->name('student.month.fee.classwise.get');
            Route::get('/month/fee/payslip', [MonthlyFeeController::class, 'MonthFeePaySlip'])->name('student.month.fee.payslip');

            // Exam fee routes
            Route::get('/exam/fee/view', [ExamFeeController::class, 'ExamFeeView'])->name('exam.fee.view');
            Route::get('/exam/fee/classwisedata', [ExamFeeController::class, 'ExamFeeClassData'])->name('student.exam.fee.classwise.get');
            Route::get('/exam/fee/payslip', [ExamFeeController::class, 'ExamFeePaySlip'])->name('student.exam.fee.payslip');
        });

        // Employee Section
        Route::prefix('employees')->group(function () {
            // Employee Registration
            Route::get('reg/employee/view', [EmployeeRegController::class, 'EmployeeView'])->name('employee.registration.view');
            Route::get('reg/employee/add', [EmployeeRegController::class, 'EmployeeRegAdd'])->name('employee.registration.add');
            Route::post('reg/employee/store', [EmployeeRegController::class, 'EmployeeRegStore'])->name('store.employee.registration');
            Route::get('reg/employee/edit/{id}', [EmployeeRegController::class, 'EmployeeRegEdit'])->name('employee.registration.edit');
            Route::post('reg/employee/update/{id}', [EmployeeRegController::class, 'EmployeeRegUpdate'])->name('employee.registration.update');
            Route::get('reg/employee/details/{id}', [EmployeeRegController::class, 'EmployeeRegDetails'])->name('employee.registration.details');

            // Employee salary routes
            Route::get('empoyee/salary/view', [EmployeeSalaryController::class, 'EmployeeSalaryView'])->name('employee.salary.view');
            Route::get('empoyee/salary/increment/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryIncrement'])->name('employee.salary.increment');
            Route::post('employee/salary/increment/update/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryUpdate'])->name('update.increment.store');
            Route::get('employee/salary/details/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryDetails'])->name('employee.salary.details');

            // Employee Leave Routes
            Route::get('employee/leave/view', [EmployeeLeaveController::class, 'EmployeeLeaveView'])->name('employee.leave.view');
            Route::get('employee/leave/add', [EmployeeLeaveController::class, 'EmployeeLeaveAdd'])->name('employee.leave.add');
            Route::post('employee/leave/store', [EmployeeLeaveController::class, 'EmployeeLeaveStore'])->name('store.employee.leave');
            Route::get('employee/leave/edit/{id}', [EmployeeLeaveController::class, 'EmployeeLeaveEdit'])->name('employee.leave.edit');
            Route::post('employee/leave/update/{id}', [EmployeeLeaveController::class, 'EmployeeLeaveUpdate'])->name('employee.leave.update');
            Route::get('employee/leave/delete/{id}', [EmployeeLeaveController::class, 'EmployeeLeaveDelete'])->name('employee.leave.delete');

            // Employee Attandance routes
            Route::get('employee/attendance/view', [EmployeeAttendanceController::class, 'EmployeeAttendanceView'])->name('employee.attendance.view');
            Route::get('employee/attendance/add', [EmployeeAttendanceController::class, 'EmployeeAttendanceAdd'])->name('employee.attendance.add');
            Route::post('employee/attendance/store', [EmployeeAttendanceController::class, 'EmployeeAttendanceStore'])->name('store.employee.attendance');
            Route::get('employee/attendance/edit/{date}', [EmployeeAttendanceController::class, 'EmployeeAttendanceEdit'])->name('employee.attendance.edit');
            Route::get('employee/attendance/details/{date}', [EmployeeAttendanceController::class, 'EmployeeAttendanceDetails'])->name('employee.attendance.details');

            // Employee Monthly Salary
            Route::get('employee/monthly/view', [MonthlySalaryController::class, 'MonthlySalaryView'])->name('employee.monthly.salary');
            Route::get('employee/monthly/salary/get', [MonthlySalaryController::class, 'MonthlySalaryGet'])->name('employee.monthly.salary.get');
            Route::get('monthly/salary/payslip/{employee_id}', [MonthlySalaryController::class, 'MonthlySalaryPaySlip'])->name('employee.monthly.salary.payslip');
        });

        Route::prefix('marks')->group(function () {
            // Marks Management routes
            Route::get('marks/entry/add', [MarksController::class, 'AddMarks'])->name('marks.entry.add');
            Route::get('marks/getsubjects', [DefaultController::class, 'GetSubjects'])->name('marks.getsubject');
            Route::get('student/marks/getstudents', [DefaultController::class, 'GetStudents'])->name('student.marks.getstudents');
            Route::post('marks/entry/store', [MarksController::class, 'MarksStore'])->name('marks.entry.store');
            Route::get('marks/entry/edit', [MarksController::class, 'MarksEntryEdit'])->name('marks.entry.edit');
            Route::get('marks/edit/getstudents', [MarksController::class, 'MarksEntryGetStudentsEdit'])->name('student.marks.edit.getstudents');
            Route::post('marks/entry/update', [MarksController::class, 'MarksUpdate'])->name('marks.entry.update');

            // Marks grade mgmt...
            Route::get('marks/grade/view', [GradeController::class, 'MarksGradeView'])->name('marks.entry.grade');
            Route::get('marks/grade/add', [GradeController::class, 'MarksGradeAdd'])->name('marks.grade.add');
            Route::post('marks/grade/store', [GradeController::class, 'MarksGradeStore'])->name('store.marks.grade');
            Route::get('marks/grade/edit/{id}', [GradeController::class, 'MarksGradeEdit'])->name('marks.grade.edit');
            Route::post('marks/grade/update/{id}', [GradeController::class, 'MarksGradeUpdate'])->name('marks.grade.update');
            Route::get('marks/grade/delete/{id}', [GradeController::class, 'MarksGradeDelete'])->name('marks.grade.delete');
        });

        Route::prefix('accounts')->group(function () {
            // Student Fee Management routes
            Route::get('student/fee/view', [StudentFeeController::class, 'StudentFeeView'])->name('student.fee.view');
            Route::get('student/fee/add', [StudentFeeController::class, 'StudentFeeAdd'])->name('student.fee.add');
            Route::post('student/fee/store', [StudentFeeController::class, 'StudentFeeStore'])->name('account.fee.store');
            Route::get('student/fee/getstudent', [StudentFeeController::class, 'StudentFeeGetStudent'])->name('account.fee.getstudents');

            // Employee Salary mgmt Routes
            Route::get('account/salary/view', [AccountSalaryController::class, 'AccountSalaryView'])->name('account.salary.view');
            Route::get('account/salary/add', [AccountSalaryController::class, 'AccountSalaryAdd'])->name('account.salary.add');
            Route::get('account/employee/getemployee', [AccountSalaryController::class, 'AccountSalaryGetemployee'])->name('account.employee.getemployee');
            Route::post('account/salary/store', [AccountSalaryController::class, 'AccountSalaryStore'])->name('account.salary.store');
            // Other cost routes
            Route::get('other/cost/view', [OtherCostController::class, 'OtherCostView'])->name('other.cost.view');
            Route::get('other/cost/add', [OtherCostController::class, 'OtherCostAdd'])->name('other.cost.add');
            Route::post('other/cost/store', [OtherCostController::class, 'OtherCostStore'])->name('store.other.cost');
            Route::get('other/cost/edit/{id}', [OtherCostController::class, 'OtherCostEdit'])->name('other.cost.edit');
            Route::post('other/cost/update/{id}', [OtherCostController::class, 'OtherCostUpdate'])->name('other.cost.update');
            Route::get('other/cost/delete/{id}', [OtherCostController::class, 'OtherCostDelete'])->name('other.cost.delete');
            Route::get('other/cost/details/{id}', [OtherCostController::class, 'OtherCostDetails'])->name('other.cost.details');
        });


        Route::prefix('reports')->group(function () {
            // Report Management routes
            Route::get('monthly/profit/view', [ProfitController::class, 'MonthlyView'])->name('monthly.profit.view');
            Route::get('monthly/profit/datewise', [ProfitController::class, 'MonthlyProfitDateWise'])->name('report.profit.datewise.get');
            Route::get('monthly/profit/downloadpdf', [ProfitController::class, 'MonthlyProfitGenPdf'])->name('monthly.profit.report.pdf');
            // Marksheet Generate routes
            Route::get('marksheet/generate/view', [MarksheetController::class, 'MarksheetGenerateView'])->name('marksheet.generate.view');
            Route::get('marksheet/report/get', [MarksheetController::class, 'MarksheetReportGet'])->name('report.marksheet.get');

            // Attendance report view
            Route::get('attendance/report/view', [AttendanceReportController::class, 'AttandenceReport'])->name('attendance.report.view');
            Route::get('report/attendance/get', [AttendanceReportController::class, 'AttandenceReportGet'])->name('report.attendance.get');

            // Student Result routes
            Route::get('result/report/view', [ResultReportController::class, 'ResultReportView'])->name('student.result.view');
            Route::get('report/result/get', [ResultReportController::class, 'ResultReportGet'])->name('report.student.result.get');
            Route::get('student/idcard/view', [ResultReportController::class, 'IdCardView'])->name('student.idcard.view');
            Route::get('student/idcard/get', [ResultReportController::class, 'IdCardGet'])->name('report.student.idcard.get');
        });
    });
});
