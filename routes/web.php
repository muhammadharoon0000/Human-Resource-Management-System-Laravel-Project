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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false]);

Route::get('/pdf', function () {
	return view('pdf');
});
Route::group(['middleware' => ['XSS']], function ()
{
	

	Route::get('/', 'RouteClosureHandlerController@redirectToLogin')->name('redirectToLogin');



	Route::get('home', 'FrontEnd\HomeController@index')->name('home.front');
	Route::get('about', 'FrontEnd\AboutController@index')->name('about.front');
	Route::get('contact', 'FrontEnd\ContactController@index')->name('contact.front');


	Route::get('jobs', 'FrontEnd\JobController@index')->name('jobs');
	Route::get('jobs/details/{job_post}', 'FrontEnd\JobController@details')->name('jobs.details');
	Route::get('jobs/search/category/{url}', 'FrontEnd\JobController@searchByCategory')->name('jobs.searchByCategory');
	Route::get('jobs/search/job_type/{job_type}', 'FrontEnd\JobController@searchByJobType')->name('jobs.searchByJobType');
	Route::post('jobs/apply/{job}', 'FrontEnd\JobController@applyForJob')->name('jobs.apply');


	Route::get('markAsRead', 'RouteClosureHandlerController@markAsReadNotification')->name('markAsRead');
	Route::get('/all/notifications', 'RouteClosureHandlerController@allNotifications')->name('seeAllNoti');
	Route::get('clearAll', 'RouteClosureHandlerController@clearAll')->name('clearAll');


	Route::get('/profile', 'DashboardController@profile')->name('profile');
	Route::put('/profile/{id}', 'DashboardController@profile_update')->name('profile_update');
	Route::post('/profile/employee/{id}', 'DashboardController@employeeProfileUpdate')->name('employee_profile_update');
	Route::post('/profile/change_password/{id}', 'DashboardController@change_password')->name('change_password');

	Route::get('switch/language/{lang}', 'LocaleController@languageSwitch')->name('language.switch');
	Route::get('delete/language', 'LocaleController@languageDelete')->name('language.delete');


	Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function ()
	{
		Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	});

	Route::group(['prefix' => 'employee', 'as' => 'employee.', 'middleware' => ['auth']], function ()
	{
		Route::get('/dashboard', 'DashboardController@employeeDashboard')->name('EmployeeDashboard');
	});

	Route::group(['prefix' => 'client', 'as' => 'client.', 'middleware' => ['auth']], function ()
	{
		Route::get('/dashboard', 'DashboardController@clientDashboard')->name('ClientDashboard');
	});


	Route::get('/users-list', 'AllUserController@index')->name('users-list');
	// Route::get('/user-add', 'AllUserController@add_user_form')->name('add-user');
	Route::post('/user-add', 'AllUserController@add_user_process')->name('add-user');
	Route::get('/user-login-info', 'AllUserController@login_info')->name('login-info');
	Route::get('/user_roles', 'AllUserController@user_roles')->name('user-roles');
	Route::get('/user/edit/{id}', 'AllUserController@edit')->name('edit_user');
	Route::post('/update-user', 'AllUserController@process_update')->name('update-user');
	Route::get('/user/delete/{id}', 'AllUserController@delete_user')->name('delete_user');
	Route::post('/user-mass-delete', 'AllUserController@delete_by_selection')->name('delete_by_selection');
	Route::post('/assign_role/{user}', 'AssignRoleController@update')->name('assign_role');
	Route::post('/mass_assign', 'AssignRoleController@mass_update')->name('mass_assign_role');

	Route::prefix('staff')->group(function ()
	{
		{
			Route::post('employees/update', 'EmployeeController@update')->name('employees.update');
			Route::resource('employees', 'EmployeeController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('employees/{id}/delete', 'EmployeeController@destroy')->name('employees.destroy');
			Route::post('employees/delete/selected', 'EmployeeController@delete_by_selection')->name('mass_delete_employees');

			Route::get('employees/page/import', 'EmployeeController@import')->name('employees.import');
			Route::post('employees/page/import', 'EmployeeController@importPost')->name('employees.importPost');

			//Irfan
			Route::get('employees/filter', 'EmployeeController@employeesFilter')->name('employees.filter');
			Route::get('employees/pdf/{id}', 'EmployeeController@employeePDF')->name('employees.pdf');

            Route::post('employees/{employee}/pension_update', 'EmployeeController@employeesPensionUpdate')->name('employees.pension_update');
		}

		{
			Route::post('employees/{employee}/infoUpdate', 'EmployeeController@infoUpdate')->name('employees_basicInfo.update');
		}
		{
			Route::get('immigrations', 'EmployeeImmigrationController@index')->name('immigrations.index');
			Route::get('immigrations/{id}/edit', 'EmployeeImmigrationController@edit')->name('immigrations.edit');
			Route::get('immigrations/{employee}', 'EmployeeImmigrationController@show')->name('immigrations.show');
			Route::post('immigrations/update', 'EmployeeImmigrationController@update')->name('immigrations.update');
			Route::post('immigrations/{employee}/store', 'EmployeeImmigrationController@store')->name('immigrations.store');
			Route::get('immigrations/{id}/delete', 'EmployeeImmigrationController@destroy')->name('immigrations.destroy');
			Route::get('immigrations/document/download/{id}', 'EmployeeImmigrationController@download')->name('immigrations_document.download');
		}
		{
			Route::get('contacts', 'EmployeeContactController@index')->name('contacts.index');
			Route::get('contacts/{id}/edit', 'EmployeeContactController@edit')->name('contacts.edit');
			Route::get('contacts/{employee}', 'EmployeeContactController@show')->name('contacts.show');
			Route::post('contacts/update', 'EmployeeContactController@update')->name('contacts.update');
			Route::post('contacts/{employee}/store', 'EmployeeContactController@store')->name('contacts.store');
			Route::get('contacts/{id}/delete', 'EmployeeContactController@destroy')->name('contacts.destroy');
		}
		{
			Route::get('social_profile/{employee}', 'EmployeeSocialProfileController@show')->name('social_profile.show');
			Route::post('social_profile/{employee}/store', 'EmployeeController@storeSocialInfo')->name('social_profile.store');
		}
		{
			Route::post('profile_picture/{employee}/store', 'EmployeeController@storeProfilePicture')->name('profile_picture.store');
		}
		{
			Route::get('documents', 'EmployeeDocumentController@index')->name('documents.index');
			Route::get('documents/{id}/edit', 'EmployeeDocumentController@edit')->name('documents.edit');
			Route::get('documents/{employee}', 'EmployeeDocumentController@show')->name('documents.show');
			Route::post('documents/update', 'EmployeeDocumentController@update')->name('documents.update');
			Route::post('documents/{employee}/store', 'EmployeeDocumentController@store')->name('documents.store');
			Route::get('documents/{id}/delete', 'EmployeeDocumentController@destroy')->name('documents.destroy');
			Route::get('documents/document/download/{id}', 'EmployeeDocumentController@download')->name('documents_document.download');
		}
		{
			Route::get('qualifications', 'EmployeeQualificationController@index')->name('qualifications.index');
			Route::get('qualifications/{id}/edit', 'EmployeeQualificationController@edit')->name('qualifications.edit');
			Route::get('qualifications/{employee}', 'EmployeeQualificationController@show')->name('qualifications.show');
			Route::post('qualifications/update', 'EmployeeQualificationController@update')->name('qualifications.update');
			Route::post('qualifications/{employee}/store', 'EmployeeQualificationController@store')->name('qualifications.store');
			Route::get('qualifications/{id}/delete', 'EmployeeQualificationController@destroy')->name('qualifications.destroy');
		}
		{
			Route::get('work_experience', 'EmployeeWorkExperienceController@index')->name('work_experience.index');
			Route::get('work_experience/{id}/edit', 'EmployeeWorkExperienceController@edit')->name('work_experience.edit');
			Route::get('work_experience/{employee}', 'EmployeeWorkExperienceController@show')->name('work_experience.show');
			Route::post('work_experience/update', 'EmployeeWorkExperienceController@update')->name('work_experience.update');
			Route::post('work_experience/{employee}/store', 'EmployeeWorkExperienceController@store')->name('work_experience.store');
			Route::get('work_experience/{id}/delete', 'EmployeeWorkExperienceController@destroy')->name('work_experience.destroy');
		}
		{
			Route::get('bank_account', 'EmployeeBankAccountController@index')->name('bank_account.index');
			Route::get('bank_account/{id}/edit', 'EmployeeBankAccountController@edit')->name('bank_account.edit');
			Route::get('bank_account/{employee}', 'EmployeeBankAccountController@show')->name('bank_account.show');
			Route::post('bank_account/update', 'EmployeeBankAccountController@update')->name('bank_account.update');
			Route::post('bank_account/{employee}/store', 'EmployeeBankAccountController@store')->name('bank_account.store');
			Route::get('bank_account/{id}/delete', 'EmployeeBankAccountController@destroy')->name('bank_account.destroy');
		}
		{
			Route::post('employees/{employee}/storeSalary', 'EmployeeController@storeSalary')->name('employees_basicSalary.store');
		}
		{
            Route::get('salary_basic', 'SalaryBasicController@index')->name('salary_basic.index');
            Route::get('salary_basic/{employee}', 'SalaryBasicController@show')->name('salary_basic.show');
            Route::post('salary_basic/{employee}/store', 'SalaryBasicController@store')->name('salary_basic.store');
            Route::get('salary_basic/{id}/edit', 'SalaryBasicController@edit')->name('salary_basic.edit');
            Route::post('salary_basic/update', 'SalaryBasicController@update')->name('salary_basic.update');
            Route::get('salary_basic/{id}/delete', 'SalaryBasicController@destroy')->name('salary_basic.destroy');

		}
		{
			Route::get('salary_allowance', 'SalaryAllowanceController@index')->name('salary_allowance.index');
			Route::get('salary_allowance/{id}/edit', 'SalaryAllowanceController@edit')->name('salary_allowance.edit');
			Route::get('salary_allowance/{employee}', 'SalaryAllowanceController@show')->name('salary_allowance.show');
			Route::post('salary_allowance/update', 'SalaryAllowanceController@update')->name('salary_allowance.update');
			Route::post('salary_allowance/{employee}/store', 'SalaryAllowanceController@store')->name('salary_allowance.store');
			Route::get('salary_allowance/{id}/delete', 'SalaryAllowanceController@destroy')->name('salary_allowance.destroy');
		}
		{
			Route::get('salary_commission', 'SalaryCommissionController@index')->name('salary_commission.index');
			Route::get('salary_commission/{id}/edit', 'SalaryCommissionController@edit')->name('salary_commission.edit');
			Route::get('salary_commission/{employee}', 'SalaryCommissionController@show')->name('salary_commission.show');
			Route::post('salary_commission/update', 'SalaryCommissionController@update')->name('salary_commission.update');
			Route::post('salary_commission/{employee}/store', 'SalaryCommissionController@store')->name('salary_commission.store');
			Route::get('salary_commission/{id}/delete', 'SalaryCommissionController@destroy')->name('salary_commission.destroy');
		}
		{
			Route::get('salary_loan', 'SalaryLoanController@index')->name('salary_loan.index');
			Route::get('salary_loan/{id}/edit', 'SalaryLoanController@edit')->name('salary_loan.edit');
			Route::get('salary_loan/{employee}', 'SalaryLoanController@show')->name('salary_loan.show');
			Route::post('salary_loan/update', 'SalaryLoanController@update')->name('salary_loan.update');
			Route::post('salary_loan/{employee}/store', 'SalaryLoanController@store')->name('salary_loan.store');
			Route::get('salary_loan/{id}/delete', 'SalaryLoanController@destroy')->name('salary_loan.destroy');
		}
		{
			Route::get('salary_deduction', 'SalaryDeductionController@index')->name('salary_deduction.index');
			Route::get('salary_deduction/{id}/edit', 'SalaryDeductionController@edit')->name('salary_deduction.edit');
			Route::get('salary_deduction/{employee}', 'SalaryDeductionController@show')->name('salary_deduction.show');
			Route::post('salary_deduction/update', 'SalaryDeductionController@update')->name('salary_deduction.update');
			Route::post('salary_deduction/{employee}/store', 'SalaryDeductionController@store')->name('salary_deduction.store');
			Route::get('salary_deduction/{id}/delete', 'SalaryDeductionController@destroy')->name('salary_deduction.destroy');
		}
		{
			Route::get('other_payment', 'SalaryOtherPaymentController@index')->name('other_payment.index');
			Route::get('other_payment/{id}/edit', 'SalaryOtherPaymentController@edit')->name('other_payment.edit');
			Route::get('other_payment/{employee}', 'SalaryOtherPaymentController@show')->name('other_payment.show');
			Route::post('other_payment/update', 'SalaryOtherPaymentController@update')->name('other_payment.update');
			Route::post('other_payment/{employee}/store', 'SalaryOtherPaymentController@store')->name('other_payment.store');
			Route::get('other_payment/{id}/delete', 'SalaryOtherPaymentController@destroy')->name('other_payment.destroy');
		}
		{
			Route::get('salary_overtime', 'SalaryOvertimeController@index')->name('salary_overtime.index');
			Route::get('salary_overtime/{id}/edit', 'SalaryOvertimeController@edit')->name('salary_overtime.edit');
			Route::get('salary_overtime/{employee}', 'SalaryOvertimeController@show')->name('salary_overtime.show');
			Route::post('salary_overtime/update', 'SalaryOvertimeController@update')->name('salary_overtime.update');
			Route::post('salary_overtime/{employee}/store', 'SalaryOvertimeController@store')->name('salary_overtime.store');
			Route::get('salary_overtime/{id}/delete', 'SalaryOvertimeController@destroy')->name('salary_overtime.destroy');
		}
		{
			Route::get('employee_leave/{employee}', 'EmployeeLeaveController@index')->name('employee_leave.index');
			Route::get('employee_leave/details', 'EmployeeLeaveController@details')->name('employee_leave.details');
			Route::get('employee_leave/details/{id}', 'EmployeeLeaveController@show')->name('employee_leave.show');
		}
		{
			Route::get('employee_award/{employee}', 'EmployeeAwardController@index')->name('employee_award.index');
			Route::get('employee_award/details', 'EmployeeAwardController@details')->name('employee_award.details');
			Route::get('employee_award/details/{id}', 'EmployeeAwardController@show')->name('employee_award.show');
		}
		{
			Route::get('employee_travel/{employee}', 'EmployeeTravelController@index')->name('employee_travel.index');
			Route::get('employee_travel/details', 'EmployeeTravelController@details')->name('employee_travel.details');
			Route::get('employee_travel/details/{id}', 'EmployeeTravelController@show')->name('employee_travel.show');
		}
		{
			Route::get('employee_training/{employee}', 'EmployeeTrainingController@index')->name('employee_training.index');
			Route::get('employee_training/details', 'EmployeeTrainingController@details')->name('employee_training.details');
			Route::get('employee_training/details/{id}', 'EmployeeTrainingController@show')->name('employee_training.show');
		}
		{
			Route::get('employee_ticket/{employee}', 'EmployeeTicketController@index')->name('employee_ticket.index');
			Route::get('employee_ticket/details', 'EmployeeTicketController@details')->name('employee_ticket.details');
			Route::get('employee_ticket/details/{id}', 'EmployeeTicketController@show')->name('employee_ticket.show');
		}
		{
			Route::get('employee_transfer/{employee}', 'EmployeeTransferController@index')->name('employee_transfer.index');
			Route::get('employee_transfer/details', 'EmployeeTransferController@details')->name('employee_transfer.details');
			Route::get('employee_transfer/details/{id}', 'EmployeeTransferController@show')->name('employee_transfer.show');
		}
		{
			Route::get('employee_promotion/{employee}', 'EmployeePromotionController@index')->name('employee_promotion.index');
			Route::get('employee_promotion/details', 'EmployeePromotionController@details')->name('employee_promotion.details');
			Route::get('employee_promotion/details/{id}', 'EmployeePromotionController@show')->name('employee_promotion.show');
		}
		{
			Route::get('employee_complaint/{employee}', 'EmployeeComplaintController@index')->name('employee_complaint.index');
			Route::get('employee_complaint/details', 'EmployeeComplaintController@details')->name('employee_complaint.details');
			Route::get('employee_complaint/details/{id}', 'EmployeeComplaintController@show')->name('employee_complaint.show');
		}
		{
			Route::get('employee_warning/{employee}', 'EmployeeWarningController@index')->name('employee_warning.index');
			Route::get('employee_warning/details', 'EmployeeWarningController@details')->name('employee_warning.details');
			Route::get('employee_warning/details/{id}', 'EmployeeWarningController@show')->name('employee_warning.show');
		}
		{
			Route::get('employee_project/{employee}', 'EmployeeProjectController@index')->name('employee_project.index');
			Route::get('employee_project/details', 'EmployeeProjectController@details')->name('employee_project.details');
			Route::get('employee_project/details/{id}', 'EmployeeProjectController@show')->name('employee_project.show');
		}
		{
			Route::get('employee_task/{employee}', 'EmployeeTaskController@index')->name('employee_task.index');
			Route::get('employee_task/details', 'EmployeeTaskController@details')->name('employee_task.details');
			Route::get('employee_task/details/{id}', 'EmployeeTaskController@show')->name('employee_task.show');
		}
		{
			Route::get('employee_payslip/{employee}', 'EmployeePayslipController@index')->name('employee_payslip.index');
			Route::get('employee_payslip/details', 'EmployeePayslipController@details')->name('employee_payslip.details');
			Route::get('employee_payslip/details/{id}', 'EmployeePayslipController@show')->name('employee_payslip.show');
		}

	});

	Route::get('calendar/hr', 'CalendarableController@index')->name('calendar.index');
	Route::get('calendar/hr/load', 'CalendarableController@load')->name('calendar.load');

	Route::prefix('core_hr')->group(function ()
	{
		{
			Route::post('awards/update', 'AwardController@update')->name('awards.update');
			Route::resource('awards', 'AwardController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('awards/{id}/delete', 'AwardController@destroy')->name('awards.destroy');
			Route::post('awards/delete/selected', 'AwardController@delete_by_selection')->name('mass_delete_awards');
		}
		{
			Route::post('promotions/update', 'PromotionController@update')->name('promotions.update');
			Route::resource('promotions', 'PromotionController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('promotions/{id}/delete', 'PromotionController@destroy')->name('promotions.destroy');
			Route::post('promotions/delete/selected', 'PromotionController@delete_by_selection')->name('mass_delete_promotions');
		}
		{
			Route::post('travels/update', 'TravelController@update')->name('travels.update');
			Route::resource('travels', 'TravelController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('travels/{id}/delete', 'TravelController@destroy')->name('travels.destroy');
			Route::post('travels/delete/selected', 'TravelController@delete_by_selection')->name('mass_delete_travels');

			Route::get('travels/{id}/calendarable', 'TravelController@calendarableDetails')->name('travels.calendarable');

		}
		{
			Route::post('transfers/update', 'TransferController@update')->name('transfers.update');
			Route::resource('transfers', 'TransferController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('transfers/{id}/delete', 'TransferController@destroy')->name('transfers.destroy');
			Route::post('transfers/delete/selected', 'TransferController@delete_by_selection')->name('mass_delete_transfers');
		}
		{
			Route::post('resignations/update', 'ResignationController@update')->name('resignations.update');
			Route::resource('resignations', 'ResignationController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('resignations/{id}/delete', 'ResignationController@destroy')->name('resignations.destroy');
			Route::post('resignations/delete/selected', 'ResignationController@delete_by_selection')->name('mass_delete_resignations');
		}
		{
			Route::post('complaints/update', 'ComplaintController@update')->name('complaints.update');
			Route::resource('complaints', 'ComplaintController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('complaints/{id}/delete', 'ComplaintController@destroy')->name('complaints.destroy');
			Route::post('complaints/delete/selected', 'ComplaintController@delete_by_selection')->name('mass_delete_complaints');
		}
		{
			Route::post('warnings/update', 'WarningController@update')->name('warnings.update');
			Route::resource('warnings', 'WarningController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('warnings/{id}/delete', 'WarningController@destroy')->name('warnings.destroy');
			Route::post('warnings/delete/selected', 'WarningController@delete_by_selection')->name('mass_delete_warnings');
		}
		{
			Route::post('terminations/update', 'TerminationController@update')->name('terminations.update');
			Route::resource('terminations', 'TerminationController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('terminations/{id}/delete', 'TerminationController@destroy')->name('terminations.destroy');
			Route::post('terminations/delete/selected', 'TerminationController@delete_by_selection')->name('mass_delete_terminations');
		}
	});


	Route::prefix('report')->group(function ()
	{
        //New Added
        Route::get('attendances', 'AttendanceController@index')->name('attendances.index');
		Route::get('date_wise_attendances', 'AttendanceController@dateWiseAttendance')->name('date_wise_attendances.index');
		Route::get('monthly_attendances', 'AttendanceController@monthlyAttendance')->name('monthly_attendances.index');
        //New Added
        
		Route::get('payslip', 'ReportController@payslip')->name('report.payslip');
		Route::get('attendance', 'ReportController@attendance')->name('report.attendance');
		Route::get('training', 'ReportController@training')->name('report.training');
		Route::get('project', 'ReportController@project')->name('report.project');
		Route::get('task', 'ReportController@task')->name('report.task');
		Route::get('employees', 'ReportController@employees')->name('report.employees');
		Route::get('account', 'ReportController@account')->name('report.account');
		Route::get('expense', 'ReportController@expense')->name('report.expense');
		Route::get('deposit', 'ReportController@deposit')->name('report.deposit');
		Route::get('transaction', 'ReportController@transaction')->name('report.transaction');
		Route::get('pension', 'ReportController@pension')->name('report.pension');
	});

	Route::prefix('organization')->group(function ()
	{
		{
			Route::resource('locations', 'LocationController')->except([
				'create', 'show'
			]);

			Route::get('locations/edit/{id}', 'LocationController@edit')->name('locations.edit');
			Route::post('locations/update', 'LocationController@update')->name('locations.update');
			Route::get('locations/delete/{id}', 'LocationController@delete');
			Route::post('locations/delete/selected', 'LocationController@delete_by_selection')->name('mass_delete_location');
		}
		{
			Route::get('companies', 'CompanyController@index')->name('companies.index');
			Route::post('companies', 'CompanyController@store')->name('companies.store');
			Route::get('companies/{id}', 'CompanyController@show')->name('companies.show');
			Route::get('companies/edit/{id}', 'CompanyController@edit')->name('companies.edit');
			Route::post('companies/update', 'CompanyController@update')->name('companies.update');
			Route::get('companies/delete/{id}', 'CompanyController@destroy');
			Route::post('companies/delete/selected', 'CompanyController@delete_by_selection')->name('mass_delete_companies');
		}
		{
			Route::post('departments/update', 'DepartmentController@update')->name('departments.update');
			Route::resource('departments', 'DepartmentController')->except([
				'destroy', 'show', 'create', 'update'
			]);
			Route::get('departments/{id}/delete', 'DepartmentController@destroy')->name('departments.destroy');
			Route::post('departments/delete/selected', 'DepartmentController@delete_by_selection')->name('mass_delete_departments');
		}

		{
			Route::post('designations/update', 'DesignationController@update')->name('designations.update');
			Route::resource('designations', 'DesignationController')->except([
				'destroy', 'show', 'create', 'update'
			]);
			Route::get('designations/{id}/delete', 'DesignationController@destroy')->name('designations.destroy');
			Route::post('designations/delete/selected', 'DesignationController@delete_by_selection')->name('mass_delete_designations');
		}

		{
			Route::post('announcements/update', 'AnnouncementController@update')->name('announcements.update');
			Route::resource('announcements', 'AnnouncementController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('announcements/{id}/delete', 'AnnouncementController@destroy')->name('announcements.destroy');
			Route::post('announcements/delete/selected', 'AnnouncementController@delete_by_selection')->name('mass_delete_announcements');
		}

		{
			Route::post('policy/update', 'PolicyController@update')->name('policy.update');
			Route::resource('policy', 'PolicyController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('policy/{id}/delete', 'PolicyController@destroy')->name('policy.destroy');
			Route::post('policy/delete/selected', 'PolicyController@delete_by_selection')->name('mass_delete_policy');
		}

	});


	Route::prefix('core_hr')->group(function ()
	{

		{
			Route::post('awards/update', 'AwardController@update')->name('awards.update');
			Route::resource('awards', 'AwardController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('awards/{id}/delete', 'AwardController@destroy')->name('awards.destroy');
			Route::post('awards/delete/selected', 'AwardController@delete_by_selection')->name('mass_delete_awards');
		}
		{
			Route::post('promotions/update', 'PromotionController@update')->name('promotions.update');
			Route::resource('promotions', 'PromotionController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('promotions/{id}/delete', 'PromotionController@destroy')->name('promotions.destroy');
			Route::post('promotions/delete/selected', 'PromotionController@delete_by_selection')->name('mass_delete_promotions');
		}
		{
			Route::post('travels/update', 'TravelController@update')->name('travels.update');
			Route::resource('travels', 'TravelController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('travels/{id}/delete', 'TravelController@destroy')->name('travels.destroy');
			Route::post('travels/delete/selected', 'TravelController@delete_by_selection')->name('mass_delete_travels');

			Route::get('travels/{id}/calendarable', 'TravelController@calendarableDetails')->name('travels.calendarable');

		}
		{
			Route::post('transfers/update', 'TransferController@update')->name('transfers.update');
			Route::resource('transfers', 'TransferController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('transfers/{id}/delete', 'TransferController@destroy')->name('transfers.destroy');
			Route::post('transfers/delete/selected', 'TransferController@delete_by_selection')->name('mass_delete_transfers');
		}
		{
			Route::post('resignations/update', 'ResignationController@update')->name('resignations.update');
			Route::resource('resignations', 'ResignationController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('resignations/{id}/delete', 'ResignationController@destroy')->name('resignations.destroy');
			Route::post('resignations/delete/selected', 'ResignationController@delete_by_selection')->name('mass_delete_resignations');
		}
		{
			Route::post('complaints/update', 'ComplaintController@update')->name('complaints.update');
			Route::resource('complaints', 'ComplaintController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('complaints/{id}/delete', 'ComplaintController@destroy')->name('complaints.destroy');
			Route::post('complaints/delete/selected', 'ComplaintController@delete_by_selection')->name('mass_delete_complaints');
		}
		{
			Route::post('warnings/update', 'WarningController@update')->name('warnings.update');
			Route::resource('warnings', 'WarningController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('warnings/{id}/delete', 'WarningController@destroy')->name('warnings.destroy');
			Route::post('warnings/delete/selected', 'WarningController@delete_by_selection')->name('mass_delete_warnings');
		}
		{
			Route::post('terminations/update', 'TerminationController@update')->name('terminations.update');
			Route::resource('terminations', 'TerminationController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('terminations/{id}/delete', 'TerminationController@destroy')->name('terminations.destroy');
			Route::post('terminations/delete/selected', 'TerminationController@delete_by_selection')->name('mass_delete_terminations');
		}

	});


	Route::prefix('timesheet')->group(function ()
	{
		// Route::get('attendances', 'AttendanceController@index')->name('attendances.index');
		// Route::get('date_wise_attendances', 'AttendanceController@dateWiseAttendance')->name('date_wise_attendances.index');
		// Route::get('monthly_attendances', 'AttendanceController@monthlyAttendance')->name('monthly_attendances.index');

		Route::get('update_attendances', 'AttendanceController@updateAttendance')->name('update_attendances.index');
		Route::get('update_attendances/{id}/get', 'AttendanceController@updateAttendanceGet')->name('update_attendances.get');
		Route::post('update_attendances/store', 'AttendanceController@updateAttendanceStore')->name('update_attendances.store');
		Route::post('update_attendances/update', 'AttendanceController@updateAttendanceUpdate')->name('update_attendances.update');
		Route::get('update_attendances/{id}/delete', 'AttendanceController@updateAttendanceDelete')->name('update_attendances.delete');


		Route::get('attendances/page/import', 'AttendanceController@import')->name('attendances.import');
		Route::post('attendances/page/import', 'AttendanceController@importPost')->name('attendances.importPost');

		Route::post('attendance/employee/{id}', 'AttendanceController@employeeAttendance')->name('employee_attendance.post');

		{
			Route::post('office_shift/update', 'OfficeShiftController@update')->name('office_shift.update');
			Route::resource('office_shift', 'OfficeShiftController')->except([
				'destroy', 'update', 'show'
			]);
			Route::get('office_shift/{id}/delete', 'OfficeShiftController@destroy')->name('office_shift.destroy');
			Route::post('office_shift/delete/selected', 'OfficeShiftController@delete_by_selection')->name('mass_delete_office_shifts');
		}
		{
			Route::post('holidays/update', 'HolidayController@update')->name('holidays.update');
			Route::resource('holidays', 'HolidayController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('holidays/{id}/delete', 'HolidayController@destroy')->name('holidays.destroy');
			Route::post('holidays/delete/selected', 'HolidayController@delete_by_selection')->name('mass_delete_holidays');

			Route::get('holidays/{id}/calendarable', 'HolidayController@calendarableDetails')->name('holidays.calendarable');

		}
		{
			Route::post('leaves/update', 'LeaveController@update')->name('leaves.update');
			Route::resource('leaves', 'LeaveController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('leaves/{id}/delete', 'LeaveController@destroy')->name('leaves.destroy');
			Route::post('leaves/delete/selected', 'LeaveController@delete_by_selection')->name('mass_delete_leaves');

			Route::get('leaves/{id}/calendarable', 'LeaveController@calendarableDetails')->name('leaves.calendarable');
		}
	});

	Route::prefix('payroll')->group(function ()
	{
		Route::get('list', 'PayrollController@index')->name('payroll.index');
		Route::get('payslip', 'PayrollController@dummy')->name('paySlip.index');

		// Route::get('payslip/{id}', 'PayrollController@paySlip')->name('paySlip.show');
		Route::get('payslip_show', 'PayrollController@paySlip')->name('paySlip.show');

		Route::post('payslip/pay/{id}', 'PayrollController@payEmployee')->name('paySlip.pay');
		Route::post('payslip/payment/bulk', 'PayrollController@payBulk')->name('paySlip.bulk_pay');

		// Route::get('payslip/generate/{id}', 'PayrollController@paySlipGenerate')->name('paySlip.generate');
		Route::get('payslip/generate', 'PayrollController@paySlipGenerate')->name('paySlip.generate');

		Route::get('payment_history', 'PayslipController@index')->name('payment_history.index');
		Route::get('payslip/delete/{payslip}', 'PayslipController@delete')->name('payslip.destroy');
		Route::get('payslip/id/{payslip}', 'PayslipController@show')->name('payslip_details.show');
		Route::get('payslip/pdf/id/{payslip}', 'PayslipController@printPdf')->name('payslip.pdf');

	});

	Route::prefix('recruitment')->group(function ()
	{
		{
			Route::post('job_posts/update', 'JobPostController@update')->name('job_posts.update');
			Route::resource('job_posts', 'JobPostController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('job_posts/{id}/delete', 'JobPostController@destroy')->name('job_posts.destroy');
			Route::post('job_posts/delete/selected', 'JobPostController@delete_by_selection')->name('mass_delete_job_posts');
		}
		{
			Route::resource('job_candidates', 'JobCandidateController')->except([
				'destroy', 'create', 'update', 'store'
			]);
			Route::get('job_candidates/{id}/delete', 'JobCandidateController@destroy')->name('job_candidates.destroy');
		}
		{
			Route::post('job_interviews/update', 'JobInterviewController@update')->name('job_interviews.update');
			Route::resource('job_interviews', 'JobInterviewController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('job_interviews/{id}/delete', 'JobInterviewController@destroy')->name('job_interviews.destroy');
		}
		{
			Route::get('cms', 'CmsController@index')->name('cms.index');
			Route::post('cms', 'CmsController@store')->name('cms.store');
		}
	});


	Route::prefix('training')->group(function ()
	{
		{
			Route::post('training_lists/update', 'TrainingListController@update')->name('training_lists.update');
			Route::resource('training_lists', 'TrainingListController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('training_lists/{id}/delete', 'TrainingListController@destroy')->name('training_lists.destroy');
			Route::post('training_lists/delete/selected', 'TrainingListController@delete_by_selection')->name('mass_delete_training_lists');

			Route::get('training_lists/{id}/calendarable', 'TrainingListController@calendarableDetails')->name('training_lists.calendarable');

		}
		{
			Route::post('trainers/update', 'TrainerController@update')->name('trainers.update');
			Route::resource('trainers', 'TrainerController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('trainers/{id}/delete', 'TrainerController@destroy')->name('trainers.destroy');
			Route::post('trainers/delete/selected', 'TrainerController@delete_by_selection')->name('mass_delete_trainers');
		}
	});

	Route::prefix('accounting')->group(function ()
	{
		{
			Route::post('accounting_list/update', 'AccountListController@update')->name('accounting_list.update');
			Route::resource('accounting_list', 'AccountListController')->except([
				'destroy', 'create', 'update', 'show'
			]);
			Route::get('accounting_list/{id}/delete', 'AccountListController@destroy')->name('accounting_list.destroy');
			Route::post('accounting_list/delete/selected', 'AccountListController@delete_by_selection')->name('mass_delete_accounting_list');

			Route::get('account_balances', 'AccountListController@accountBalance')->name('account_balances');

		}
		{
			Route::post('payees/update', 'FinancePayeeController@update')->name('payees.update');
			Route::get('payees/{id}/delete', 'FinancePayeeController@destroy')->name('payees.destroy');
			Route::resource('payees', 'FinancePayeeController')->except([
				'create', 'update', 'destroy', 'show']);
		}
		{
			Route::post('payers/update', 'FinancePayerController@update')->name('payers.update');
			Route::get('payers/{id}/delete', 'FinancePayerController@destroy')->name('payers.destroy');
			Route::resource('payers', 'FinancePayerController')->except([
				'create', 'update', 'destroy', 'show']);
		}
		{
			Route::post('deposit/update', 'FinanceDepositController@update')->name('deposit.update');
			Route::resource('deposit', 'FinanceDepositController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('deposit/{id}/delete', 'FinanceDepositController@destroy')->name('deposit.destroy');
			Route::get('deposit/download', 'FinanceDepositController@download')->name('deposit.download');
			Route::get('deposit/download/{id}', 'FinanceDepositController@download')->name('deposit.downloadFile');
		}
		{
			Route::post('expense/update', 'FinanceExpenseController@update')->name('expense.update');
			Route::resource('expense', 'FinanceExpenseController')->except([
				'destroy', 'create', 'update'
			]);
			Route::get('expense/{id}/delete', 'FinanceExpenseController@destroy')->name('expense.destroy');
			Route::get('expense/download', 'FinanceExpenseController@download')->name('expense.download');
			Route::get('expense/download/{id}', 'FinanceExpenseController@download')->name('expense.downloadFile');
		}

		{
			Route::resource('finance_transfer', 'FinanceTransferController')->except([
				'destroy', 'create', 'update', 'show', 'edit'
			]);
		}

		Route::get('transactions', 'FinanceTransactionsController@index')->name('transactions.index');
		Route::get('transactions/{id}/show', 'FinanceTransactionsController@show')->name('transactions.show');

	});

	{
		Route::post('assets/update', 'AssetController@update')->name('assets.update');
		Route::resource('assets', 'AssetController')->except([
			'destroy', 'create', 'update'
		]);
		Route::get('assets/{id}/delete', 'AssetController@destroy')->name('assets.destroy');
		Route::get('assets/download', 'AssetController@download')->name('assets.download');
		Route::get('assets/download/{id}', 'AssetController@download')->name('assets.downloadFile');
		Route::post('assets/delete/selected', 'AssetController@delete_by_selection')->name('mass_delete_assets');
	}


	Route::post('events/update', 'EventController@update')->name('events.update');
	Route::resource('events', 'EventController')->except([
		'destroy', 'create', 'update'
	]);
	Route::get('events/{id}/delete', 'EventController@destroy')->name('events.destroy');
	Route::post('events/delete/selected', 'EventController@delete_by_selection')->name('mass_delete_events');

	Route::get('events/{id}/calendarable', 'EventController@calendarableDetails')->name('events.calendarable');

	Route::post('meetings/update', 'MeetingController@update')->name('meetings.update');
	Route::resource('meetings', 'MeetingController')->except([
		'destroy', 'create', 'update'
	]);
	Route::get('meetings/{id}/delete', 'MeetingController@destroy')->name('meetings.destroy');
	Route::post('meetings/delete/selected', 'MeetingController@delete_by_selection')->name('mass_delete_meetings');

	Route::get('meetings/{id}/calendarable', 'MeetingController@calendarableDetails')->name('meetings.calendarable');



	Route::post('tickets/update', 'SupportTicketController@update')->name('tickets.update');
	Route::resource('tickets', 'SupportTicketController')->except([
		'destroy', 'create', 'update'
	]);
	Route::post('tickets/{ticket}/assigned', 'EmployeeAssignedController@employeeTicketAssigned')->name('tickets.assigned');
	Route::get('tickets/{id}/delete', 'SupportTicketController@destroy')->name('tickets.destroy');
	Route::get('tickets/download/{id}', 'SupportTicketController@download')->name('tickets.downloadTicket');
	Route::post('tickets/delete/selected', 'SupportTicketController@delete_by_selection')->name('mass_delete_tickets');
	Route::post('tickets/{ticket}/comments', 'SupportTicketCommentController@index')->name('ticket_comments.index');
	Route::post('tickets/store_comments/{ticket}', 'SupportTicketCommentController@store')->name('ticket_comments.store');
	Route::get('tickets/{id}/delete_comments', 'SupportTicketCommentController@destroy')->name('ticket_comments.destroy');
	Route::post('tickets/{ticket}/details', 'SupportTicketController@detailsStore')->name('ticket_details.store');
	Route::post('tickets/{ticket}/notes', 'SupportTicketController@notesStore')->name('ticket_notes.store');

	Route::prefix('project-management')->group(function ()
	{
		Route::post('projects/{project}/assigned', 'EmployeeAssignedController@employeeProjectAssigned')->name('projects.assigned');
		Route::post('projects/update', 'ProjectController@update')->name('projects.update');
		Route::resource('projects', 'ProjectController')->except([
			'destroy', 'create', 'update'
		]);
		Route::get('projects/{id}/delete', 'ProjectController@destroy')->name('projects.destroy');

		Route::get('projects/{id}/calendarable', 'ProjectController@calendarableDetails')->name('projects.calendarable');


		Route::post('projects/{project}/progress', 'ProjectController@progressStore')->name('project_progress.store');

		Route::post('projects/{project}/discussions', 'ProjectDiscussionController@index')->name('project_discussions.index');
		Route::post('projects/store_discussions/{project}', 'ProjectDiscussionController@store')->name('project_discussions.store');
		Route::get('projects/{id}/delete_discussions', 'ProjectDiscussionController@destroy')->name('project_discussions.destroy');

		Route::post('projects/{project}/bugs', 'ProjectBugController@index')->name('project_bugs.index');
		Route::post('projects/store_bugs/{project}', 'ProjectBugController@store')->name('project_bugs.store');

		Route::post('projects/{project}/files', 'ProjectFileController@index')->name('project_files.index');
		Route::post('projects/store_files/{project}', 'ProjectFileController@store')->name('project_files.store');
		Route::get('projects/{id}/delete_files', 'ProjectFileController@destroy')->name('project_files.destroy');

		Route::post('projects/{project}/tasks', 'ProjectTaskController@index')->name('project_tasks.index');
		Route::post('projects/store_tasks/{project}', 'ProjectTaskController@store')->name('project_tasks.store');
		Route::get('projects/{id}/delete_tasks', 'ProjectTaskController@destroy')->name('project_tasks.destroy');


		Route::get('projects/bug_status', 'ProjectBugController@default')->name('bug_status.default');
		Route::get('projects/bug_status/{id}', 'ProjectBugController@editStatus')->name('bug_status.edit');
		Route::post('projects/bug_status/update', 'ProjectBugController@updateStatus')->name('bug_status.update');
		Route::get('projects/{id}/delete_bugs', 'ProjectBugController@destroy')->name('project_bugs.destroy');
		Route::get('projects/discussion_download/{id}', 'ProjectDiscussionController@download')->name('projects.downloadAttachment');
		Route::get('projects/bug_download/{id}', 'ProjectBugController@download')->name('projects.downloadBug');
		Route::get('projects/file_download/{id}', 'ProjectFileController@download')->name('projects.downloadFile');
		Route::post('projects/{project}/notes', 'ProjectController@notesStore')->name('project_notes.store');

		Route::post('tasks/{task}/assigned', 'EmployeeAssignedController@employeeTaskAssigned')->name('tasks.assigned');
		Route::post('tasks/update', 'TaskController@update')->name('tasks.update');
		Route::resource('tasks', 'TaskController')->except([
			'destroy', 'create', 'update'
		]);
		Route::get('tasks/{id}/delete', 'TaskController@destroy')->name('tasks.destroy');

		Route::get('tasks/{id}/calendarable', 'TaskController@calendarableDetails')->name('tasks.calendarable');

		Route::post('tasks/{task}/progress', 'TaskController@progressStore')->name('task_progress.store');

		Route::post('tasks/{task}/discussions', 'TaskDiscussionController@index')->name('task_discussions.index');
		Route::post('tasks/store_discussions/{task}', 'TaskDiscussionController@store')->name('task_discussions.store');
		Route::get('tasks/{id}/delete_discussions', 'TaskDiscussionController@destroy')->name('task_discussions.destroy');

		Route::post('tasks/{task}/files', 'TaskFileController@index')->name('task_files.index');
		Route::post('tasks/store_files/{task}', 'TaskFileController@store')->name('task_files.store');
		Route::get('tasks/{id}/delete_files', 'TaskFileController@destroy')->name('task_files.destroy');

		Route::get('tasks/file_download/{id}', 'TaskFileController@download')->name('tasks.downloadFile');
		Route::post('tasks/{task}/notes', 'TaskController@notesStore')->name('task_notes.store');

		{
			Route::post('invoices/{id}/update', 'InvoiceController@update')->name('invoices.update');
			Route::resource('invoices', 'InvoiceController')->except([
				'destroy', 'update'
			]);
			Route::get('invoices/status/{status_id}/{invoice_id}', 'InvoiceController@status')->name('invoices.status');
			Route::get('invoices/{id}/delete', 'InvoiceController@destroy')->name('invoices.destroy');
			Route::get('invoices/download', 'InvoiceController@download')->name('invoices.download');
			Route::get('invoices/download/{id}', 'InvoiceController@download')->name('invoices.downloadFile');
			Route::post('invoices/delete/selected', 'InvoiceController@delete_by_selection')->name('mass_delete_invoices');
		}


		Route::post('clients/update', 'ClientController@update')->name('clients.update');
		Route::resource('clients', 'ClientController')->except([
			'destroy', 'create', 'update', 'show'
		]);
		Route::get('clients/{id}/delete', 'ClientController@destroy')->name('clients.destroy');
		Route::post('clients/delete/selected', 'ClientController@delete_by_selection')->name('mass_delete_clients');
	});


	Route::post('dynamic_dependent/fetch_department', 'DynamicDependent@fetchDepartment')->name('dynamic_department');
	Route::post('dynamic_dependent/fetch_employee', 'DynamicDependent@fetchEmployee')->name('dynamic_employee');
	Route::post('dynamic_dependent/fetch_employee_department', 'DynamicDependent@fetchEmployeeDepartment')->name('dynamic_employee_department');
	Route::post('dynamic_dependent/fetch_designation_department', 'DynamicDependent@fetchDesignationDepartment')->name('dynamic_designation_department');
	Route::post('dynamic_dependent/fetch_office_shifts', 'DynamicDependent@fetchOfficeShifts')->name('dynamic_office_shifts');
	Route::post('dynamic_dependent/fetch_balance', 'DynamicDependent@fetchBalance')->name('dynamic_balance');
	Route::post('dynamic_dependent/company_employee/{ticket}', 'DynamicDependent@companyEmployee')->name('company_employee');
	Route::post('dynamic_dependent/get_tax_rate', 'DynamicDependent@getTaxRate')->name('dynamic_tax_rate');
	Route::post('dynamic_dependent/fetch_candidate', 'DynamicDependent@fetchCandidate')->name('dynamic_candidate');


//Route::resource('employees', 'EmployeeController');

	Route::prefix('settings')->group(function ()
	{
		{
			Route::resource('roles', 'RoleController');

			Route::get('/roles/{id}/delete', 'RoleController@destroy')->name('roles.destroy');

			Route::get('roles/role-permission/{id}', 'PermissionController@rolePermission')->name('rolePermission');

			Route::get('roles/permission_details/{id}', 'PermissionController@permissionDetails')->name('permissionDetails');

			Route::post('roles/permission', 'PermissionController@set_permission')->name('set_permission');

			Route::post('general_settings/update/{id}', 'GeneralSettingController@update')->name('general_settings.update');

			Route::resource('general_settings', 'GeneralSettingController')->except([
				'create', 'edit', 'show', 'update']);

			Route::get('mail_setting', 'GeneralSettingController@mailSetting')->name('setting.mail');

			Route::post('setting/mail_setting_store', 'GeneralSettingController@mailSettingStore')->name('setting.mailStore');

			Route::get('general_settings/change-theme/{theme}', 'GeneralSettingController@change_theme')->name('change_theme');

			Route::resource('variables', 'Variables\VariableController')->only([
				'index']);

			Route::resource('variables_method', 'Variables\VariableMethodController')->only([
				'index']);

			Route::get('/empty_database', 'GeneralSettingController@emptyDatabase')->name('empty_database');
			Route::get('/export_database', 'GeneralSettingController@exportDatabase')->name('export_database');

			//IP Settings
			Route::group(['prefix' => 'ip_settings'], function () {
				Route::get('/', 'IPSettingController@index')->name('ip_setting.index');
				Route::post('/store', 'IPSettingController@store')->name('ip_setting.store');
				Route::get('/edit', 'IPSettingController@edit')->name('ip_setting.edit');
				Route::post('/update', 'IPSettingController@update')->name('ip_setting.update');
				Route::get('/delete', 'IPSettingController@delete')->name('ip_setting.delete');
				Route::get('/bulk_delete', 'IPSettingController@bulkDelete')->name('ip_setting.bulk_delete');
			});

		}
	});

	Route::prefix('dynamic_variable')->group(function ()
	{
		Route::post('leave_type/update', 'Variables\LeaveTypeController@update')->name('leave_type.update');
		Route::get('leave_type/{id}/delete', 'Variables\LeaveTypeController@destroy')->name('leave_type.destroy');
		Route::resource('leave_type', 'Variables\LeaveTypeController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('award_type/update', 'Variables\AwardTypeController@update')->name('award_type.update');
		Route::get('award_type/{id}/delete', 'Variables\AwardTypeController@destroy')->name('award_type.destroy');
		Route::resource('award_type', 'Variables\AwardTypeController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('warning_type/update', 'Variables\WarningTypeController@update')->name('warning_type.update');
		Route::get('warning_type/{id}/delete', 'Variables\WarningTypeController@destroy')->name('warning_type.destroy');
		Route::resource('warning_type', 'Variables\WarningTypeController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('termination_type/update', 'Variables\TerminationTypeController@update')->name('termination_type.update');
		Route::get('termination_type/{id}/delete', 'Variables\TerminationTypeController@destroy')->name('termination_type.destroy');
		Route::resource('termination_type', 'Variables\TerminationTypeController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('status_type/update', 'Variables\StatusTypeController@update')->name('status_type.update');
		Route::get('status_type/{id}/delete', 'Variables\StatusTypeController@destroy')->name('status_type.destroy');
		Route::resource('status_type', 'Variables\StatusTypeController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('training_type/update', 'Variables\TrainingTypeController@update')->name('training_type.update');
		Route::get('training_type/{id}/delete', 'Variables\TrainingTypeController@destroy')->name('training_type.destroy');
		Route::resource('training_type', 'Variables\TrainingTypeController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('tax_type/update', 'Variables\TaxTypeController@update')->name('tax_type.update');
		Route::get('tax_type/{id}/delete', 'Variables\TaxTypeController@destroy')->name('tax_type.destroy');
		Route::resource('tax_type', 'Variables\TaxTypeController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('expense_type/update', 'Variables\ExpenseTypeController@update')->name('expense_type.update');
		Route::get('expense_type/{id}/delete', 'Variables\ExpenseTypeController@destroy')->name('expense_type.destroy');
		Route::resource('expense_type', 'Variables\ExpenseTypeController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('assets_category/update', 'Variables\AssetCategoryController@update')->name('assets_category.update');
		Route::get('assets_category/{id}/delete', 'Variables\AssetCategoryController@destroy')->name('assets_category.destroy');
		Route::resource('assets_category', 'Variables\AssetCategoryController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('document_type/update', 'Variables\DocumentTypeController@update')->name('document_type.update');
		Route::get('document_type/{id}/delete', 'Variables\DocumentTypeController@destroy')->name('document_type.destroy');
		Route::resource('document_type', 'Variables\DocumentTypeController')->except([
			'create', 'update', 'destroy', 'show']);


	});

	Route::prefix('dynamic_variable_method')->group(function ()
	{
		Route::post('travel_method/update', 'Variables\TravelMethodController@update')->name('travel_method.update');
		Route::get('travel_method/{id}/delete', 'Variables\TravelMethodController@destroy')->name('travel_method.destroy');
		Route::resource('travel_method', 'Variables\TravelMethodController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('payment_method/update', 'Variables\PaymentMethodController@update')->name('payment_method.update');
		Route::get('payment_method/{id}/delete', 'Variables\PaymentMethodController@destroy')->name('payment_method.destroy');
		Route::resource('payment_method', 'Variables\PaymentMethodController')->except([
			'create', 'update', 'destroy', 'show']);


		Route::get('employee_qualification', 'Variables\QualificationEducationLevelController@index')->name('employee_qualification.index');

		Route::post('education_level/update', 'Variables\QualificationEducationLevelController@update')->name('education_level.update');
		Route::get('education_level/{id}/delete', 'Variables\QualificationEducationLevelController@destroy')->name('education_level.destroy');
		Route::resource('education_level', 'Variables\QualificationEducationLevelController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('language_skill/update', 'Variables\QualificationLanguageController@update')->name('language_skill.update');
		Route::get('language_skill/{id}/delete', 'Variables\QualificationLanguageController@destroy')->name('language_skill.destroy');
		Route::resource('language_skill', 'Variables\QualificationLanguageController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('general_skill/update', 'Variables\QualificationSkillController@update')->name('general_skill.update');
		Route::get('general_skill/{id}/delete', 'Variables\QualificationSkillController@destroy')->name('general_skill.destroy');
		Route::resource('general_skill', 'Variables\QualificationSkillController')->except([
			'create', 'update', 'destroy', 'show']);

		Route::post('job_categories/update', 'Variables\JobCategoryController@update')->name('job_categories.update');
		Route::get('job_categories/{id}/delete', 'Variables\JobCategoryController@destroy')->name('job_categories.destroy');
		Route::resource('job_categories', 'Variables\JobCategoryController')->except([
			'create', 'update', 'destroy', 'show']);

	});

	Route::prefix('file_manager')->group(function ()
	{
		Route::post('files/update', 'FileManagerController@update')->name('files.update');
		Route::resource('files', 'FileManagerController')->except([
			'destroy', 'create', 'update', 'show'
		]);
		Route::get('files/{id}/delete', 'FileManagerController@destroy')->name('files.destroy');
		Route::get('files/new/download/{id}', 'FileManagerController@download')->name('files.downloadFile');
		Route::post('files/delete/selected', 'FileManagerController@delete_by_selection')->name('mass_delete_files');

		Route::post('official_documents/update', 'OfficialDocumentController@update')->name('official_documents.update');
		Route::resource('official_documents', 'OfficialDocumentController')->except([
			'destroy', 'create', 'update', 'show'
		]);
		Route::get('official_documents/{id}/delete', 'OfficialDocumentController@destroy')->name('official_documents.destroy');
		Route::get('official_documents/new/download/{id}', 'OfficialDocumentController@download')->name('official_documents.downloadFile');
		Route::post('official_documents/delete/selected', 'OfficialDocumentController@delete_by_selection')->name('mass_delete_official_documents');


		Route::get('file_config', 'Variables\FileManagerSettingController@index')->name('file_config.index');
		Route::post('file_config', 'Variables\FileManagerSettingController@store')->name('file_config.store');

	});

	Route::get('/client/profile', 'DashboardController@clientProfile')->name('clientProfile');
	Route::get('/client/invoices', 'ClientInvoiceController@invoices')->name('clientInvoice');
	Route::get('/client/invoices/payment', 'ClientInvoiceController@paidInvoices')->name('clientInvoicePaid');
	Route::get('/client/projects', 'ClientProjectController@index')->name('clientProject');
	Route::post('/client/projects/store', 'ClientProjectController@store')->name('clientProject.store');
	Route::get('/client/projects/status', 'ClientProjectController@status')->name('clientProjectStatus');
	Route::get('/client/tasks', 'ClientTaskController@index')->name('clientTask');
	Route::post('/client/tasks', 'ClientTaskController@store')->name('clientTask.store');
	Route::get('/client/tasks/{id}/edit', 'ClientTaskController@edit')->name('clientTask.edit');
	Route::post('/client/tasks/update', 'ClientTaskController@update')->name('clientTask.update');

	//Performance Feature By - Md Irfan Chowdhury

	Route::group(['prefix' => 'performance','namespace'=>'Performance'], function (){

		Route::group(['prefix' => 'goal-type'], function () {
			Route::get('/index', 'GoalTypeController@index')->name('performance.goal-type.index');
			Route::post('/store', 'GoalTypeController@store')->name('performance.goal-type.store');
			Route::get('/edit', 'GoalTypeController@edit')->name('performance.goal-type.edit');
			Route::post('/update', 'GoalTypeController@update')->name('performance.goal-type.update');
			Route::get('/delete', 'GoalTypeController@delete')->name('performance.goal-type.delete');
			Route::get('/delete-checkbox', 'GoalTypeController@deleteCheckbox')->name('performance.goal-type.delete.checkbox');
		});

		Route::group(['prefix' => 'goal-tracking'], function () {
			Route::get('/index', 'GoalTrackingController@index')->name('performance.goal-tracking.index');
			Route::post('/store', 'GoalTrackingController@store')->name('performance.goal-tracking.store');
			Route::get('/edit', 'GoalTrackingController@edit')->name('performance.goal-tracking.edit');
			Route::post('/update', 'GoalTrackingController@update')->name('performance.goal-tracking.update');
			Route::get('/delete', 'GoalTrackingController@delete')->name('performance.goal-tracking.delete');
			Route::get('/delete-checkbox', 'GoalTrackingController@deleteCheckbox')->name('performance.goal-tracking.delete.checkbox');
		});

		Route::group(['prefix' => 'indicator'], function () {
			Route::get('/index', 'IndicatorController@index')->name('performance.indicator.index');
			Route::get('/get-designation', 'IndicatorController@getDesignationByComapny')->name('performance.indicator.get-designation-by-company');
			Route::post('/store', 'IndicatorController@store')->name('performance.indicator.store');
			Route::get('/edit', 'IndicatorController@edit')->name('performance.indicator.edit');
			Route::post('/update', 'IndicatorController@update')->name('performance.indicator.update');
			Route::get('/delete', 'IndicatorController@delete')->name('performance.indicator.delete');
			Route::get('/delete-checkbox', 'IndicatorController@deleteCheckbox')->name('performance.indicator.delete.checkbox');
		});

		Route::group(['prefix' => 'appraisal'], function () {
			Route::get('/index', 'AppraisalController@index')->name('performance.appraisal.index');
			Route::get('/get-employee','AppraisalController@getEmployee')->name('performance.appraisal.get-employee');
			Route::post('/store','AppraisalController@store')->name('performance.appraisal.store');
			Route::get('/edit','AppraisalController@edit')->name('performance.appraisal.edit');
			Route::post('/update','AppraisalController@update')->name('performance.appraisal.update');
			Route::get('/delete','AppraisalController@delete')->name('performance.appraisal.delete');
			Route::get('/delete-checkbox', 'AppraisalController@deleteCheckbox')->name('performance.appraisal.delete.checkbox');
		});
	});

});
//
//Route::group(['prefix' => 'api', 'middleware' => 'auth'], function ()
//{
//	Route::get('find', function (Illuminate\Http\Request $request)
//	{
//		$keyword = $request->input('keyword');
//		Log::info($keyword);
//		$names = DB::table('employees')->where('first_name', 'like', '%' . $keyword . '%')
//			->orWhere('last_name', 'like', '%' . $keyword . '%')
//			->select('employees.id', DB::raw("CONCAT(employees.first_name,' ',employees.last_name) as full_name"))
//			->get();
//
//		return json_encode($names);
//	})->name('api.names');
//});


//Employeer
//Set Null





