<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\StoreCoachingBulk;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreContactUs;
use App\Http\Requests\StoreRegister;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreApplicant;
use App\Http\Requests\StoreDebate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\StoreRequest;
use Yajra\Datatables\Datatables;
use App\Mail\PasswordSentEmail;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\CoachingBulk;
use App\CommentLike;
use App\UserProfile;
use App\Subscribe;
use App\ContactUs;
use App\Applicant;
use App\TimeTable;
use App\Course;
use App\Comment;
use App\Debate;
use App\User;
use App\Vote;
use App\Faq;
use Image;
use Mail;

class UserActionController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard-home';
   	 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(StoreRegister $request)
    {

        if ($request->hasFile('photo')){
            $originalImage= $request->file('photo');
            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $filename = $request['picture'];
        }
        else{
            $filename = asset('images/profileavatar.png');
        }


        $password = $request->password;
        $hash_password = Hash::make($password);
        $name = $request->fname.' '. $request->lname;
        $user = new User;
        $user->name = $name;
        $user->email = $request->email;
        $user->password = $hash_password;
        $user->save();
        $user->attachRole('user');

//        Mail::to($user->email)->send(new PasswordSentEmail($password));

        if($user){
            $profile = new UserProfile([
                'user_id' => $user->id,
                // 'address'  => $request->address,
                 'city'  => $request->city,
                 'country'   => $request->country,
                // 'phone' =>  $request->phone,
                'image' => $filename,
            ]);

            $profile = $user->profile()->save($profile);
            if($profile){
                Session::flash('message', 'Registered Successfully!');
                Session::flash('alert-class', 'alert-success');
                return redirect('/dashboard-home');
            }
        }
        else{
        	return back()->withInput();
        }
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
//        dd($request->all());
        if ($this->attemptLogin($request)) {
            if ($request->from == 'coaching'){
                return redirect()->back();
            }
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function subscribe(Request $request)
    {
        $subscribe = Subscribe::select('email')->where('email',$request->email)->first();
        if($subscribe){
                Session::flash('exist', 'You are already subscribed!');
                Session::flash('alert-class', 'alert-success');
                return redirect('home');
        }
        else{
            $subscribe = new Subscribe;
            $subscribe->email = $request->email;
            $subscribe->save();

            if($subscribe){
                Session::flash('message', 'Please check your email to confirm subscription.');
                Session::flash('alert-class', 'alert-success');
                return redirect('home');
            }
        }
    }

    public function coaching_bulk(StoreCoachingBulk $request)
    {
        $coaching_bulk = new CoachingBulk;
        $coaching_bulk->first_name = $request->first_name;
        $coaching_bulk->last_name = $request->last_name;
        $coaching_bulk->email = $request->email;
        $coaching_bulk->phone = $request->phone;
        $coaching_bulk->role = $request->role;
        $coaching_bulk->organization = $request->organization;
        $coaching_bulk->country = $request->country;
        $coaching_bulk->city = $request->city;
        $coaching_bulk->message = $request->message;
        $coaching_bulk->save();

        if($coaching_bulk){
            Session::flash('message', 'Coaching Bulk Created Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('coaching');
        }
    }

    public function post_debate(StoreDebate $request)
    {
        $debate = new Debate;
        $debate->user_id = auth()->id();
        $debate->topic = $request->topic;
        $debate->setAttribute('slug', $request->topic);
        $debate->description = $request->description;
        $debate->anonymous = $request->anonymous;
        $debate->save();

        if($debate){
            Session::flash('message', 'Debate Posted Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('forum.detail',[$debate->slug]);
        }
    }

    public function search_course(Request $request)
    {
        $course = new Course;
        $course->name = 'Search Results';

        $courses = Course::with(['category:id,name','user'])->withCount('users_enroll')->where('name','LIKE','%'.$request->keyword.'%')->get();
        $all_courses = Course::with(['category:id,name','user'])->withCount('users_enroll')->get();

        return view('user.pages.search-course',compact('course','courses','all_courses'));
    }

    public function like(Request $request){

        $debate_id = $request->debate_id;
        $user_id = auth()->id();

        $vote = Vote::select('id','type')->where(['debate_id' => $debate_id,'user_id' => $user_id])->get();

        if(empty($vote[0])){
            $vote = new Vote;
            $vote->debate_id = $debate_id;
            $vote->user_id = $user_id;
            $vote->type = 'like';
            $vote->save();

            $debate = Debate::withCount(['likes','dislikes'])->where('id', $debate_id)->first();

            return response()->json(['message' => true ,'debate' => $debate],200);
         }
        else if($vote[0]->type == 'dislike'){

            $vote = Vote::find($vote[0]->id);
            $vote->debate_id = $debate_id;
            $vote->user_id = $user_id;
            $vote->type = 'like';
            $vote->save();

           $debate = Debate::withCount(['likes','dislikes'])->where('id', $debate_id)->first();

            return response()->json(['message' => true ,'debate' => $debate],200);
         }
         else
         {
             return response()->json(['message'=>'Already Liked'],200);
         }
    }

    public function dislike(Request $request){
        $debate_id = $request->debate_id;
        $user_id = auth()->id();

        $vote = Vote::select('id','type')->where(['debate_id' => $debate_id,'user_id' => $user_id])->get();


        if(empty($vote[0])){
            $vote = new Vote;
            $vote->debate_id = $debate_id;
            $vote->user_id = $user_id;
            $vote->type = 'dislike';
            $vote->save();
            $debate = Debate::withCount(['likes','dislikes'])->where('id', $debate_id)->first();

            return response()->json(['message' => true ,'debate' => $debate],200);
         }
        else if($vote[0]->type == 'like'){
            $vote = Vote::find($vote[0]->id);
            $vote->debate_id = $debate_id;
            $vote->user_id = $user_id;
            $vote->type = 'dislike';
            $vote->save();
            $debate = Debate::withCount(['likes','dislikes'])->where('id', $debate_id)->first();

            return response()->json(['message' => true ,'debate' => $debate],200);
         }
         else
         {
             return response()->json(['Message'=>'Already Disiked'],200);
         }
    }

    public function comment(Request $request){

        $debate_id = $request->debate_id;
        $user_id = auth()->id();
        $comment = new Comment;

        $vote = Vote::select('id','type')->where(['debate_id' => $debate_id,'user_id' => $user_id])->first();

        if(empty($vote)){
            return response()->json(['message' => 'NoVote'],406);
        }
        else if($vote->type == 'like'){
            $type = 'like';
        } else{
            $type = 'dislike';
        }

        $comment->debate_id = $debate_id;
        $comment->user_id = $user_id;
        $comment->comment = $request->comment;
        $comment->type = $type;
        $comment->save();

        if($comment){
            if($vote->type == 'like'){
                $debate = Debate::with('latest_comments_in_favour')->withCount(['comments','comments_in_favour'])->where('id', $debate_id)->first();
            }else{
                $debate = Debate::with('latest_comments_against')->withCount(['comments','comments_against'])->where('id', $debate_id)->first();
            }

            return response()->json(['message' => true ,'debate' => $debate , 'type' => $vote->type],200);
        }
        else{
            return response()->json(['message' => 'There is some error in posting comment'],401);
        }

    }

    public function comment_like(Request $request){

        $user_id = auth()->id();
        $debate_id = $request->debate_id;
        $comment_id = $request->comment_id;

        $comment_liked =  DB::table('comment_likes')
            ->where([
                    ['user_id',auth()->id()],
                    ['comment_id' , $comment_id],
                    ]
                )
            ->count();

        if($comment_liked){
            DB::table('comment_likes')
            ->where([
                    ['user_id',auth()->id()],
                    ['comment_id' , $comment_id],
                    ]
                )
            ->delete();

            $comment_likes = DB::table('comment_likes')
            ->where('comment_id' , $comment_id)->count();

            return response()->json(['message'=>'false', 'comment_likes' => $comment_likes], 200);
         }
         else
         {
            $data=array('user_id'=>$user_id,"comment_id"=>$comment_id,"type"=>'like');
            DB::table('comment_likes')->insert($data);
            $debate = Debate::with('comment_likes')->where('id', $debate_id)->first();

            $comment_likes = DB::table('comment_likes')
            ->where('comment_id' , $comment_id)->count();

            return response()->json(['message'=>'true', 'comment_likes' => $comment_likes],200);
         }
    }

    public function comment_reply(Request $request){

        $user_id = auth()->id();
        $debate_id = $request->debate_id;
        $parent_id = $request->parent_id;
        $comment = $request->comment;

        $comment_type =  DB::table('comments')
            ->select('type')
            ->where('id',$parent_id)
            ->get();

        if($comment_type[0]->type == 'like'){
            $type = 'like';

        }
        else{
            $type = 'dislike';
        }
        $comment = new Comment;
        $comment->user_id = $user_id;
        $comment->debate_id = $debate_id;
        $comment->parent_id = $parent_id;
        $comment->comment = $request->comment;
        $comment->type = $type;
        $comment->save();

        $latest = Debate::with('latest_reply')->where('id', $debate_id)->first();

        if($comment){
            return response()->json(['latest' => $latest,'message' => true],200);
        }
        else{
            return response()->json(['message' => 'There is some error in posting comment'],401);
        }
    }


    public function contact_us(StoreContactUs $request)
    {
        $contact_us = new ContactUs;
        $contact_us->name = $request->name;
        $contact_us->email = $request->email;
        $contact_us->phone = $request->phone;
        $contact_us->organization = $request->organization;
        $contact_us->message = $request->message;
        $contact_us->save();

        if($contact_us){
            Session::flash('message', 'Message Send Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('/faqs');
        }
        else{
            return back()->withInput();
        }
    }

    public function applicant(StoreApplicant $request)
    {
        $name = $request->fname.' '.$request->lname;
        $applicant = new Applicant;

        if ($request['resume']){
            $request['resume'] = $request->file('resume')->store('public/storage');
            $request['resume'] = Storage::url($request['picture']);
            $request['resume'] = asset($request['resume']);
            $applicant->resume  = $request->file('resume')->hashName();
        }

        if ($request['reference']){
            $request['resume'] = $request->file('reference')->store('public/storage');
            $request['resume'] = Storage::url($request['picture']);
            $request['resume'] = asset($request['reference']);
            $applicant->reference = $request->file('reference')->hashName();
        }

        $applicant->job_id = $request->job_id;
        $applicant->name = $name;
        $applicant->email = $request->email;
        $applicant->phone = $request->phone;
        $applicant->gender = $request->gender;
        $applicant->debate = $request->debate;
        $applicant->expect_outcome_of_your_experience = $request->expect_outcome_of_your_experience;
        $applicant->education = $request->education;
        $applicant->experience = $request->experience;
        $applicant->education_level = $request->education_level;
        $applicant->why_to_join = $request->why_to_join;
        $applicant->allow_device = $request->allow_device;
        $applicant->how_here_about_us = $request->how_here_about_us;
        $applicant->general_availabality = $request->general_availabality;
        $applicant->save();


        $days = $request->day;

        foreach ($days as $day => $val) {
                TimeTable::create([
                'applicant_id' => $applicant->id,
                'day_id'  => $day,
                'time_zone'  => $val['time_zone'],
                'from'   => $val['from'],
                'to' =>  $val['to'],
            ]);
        }

        if($applicant){
            Session::flash('message', 'Request Send Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('join-team');
        }
    }
}
