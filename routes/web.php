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

// for guest/everyone
Route::get('/', function(){
    return redirect('/home');
})->name('welcome');

Route::get('/terms_conditions', function(){
    return view('user.pages.terms');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'UserActionController@subscribe')->name('guest.subscribe');

Route::get('/forum/{keyword?}', 'HomeController@forum');
Route::middleware('check.role')->post('/forum', 'UserActionController@post_debate')->name('post.debate');
Route::get('/forum-detail/{slug}', 'HomeController@forum_detail')->name('forum.detail');

Route::middleware('check.role')->post('/like', 'UserActionController@like');
Route::middleware('check.role')->post('/dislike', 'UserActionController@dislike');
Route::middleware('check.role')->post('/comment', 'UserActionController@comment')->name('comment');
Route::middleware('check.role')->post('/commentlike', 'UserActionController@comment_like');
Route::middleware('check.role')->post('/comment-reply', 'UserActionController@comment_reply');

Route::get('/resources', 'HomeController@resources');

Route::get('/coaching', 'HomeController@coaching')->name('get.plans');
Route::get('/group-coaching', 'HomeController@group_co')->name('get.plans');
Route::get('/private-coaching', 'HomeController@private_co')->name('get.plans');
Route::post('/coaching', 'UserActionController@coaching_bulk')->name('guest.coaching_bulk');

Route::get('/login', 'HomeController@login')->name('login');
Route::post('/login', 'UserActionController@login')->name('guest.login');

Route::get('/register', 'HomeController@register');
Route::post('/register', 'UserActionController@register')->name('guest.register');

Route::get('/partner', 'HomeController@partner');
Route::get('/about-us', 'HomeController@about_us');

Route::get('/faqs/{keyword?}', 'HomeController@faqs');
Route::post('/faqs', 'UserActionController@contact_us')->name('guest.contact_us');

Route::get('/join-team', 'HomeController@join_team');
Route::get('/job-detail/{slug}', 'HomeController@job_detail')->name('job.detail');
Route::get('/job-apply/{slug}', 'HomeController@job_apply')->name('job.apply');
Route::post('/job-apply', 'UserActionController@applicant')->name('applicant.register');

Route::get('/forget-password', 'HomeController@forget_password');
Route::get('/course/{slug?}{cat_id?}{keyword?}', 'HomeController@course')->name('course');


// User Dashboard
Route::middleware('gest.auth')->group(function () {
    Route::get('/dashboard-home', 'HomeController@dashboard')->name('dashboard-home');
    Route::get('/dashboard-post', 'HomeController@post')->name('dashboard-post');
    Route::get('/dashboard-coaching', 'HomeController@manage_coaching')->name('dashboard-coaching');
    Route::get('/dashboard-resources', 'HomeController@manage_resources');
    Route::get('/dashboard-session', 'HomeController@session_history');
    Route::get('/dashboard-session/{id}', 'HomeController@session_history_get');
    Route::get('/dashboard-login', 'HomeController@dashboard_login');
    Route::get('/dashboard-profile', 'HomeController@profile');
    Route::post('/create/group','VideoRoomsController@create_group')->name('create.group');
    Route::get('/dashboard-call/{id}', 'VideoRoomsController@joinRoom')->name('call.caller');
    Route::get('/dashboard-call/group/{id}', 'VideoRoomsController@joinGroupRoom')->name('call.group.caller');
    Route::get('/student-request', 'HomeController@student_request');
    Route::get('/tutor-list/{id}', 'HomeController@tutor_list');
    Route::resource('user_requests','UserRequestController');
    Route::get('send/tutor/request', 'UserRequestController@send_request')->name('send.tutor.request');
    Route::get('request/accept/{id}', 'UserRequestController@accept')->name('accept.request');
    Route::get('request/reject/{id}', 'UserRequestController@reject')->name('reject.request');
    Route::post('/send/message','MessageController@send')->name('send.message');
    Route::post('/get/message','MessageController@getmsgs')->name('get.message');
    Route::post('/update/plan','PlanController@userplan')->name('update.plan');
    Route::get('/buy/course/{id}','HomeController@buy_course')->name('buy.course');
    Route::get('/dashboard-my/courses/','HomeController@my_courses')->name('my.course');
    Route::get('/dashboard-my/courses/{slug}','HomeController@course_detail')->name('my.course.details');
    Route::post('/dashboard-profile','UserController@update_profile')->name('update.profile');
    Route::get('/dashboard-logout','HomeController@dashboard_logout')->name('user.logout');
    Route::post('/schedual-meeting','ClassPlanController@schedual_meeting')->name('create.schedual');
    Route::get('/start-meeting/plan/{id}','VideoRoomsController@start_meeting')->name('start.meeting');
    Route::get('/end-session/{id}','VideoRoomsController@end_session')->name('end.session');
    Route::get('/chat/{id}','HomeController@chat')->name('chat');
    Route::get('/chat','HomeController@mypeople')->name('chat.people');
    Route::get('/register/user/plan','HomeController@register_plan')->name('register.user.plan');
    Route::get('/search/resources','HomeController@search_my_resc')->name('search.resources');
    Route::get('/search-posts','HomeController@search_post')->name('search.posts');

});


// Authentication Routes For Admin...

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

// Password Reset Routes...
Route::post('password/email', [
  'as' => 'password.email',
  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
  'as' => 'password.request',
  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
  'as' => 'password.update',
  'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
  'as' => 'password.reset',
  'uses' => 'Auth\ResetPasswordController@showResetForm'
]);

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
	Route::get('home','AdminController@index')->name('admin.home');
  Route::get('acount-settings/{id}/edit','AdminController@edit')->name('admin.account.edit');
  Route::put('acount-settings/{id}','AdminController@update')->name('admin.account.update');
    Route::resource('users','UserController');
    Route::resource('testimonials','TestimonialController');
    Route::resource('social_links','SocialLinkController');
    Route::resource('faqs','FaqController');
    Route::resource('categories','CategoryController');
    Route::resource('partners','PartnerController');
    Route::resource('jobs','JobController');
    Route::resource('courses','CourseController');
    Route::resource('course_contents','CourseContentController');
    Route::resource('content_types','ContentTypeController');
    Route::resource('comments','CommentController');
    Route::resource('applicants','ApplicantController');
    Route::resource('debates','DebateController');
    Route::resource('plans','PlanController');
    Route::resource('subscribes','SubscribeController');
    Route::resource('coaching_bulks','CoachingBulkController');
    Route::resource('lessons','LessonController');
    Route::resource('class_plans','ClassPlanController');
    Route::post('dependent/courses','CourseContentController@fetch')->name('dynamicdependent.fetch');
});

Route::get('/vid', "TestController@index");
Route::prefix('room')->middleware('auth')->group(function() {
    Route::get('join/{roomName}', 'TestController@joinRoom');
    Route::post('create', 'TestController@createRoom');
});

Route::middleware('auth')->group(function () {
    Route::post('user/request', 'UserRequestController@sendrequest');
});

// Google Login Routes
Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback');
