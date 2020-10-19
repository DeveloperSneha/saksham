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
      return view('pages.home');
  });

  Route::get('/', 'MainController@index')->name('home');
  Route::get('/pass', 'MainController@generatePassword');
  Route::get('/about', 'MainController@aboutUs');
  Route::get('/scroll', 'MainController@scroll');
  Route::get('/schemes/{id_scheme}', 'MainController@viewJobRole');
  Route::get('/schemes/{id_scheme}/{id_jobrole}', 'MainController@viewJobRoleOverview'); //
  Route::get('/explore_course', 'MainController@exploreCourses');
  Route::get('/explore_course/scheme/{idScheme}', 'MainController@viewSchemeCourses');
  Route::get('/explore_course/district/{iddistrict}', 'MainController@viewDistrictCourses');
  Route::get('/contact_officers', 'MainController@viewOfficersContact');

  Route::get('/state/{id_state}/university', 'MainController@getUniversity');
  Route::get('/sector/{id_sector}/jobrole', 'MainController@getJobRole');
  Route::get('/state/{id_state}/districts', 'MainController@getDistricts');
  Route::get('/district/{id_district}/subdistricts', 'MainController@getSubdistricts');
  Route::get('/states/{id_state}/districts', 'Company\JobController@getStateDistricts');
  Route::get('/alumini', 'MainController@showAluminiForm');
  Route::post('/alumini', 'MainController@saveAlumini')->name('alumini.submit');

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Auth::routes();

Route::get('/admin/export', 'Admin\AdminController@exportData');
Route::get('/admin/import', 'Admin\AdminController@importData');
Route::get('/admin/add_notification', 'Admin\AdminController@addNotification');
Route::post('/admin/add_notification', 'Admin\AdminController@saveNotification');
Route::get('/admin/home', 'Admin\AdminController@index');
Route::get('/admin/companies', 'Admin\AdminController@companies');
Route::get('/admin/applied', 'Admin\AdminController@applied');
Route::get('/admin/activated', 'Admin\AdminController@jobActivated');
Route::get('/admin/job/{idJob}/edit', 'Admin\AdminController@jobEdit');
Route::post('/admin/job/{idJob}/edit', 'Admin\AdminController@jobUpdate')->name('editjob.update');
Route::get('/admin/job/{idJob}/activated', 'Admin\AdminController@jobActivation');
Route::get('/admin/job/{idJob}/deactivated', 'Admin\AdminController@jobDeactivation');
Route::get('/admin/deactivated', 'Admin\AdminController@jobDeactivated');
Route::get('/admin/mentors', 'Admin\AdminController@mentors');
Route::get('/admin/candidates/{id}/details', 'Admin\AdminController@candidateDetails');
Route::get('/admin/candidates', 'Admin\AdminController@candidates');
//Reports
Route::get('/admin/reports/applied', 'Admin\AdminReportController@appliedList');
Route::get('/admin/reports/mentors', 'Admin\AdminReportController@mentorList');
Route::get('/admin/reports/candidates', 'Admin\AdminReportController@candidateList');
Route::get('/admin/reports/companies', 'Admin\AdminReportController@companyList');
Route::get('/admin/reports/jobs', 'Admin\AdminReportController@jobList');

Route::get('/admin/candidate/{idCandidate}/delete','Admin\AdminController@destroyCandidate');
Route::get('/admin/company/{idCompany}/delete','Admin\AdminController@destroyCompany');
Route::get('/admin/mentor/{idMentor}/delete','Admin\AdminController@destroyMentor');

Route::group(['middleware' => ['auth']], function() {
    // Route::get('/home','MainController@getSakshamDarpan');
  Route::prefix('admin')->group(function() {
    Route::get('/', 'Admin\AdminController@dashboard');
  });
});

Route::prefix('candidate')->group(function() {

  Route::get('/register', 'Auth\CandidateRegisterController@showRegistrationForm')->name('candidate.register');
  Route::post('/register', 'Auth\CandidateRegisterController@register')->name('candidate.register.submit');
  Route::get('/enrol/{course_id}', 'Auth\CandidateRegisterController@showEnrolForm');
  Route::post('/enrol/', 'Auth\CandidateRegisterController@saveEnrolData');
  Route::get('/login', 'Auth\CandidateLoginController@showLoginForm')->name('candidate.login');
  Route::post('/login', 'Auth\CandidateLoginController@login')->name('candidate.login.submit');  
  Route::post('/logout', 'Auth\CandidateLoginController@logout')->name('candidate.logout');
  
  Route::get('/', 'Candidate\CandidateController@index')->name('candidate.dashboard');
  Route::get('/profile','Candidate\CandidateController@profile');  
  Route::get('/editprofile','Candidate\CandidateController@EditProfile');
  Route::post('/editprofile','Candidate\CandidateController@UpdateProfile')->name('candidateprofile.update');

  Route::get('/jobs','Candidate\CandidateController@getJobs');
  Route::get('/job/{idJob}/details','Candidate\CandidateController@viewJobDetails');
  Route::post('/job/{idJob}/details', 'Candidate\CandidateController@SaveAppliedJob');
  Route::get('/scheme/{idScheme}/jobs','Candidate\CandidateController@getSchemeJobs');
  Route::get('/applied','Candidate\CandidateController@viewAppliedJobs');
  Route::get('/mentors','Candidate\CandidateController@viewMentors');
  Route::get('/mentors/{id}/view','Candidate\CandidateController@viewMentorsDetails');
  Route::get('/chat','Candidate\CandidateController@showChat');
  
  Route::get('/chat/{id}','Candidate\CandidateController@chatWithMentor');
  Route::post('/chat/{id}','Candidate\CandidateController@storeChat');
  Route::get('/existaadhar', 'MainController@getCandidatewithAadhar');
  Route::get('/existmobile', 'MainController@getCandidatewithMobileNo');

  // Resetting Password
  Route::post('password/email', 'Candidate\ForgotPasswordController@sendResetLinkEmail');
  Route::get('password/reset', 'Candidate\ForgotPasswordController@showLinkRequestForm');
  Route::post('password/reset', 'Candidate\ResetPasswordController@reset');
  Route::get('password/reset/{token}', 'Candidate\ResetPasswordController@showResetForm')->name('candidate.password.reset');
  Route::get('/chpass', 'Candidate\CandidateController@editPassword');
  Route::post('/chpass', 'Candidate\CandidateController@updatePassword');

});

Route::prefix('company')->group(function() {
  Route::get('/home', 'MainController@getCompany');
  Route::get('/scheme/{idScheme}','MainController@getSchemeWiseJobs');
  Route::get('/sector/{idSector}','MainController@getSectorWiseJobs');
  Route::get('/other_sch','MainController@getOtherSchemes');
  Route::get('/home/state','MainController@getStateWiseJobs');
  Route::get('/job/{idJob}','MainController@getJobDetails');
  

  Route::get('/register', 'Auth\CompanyRegisterController@showRegistrationForm')->name('company.register');
  Route::post('/register', 'Auth\CompanyRegisterController@register')->name('company.register.submit');
  Route::get('/login', 'Auth\CompanyLoginController@showLoginForm')->name('company.login');
  Route::post('/login', 'Auth\CompanyLoginController@login')->name('company.login.submit');
  Route::post('/logout', 'Auth\CompanyLoginController@logout')->name('company.logout');
  Route::get('/', 'Company\CompanyController@index')->name('company.dashboard');
  Route::get('/profile','Company\CompanyController@Profile');
  Route::get('/editprofile','Company\CompanyController@EditProfile');
  Route::post('/editprofile','Company\CompanyController@UpdateProfile')->name('editprofile.update');
    
  Route::get('/jobs','Company\JobController@create');
  Route::get('/job/{idJob}/editloc','Company\JobController@editLoc');
  Route::post('/job/{idJob}/editloc','Company\JobController@updateLoc');
  Route::get('/job/{idJob}/viewJob','Company\JobController@edit')->name('jobview');
  Route::post('/job/{idJob}/viewJob','Company\JobController@update')->name('job.update');
  Route::get('/job/{idJob}/deleteJob','Company\JobController@destroy');
  Route::resource('/jobpost','Company\JobController');
  Route::post('/jobpost','Company\JobController@store')->name('jobpost');
  Route::get('/active_jobs','Company\JobController@getActivedJobs');  
  Route::get('/deactive_jobs','Company\JobController@getDeactivedJobs');
  Route::get('/job/{id}/activate','Company\JobController@activateJob');
  Route::get('/job/{id}/deactivate','Company\JobController@deactivateJob');
  Route::get('/applied','Company\JobController@getAppliedJob');
  Route::get('/applied/{idJobApplied}/details','Company\JobController@viewAppliedDetails');
  
  // Resetting Password
  Route::post('password/email', 'Company\ForgotPasswordController@sendResetLinkEmail');
  Route::get('password/reset', 'Company\ForgotPasswordController@showLinkRequestForm');
  Route::post('password/reset', 'Company\ResetPasswordController@reset');
  Route::get('password/reset/{token}', 'Company\ResetPasswordController@showResetForm')->name('company.password.reset');

  Route::get('/chpass', 'Company\CompanyController@editPassword');
  Route::post('/chpass', 'Company\CompanyController@updatePassword');

});

Route::prefix('mentor')->group(function() {

  Route::get('/register', 'Auth\MentorRegisterController@showRegistrationForm')->name('mentor.register');
  Route::post('/register', 'Auth\MentorRegisterController@register')->name('mentor.register.submit');
  Route::get('/login', 'Auth\MentorLoginController@showLoginForm')->name('mentor.login');
  Route::post('/login', 'Auth\MentorLoginController@login')->name('mentor.login.submit');
  Route::post('/logout', 'Auth\MentorLoginController@logout')->name('mentor.logout');
  Route::get('/', 'Mentor\MentorController@index')->name('mentor.dashboard');
  Route::get('/profile','Mentor\MentorController@profile');
  Route::get('/editprofile','Mentor\MentorController@EditProfile');
  Route::post('/editprofile','Mentor\MentorController@UpdateProfile')->name('mentorprofile.update');
  Route::get('/chats','Mentor\MentorController@startChat');
  Route::get('/chat/{idCandidate}','Mentor\MentorController@chatWithCandidate');
  Route::post('/chat/{idCandidate}','Mentor\MentorController@saveChat');
  Route::get('/candidate','Mentor\MentorController@getCandidates');
  Route::get('/home/scheme/{idScheme}','MainController@getSectorWiseMentors');
  Route::get('/home/filter','MainController@getFilterWiseMentors');
  Route::get('/view/{idMentor}','MainController@getMentorDetails');
  Route::get('/candidate/{idCandidate}','MainController@getCandidateDetails');
  Route::get('/home', 'MainController@getMentors');

  // Resetting Password
  Route::post('password/email', 'Mentor\ForgotPasswordController@sendResetLinkEmail');
  Route::get('password/reset', 'Mentor\ForgotPasswordController@showLinkRequestForm');
  Route::post('password/reset', 'Mentor\ResetPasswordController@reset');
  Route::get('password/reset/{token}', 'Mentor\ResetPasswordController@showResetForm')->name('mentor.password.reset');
  Route::get('/chpass', 'Mentor\MentorController@editPassword');
  Route::post('/chpass', 'Mentor\MentorController@updatePassword');
});
