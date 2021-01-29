<?php

namespace App\Http\Controllers;

use App\ClassCategory;
use App\ClassPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Testimonial;
use App\UserProfile;
use App\Category;
use App\Comment;
use App\Course;
use App\Debate;
use App\Plan;
use App\Faq;
use App\Job;
use App\Day;
use App\Partner;
use App\Message;
use App\User;
use App\UserRequest;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $testimonials = Testimonial::select(['id', 'name', 'email','feedback','image'])->get();
        return view('user.pages.index',compact('testimonials'));
    }

    public function forum(Request $request)
    {
        if($request->keyword != ''){
            $debates = Debate::with(['user'])->where('topic','LIKE', '%'.$request->keyword.'%')->get();
            $keyword = $request->keyword;
        }
        else{

          $debates = Debate::with(['user'])->latest()->limit(16)->get();
          $keyword = '';

        }
        return view('user.pages.forum',compact('debates','keyword'));
    }

    public function forum_detail($slug)
    {
        $debate = Debate::with(['user','comments_in_favour','comments_against'])->withCount(['likes','dislikes','comments','comments_in_favour','comments_against'])->where('slug', $slug)->first();

        $created = new Carbon($debate->created_at);
        $now = Carbon::now();
        $posted_on = ($created->diff($now)->days < 1)
            ? 'today'
            : (($created->diff($now)->days > 7) ? $created->format('M d Y') : $created->diffForHumans()) ;

        // loop to store time for favourite comments
        foreach ($debate->comments_in_favour as $key => $value) {

            $comment_on = ($value->created_at->diffInHours($now) < 1)
            ? $value->created_at->diffInMinutes($now).' min ago'
            : (($value->created_at->diff($now)->days > 1) ? $value->created_at->format('M d Y') : $value->created_at->diffForHumans()) ;

          $value->comment_at = $comment_on;

          foreach($value->childrens as $children){

            $comment_on = ($children->created_at->diffInHours($now) < 1)
            ? $children->created_at->diffInMinutes($now).' min ago'
            : (($children->created_at->diff($now)->days > 1) ? $children->created_at->format('M d Y') : $children->created_at->diffForHumans()) ;

            $children->comment_at = $comment_on;
          }
        }

        // loop to store time for against comments
        foreach ($debate->comments_against as $key => $value) {

            $comment_on = ($value->created_at->diffInHours($now) < 1)
            ? $value->created_at->diffInMinutes($now).' min ago'
            : (($value->created_at->diff($now)->days > 1) ? $value->created_at->format('M d Y') : $value->created_at->diffForHumans()) ;

           $value->comment_at = $comment_on;

           foreach($value->childrens as $children){

            $comment_on = ($children->created_at->diffInHours($now) < 1)
            ? $children->created_at->diffInMinutes($now).' min ago'
            : (($children->created_at->diff($now)->days > 1) ? $children->created_at->format('M d Y') : $children->created_at->diffForHumans()) ;

            $children->comment_at = $comment_on;
          }
        }
        // dynamic progressbar
        $total_likes_dislikes = $debate->likes_count + $debate->dislikes_count;

        if($total_likes_dislikes != 0){
           $debate->avg_likes =  ($debate->likes_count/$total_likes_dislikes)*100;

            $debate->avg_dislikes =  ($debate->dislikes_count/$total_likes_dislikes)*100;
        }

        return view('user.pages.forum-detail',compact('debate','posted_on'));
    }

    public function resources()
    {
        $courses = Course::with(['category:id,name','user'])->withCount('users_enroll')->get();

        $categories = Category::select('name','image', 'id')->where('parent_id','=',null)->limit(7)->get();
        $cat_count = Category::where('parent_id','=',null)->count();

        return view('user.pages.resources',compact('courses','categories','cat_count'));
    }

    public function coaching(Request $request)
    {
        $plans = Plan::select(['id', 'name', 'duration','price','description'])->limit(3)->get();
        $from = $request->get('redirect');

        $data_id = $request->get('data_id');

        return view('user.pages.pricing',compact('plans','from','data_id'));
    }

    public function login()
    {
        return view('user.pages.login');
    }

    public function register()
    {
        return view('user.pages.register');
    }

    public function partner()
    {
        $partners = Partner::all();
        return view('user.pages.partner',compact('partners'));
    }

     public function about_us(){
        $coaches = User::whereHas('roles',function ($r){
            return $r->where('name','coach')->orWhere('name','admin');
        })->with('profile')->get();
        return view('user.pages.about-us',compact('coaches'));
    }

    public function faqs(Request $request)
    {
        if($request->keyword != ''){
            $faqs = Faq::where('question','LIKE','%'.$request->keyword.'%')->get();
            $keyword = $request->keyword;
        }
        else{
         $faqs = Faq::select(['id', 'question', 'answer','created_at', 'updated_at'])->get();
         $keyword = '';
        }

        return view('user.pages.faqs',compact('faqs','keyword'));
    }

    public function join_team()
    {
        $jobs = Job::all();

        if(!empty($jobs)){
            foreach ($jobs as $key => $value) {
                $last_date = new Carbon($value->apply_by);
                $now = Carbon::now();
                $last_date = ($last_date->diff($now)->days < 1)
                ? 'today'
                : (($last_date->diff($now)->days > 7) ? $last_date->format('M d Y') : $last_date->diffForHumans()) ;
                $value->apply_by = $last_date;
            }
        }
        return view('user.pages.join-team',compact('jobs'));
    }

    public function job_detail($slug)
    {
        $job = Job::where('slug', $slug)->first();
        $jobs = Job::all()->take(10);

        if(!empty($jobs)){
            foreach ($jobs as $key => $value) {
                $last_date = new Carbon($value->apply_by);
                $now = Carbon::now();
                $last_date = ($last_date->diff($now)->days < 1)
                ? 'today'
                : (($last_date->diff($now)->days > 7) ? $last_date->format('M d Y') : $last_date->diffForHumans()) ;
                $value->apply_by = $last_date;
            }
        }
        return view('user.pages.job-detail',compact(['job','jobs']));
    }

    public function job_apply($slug)
    {
        $job = Job::where('slug', $slug)->first();
        $days = Day::select('name','id')->get();

        return view('user.pages.job-title',compact('job','days'));
    }

    public function forget_password()
    {
        return view('user.pages.forget-password');
    }

    public function course(Request $request)
    {
        $course = new Course;
        $slug =$request->slug;
        $cat_id = $request->cat_id;
        $keyword = $request->keyword;

        if($slug != '' && $cat_id == ''){

            $course = Course::with(['lessons','lessons_text','lessons_audio','lessons_video','users','user','content'])->withCount(['reviews','users_enroll'])->where('slug',$slug)->first();

            $now = Carbon::now();
            if(!empty($course->lessons)){

                foreach ($course->lessons as $key => $lesson) {

                    foreach ($lesson->course_contents as $key => $content) {

                        $posted_on = new Carbon($content->created_at);
                        $posted_on = ($posted_on->diff($now)->days < 1)
                        ? 'today'
                        : (($posted_on->diff($now)->days > 7) ? $posted_on->format('M d Y') : $posted_on->diffForHumans()) ;
                       $content->posted_on = $posted_on;

                    }
                }
            }
            // dd($course->user->name);
            return view('user.pages.single-course',compact('course'));
        }
        else if($cat_id != '' && $slug == ''){

            $course->name = $request->cat_name.' '.'Courses';
            $courses = Course::with(['category:id,name','user'])->withCount('users_enroll')->where('category_id',$cat_id)->get();
        }
        else if($cat_id == '' && $slug == '' && $keyword != ''){
            $course = new Course;
            $course->name = 'Search Results';

            $courses = Course::with(['category:id,name','user'])->withCount('users_enroll')->where('name','LIKE','%'.$request->keyword.'%')->get();
            $all_courses = Course::with(['category:id,name','user'])->withCount('users_enroll')->get();
            $keyword = $request->keyword;

            return view('user.pages.course',compact('course','courses','all_courses','keyword'));
        }
        else{

            $course->name = 'All Courses';
            $courses = Course::with(['category:id,name','user'])->withCount('users_enroll')->get();
        }

        $all_courses = Course::with(['category:id,name','user'])->withCount('users_enroll')->get();

        return view('user.pages.course',compact('course','courses','all_courses'));
    }

    // dashboard

    public function dashboard()
    {
        $debates = Debate::with('user')->take(8)->orderBy('created_at','desc')->get();
        $authuser = User::with('profile')->whereId(auth()->id())->first();
        $scheduals = null;
        if(auth()->user()->hasRole('coach')){
            $scheduals = ClassPlan::where('host_id',auth()->id())->get();
        }else{
            $scheduals = auth()->user()->enrollments()->get();
        }
        return view('user.dashboard.pages.home',compact('debates','authuser','scheduals'));
    }

    public function post()
    {
        $myposts = Debate::where('user_id',auth()->id())->withCount('likes','dislikes','comments')->get();;
        return view('user.dashboard.pages.post',compact('myposts'));
    }

    public function search_post(Request $request)
    {
        $myposts = Debate::where('topic','like','%'.$request->search.'%')->where('user_id',auth()->id())->withCount('likes','dislikes','comments')->get();
        $type = 'search';
        return view('user.dashboard.pages.post',compact('myposts','type'));
    }

    public function buy_course($id){
        $course = Course::whereId($id)->first();
        auth()->user()->courses()->attach($course->id);
        return redirect()->back();
    }


    public function my_courses(){
        $r = auth()->user()->courses()->paginate(10);
        return view('user.dashboard.pages.dash-resources', compact('r'));
    }
    public function search_my_resc(Request $request){
        $r = auth()->user()->courses()->where('name','like','%'.$request->search.'%')->paginate(10);
        $type = 'search';
        return view('user.dashboard.pages.dash-resources', compact('r','type'));
    }

    public function course_detail($slug){
        $course = Course::with(['lessons','lessons_text','lessons_audio','lessons_video','users','user','content'])->withCount(['reviews','users_enroll'])->where('slug',$slug)->first();

        $now = Carbon::now();
        if(!empty($course->lessons)){

            foreach ($course->lessons as $key => $lesson) {

                foreach ($lesson->course_contents as $key => $content) {

                    $posted_on = new Carbon($content->created_at);
                    $posted_on = ($posted_on->diff($now)->days < 1)
                        ? 'today'
                        : (($posted_on->diff($now)->days > 7) ? $posted_on->format('M d Y') : $posted_on->diffForHumans()) ;
                    $content->posted_on = $posted_on;

                }
            }
        }
        // dd($course->user->name);
        return view('user.dashboard.pages.resources',compact('course'));
    }

    public function chat(Request $request,$id){
        if($request->ajax()){
            $x = '';
            $messages = Message::where('sender_id',$id)->where('receiver_id',auth()->id())->orwhere('sender_id',auth()->id())->where('receiver_id',$id)->get();
            foreach ($messages as $mg){
                if($mg->sender_id == auth()->id()){
                    if($mg->type == 1){
                        $x .= '<div class="row justify-content-end p-1 mt-2 ">
                            <div class="col-10 padding-custom border-curve" style="background-color: #69d2b1; padding: 10px;">
                                <h5 class=" mt-1" style="color:white !important; word-wrap: break-word;">'.$mg->message.'</h5>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class="mr-4 ml-auto h7">'.$mg->created_at->diffForHumans().'</h6>
                        </div>';
                    }else{
                        $x .= '<div class="row justify-content-end p-1 mt-2 ">
                            <div class="col-10 padding-custom border-curve" style="background-color: #69d2b1; padding: 10px;">
                                 <a target="_blank" href="'.$mg->message.'"><h5 class=" mt-1" style="color:white !important; display: inline-block; word-wrap: break-word; padding: 5px;">Download File </h5><i class="fa fa-file text-white" style="display: inline-block"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class="mr-4 ml-auto h7">'.$mg->created_at->diffForHumans().'</h6>
                        </div>';
                    }
                }else{
                    if($mg->type==1){
                        $x .= '<div class="row justify-content-start p-1 mt-2 ">
                            <div class="col-10 padding-custom border-curve bg-light" style="padding: 10px;">
                                <h5 class="mt-1" style=" word-wrap: break-word;">'.$mg->message.'</h5>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class=" ml-4 h7">'.$mg->created_at->diffForHumans().'</h6>
                        </div>';
                    }else{
                        $x .= '<div class="row justify-content-start p-1 mt-2 ">
                            <div class="col-10 padding-custom border-curve bg-light" style="padding: 10px;">
                                <a target="_blank" href="'.$mg->message.'"><h5 class=" mt-1" style="display: inline-block;">Download File </h5><i class="fa fa-file text-white" style="display: inline-block; word-wrap: break-word; padding: 5px;"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class=" ml-4 h7">'.$mg->created_at->diffForHumans().'</h6>
                        </div>';
                    }
                }

            }
            return $x;
        }else{
            $user = User::whereId($id)->first();
            return view('user.dashboard.pages.chat',compact('user','id'));
        }

    }

    public function mypeople(){
        $data = null;
        if(auth()->user()->hasRole('coach')){
            $data = auth()->user()->students()->where('is_group',0)->get();
        }else{
            $data = auth()->user()->tutors()->where('is_group',0)->get();
        }
        return view('user.dashboard.pages.people',compact('data'));
    }

    public function register_plan(Request $request){
        $plans = ClassPlan::whereId($request->id)->orwhere('parent_id',$request->id)->pluck('id')->toArray();
        foreach ($plans as $pl){
            auth()->user()->enrollments()->attach($pl,['is_paid'=>$request->is_paid,'amount'=>$request->amount]);
        }
        return response()->json(['message'=>'successfully added!']);
    }

    public function getmsgs(Request $request){
        $x = '';
        $allmg = Message::where('session_id',$request->session_id)->orderBy('created_at')->get();
        foreach ($allmg as $mg){
            if($mg->sender_id == auth()->id()){
                if($mg->type == 1){
                    $x .= '<div class="row justify-content-end p-1 mt-2 ">
                            <div class="col-10 padding-custom border-curve" style="background-color: #69d2b1; padding: 10px;">
                                <h5 class=" mt-1" style="color:white !important; word-wrap: break-word;">'.$mg->message.'</h5>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class="mr-4 ml-auto h7">'.$mg->created_at->diffForHumans().'</h6>
                        </div>';
                }else{
                    $x .= '<div class="row justify-content-end p-1 mt-2 ">
                            <div class="col-10 padding-custom border-curve" style="background-color: #69d2b1; padding: 10px;">
                                 <a target="_blank" href="'.$mg->message.'"><h5 class=" mt-1" style="color:white !important; display: inline-block; word-wrap: break-word; padding: 5px;">Download File </h5><i class="fa fa-file text-white" style="display: inline-block"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class="mr-4 ml-auto h7">'.$mg->created_at->diffForHumans().'</h6>
                        </div>';
                }
            }else{
                if($mg->type==1){
                    $x .= '<div class="row justify-content-start p-1 mt-2 ">
                            <div class="col-10 padding-custom border-curve bg-light" style="padding: 10px;">
                                <h5 class="mt-1" style=" word-wrap: break-word;">'.$mg->message.'</h5>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class=" ml-4 h7">'.$mg->created_at->diffForHumans().'</h6>
                        </div>';
                }else{
                    $x .= '<div class="row justify-content-start p-1 mt-2 ">
                            <div class="col-10 padding-custom border-curve bg-light" style="padding: 10px;">
                                <a target="_blank" href="'.$mg->message.'"><h5 class=" mt-1" style="display: inline-block;">Download File </h5><i class="fa fa-file text-white" style="display: inline-block; word-wrap: break-word; padding: 5px;"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class=" ml-4 h7">'.$mg->created_at->diffForHumans().'</h6>
                        </div>';
                }
            }

        }
        return $x;
    }

    public function manage_coaching()
    {
        $sessions = [];
        $coach = '';
        $running = false;
        $students = null;
        $scheduals = null;
        if(auth()->user()->hasRole('coach')){
            $session = DB::table('sessions')->where('tutor_id',auth()->id())->where('status',1)->first();
            if($session){
                $running = true;
            }else{
                $running = false;
            }
            $students = auth()->user()->students()->where('is_group',0)->get();
            $scheduals = ClassPlan::where('host_id',auth()->id())->get();
        }else{
            $session = DB::table('sessions')->where('user_id',auth()->id())->where('status',1)->first();
            if($session){
                $running = true;
            }else{
                $running = false;
            }
            $scheduals = auth()->user()->enrollments()->get();
            $sessions = auth()->user()->student_session()->get();
        }
        if ($session){
            $coach = auth()->user()->tutors()->where('room_id',$session->room_id)->with('profile')->first();
        }else{
            $coach = auth()->user()->tutors()->where('is_group',0)->distinct()->first();
        }
        return view('user.dashboard.pages.coaching',compact('session','running','sessions','coach','students','scheduals'));
    }


    public function manage_resources()
    {

        return view('user.dashboard.pages.resources');
    }

    public function session_history()
    {
        $sessions = auth()->user()->student_session()->get();
        return view('user.dashboard.pages.session-history', compact('sessions'));
    }

    public function session_history_get($id){
        $usert = null;
        $sessions = auth()->user()->student_session()->get();
        $messages = Message::where('session_id',$id)->get();
        if(auth()->user()->hasRole('user')){
            $usert = auth()->user()->student_session()->where('session_id',$id)->with('profile')->first();
        }else{
            $usert = auth()->user()->tutor_session()->where('session_id',$id)->with('profile')->first();
        }
        return view('user.dashboard.pages.session-history', compact('sessions','messages','usert'));
    }

    public function dashboard_login()
    {
        return view('user.dashboard.pages.login');
    }

    public function dashboard_logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function profile()
    {
        $user = User::with('profile')->where('id',auth()->user()->id)->first();

        $results = array();
        $r = explode(' ', $user->name);
        $size = count($r);
        //check first for period, assume salutation if so
        if (mb_strpos($r[0], '.') === false)
        {
            $results['salutation'] = '';
            $results['first'] = $r[0];
        }
        else
        {
            $results['salutation'] = $r[0];
            $results['first'] = $r[1];
        }

        //check last for period, assume suffix if so
        if (mb_strpos($r[$size - 1], '.') === false)
        {
            $results['suffix'] = '';
        }
        else
        {
            $results['suffix'] = $r[$size - 1];
        }

        //combine remains into last
        $start = ($results['salutation']) ? 2 : 1;
        $end = ($results['suffix']) ? $size - 2 : $size - 1;

        $last = '';
        for ($i = $start; $i <= $end; $i++)
        {
            $last .= ' '.$r[$i];
        }
        $results['last'] = trim($last);

        $user->first_name =$results['first'];
        $user->last_name =$results['last'];

        return view('user.dashboard.pages.profile',compact('user'));
    }

    public function call_dashboard()
    {
        return view('user.dashboard.pages.call-dashboard');
    }

    public function student_request()
    {
        $stuts = UserRequest::where('tutor_id',auth()->id())->with('student')->get();
//        dd($stuts);
        return view('user.dashboard.pages.student-request', compact('stuts'));
    }

    public function tutor_list($id)
    {
        $tuts = User::whereHas('roles',function ($q){
            return $q->where('name','coach');
        })->with('timetable','profile','rating')->withCount('rating')->get();
        return view('user.dashboard.pages.tutor-list', compact('tuts','id'));
    }
    public function group_co(){
        $classcats = ClassCategory::with(['plans'=>function($r){
            return $r->where('is_group',1)->where('parent_id',null)->where('is_visible',1);
        }])->get();
        return view('user.pages.group-coaching',compact('classcats'));
    }
    public function private_co(Request $request){
        $plans = Plan::select(['id', 'name', 'duration','price','description'])->limit(3)->get();
        $from = $request->get('redirect');

        $data_id = $request->get('data_id');

        return view('user.pages.private-coaching',compact('plans','from','data_id'));
    }
}
