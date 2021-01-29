<?php

namespace App\Http\Controllers;

use App\ClassPlan;
use App\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Rest\Client;


class VideoRoomsController extends Controller
{
    protected $sid;
    protected $token;
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->sid = config('services.twilio.sid');
        $this->token = config('services.twilio.token');
        $this->key = config('services.twilio.key');
        $this->secret = config('services.twilio.secret');
    }

    public function index()
    {
        $rooms = [];
        try {
            $client = new Client($this->sid, $this->token);
            $allRooms = $client->video->rooms->read([]);

            $rooms = array_map(function($room) {
                return $room->uniqueName;
            }, $allRooms);

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return view('video', ['rooms' => $rooms]);
    }

    public function createRoom(Request $request)
    {
        $client = new Client($this->sid, $this->token);

        $exists = $client->video->rooms->read([ 'uniqueName' => $request->roomName]);

        if (empty($exists)) {
            $client->video->rooms->create([
                'uniqueName' => $request->roomName,
                'type' => 'group',
                'recordParticipantsOnConnect' => false
            ]);

            Log::debug("created new room: ".$request->roomName);
        }

        return redirect()->action('VideoRoomsController@joinRoom', [
            'roomName' => $request->roomName
        ]);
    }
    public function start_meeting($id){
        $plk = ClassPlan::whereId($id)->first();
        $users = DB::table('enrolled_user')->where('class_plan_id',$id)->pluck('user_id')->toArray();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $room = substr(str_shuffle($permitted_chars), 0, 10);
        $session = substr(str_shuffle($permitted_chars), 0, 32);
        $client = new Client($this->sid, $this->token);
        $exists = $client->video->rooms->read([ 'uniqueName' => $room]);
        if (empty($exists)) {
            $client->video->rooms->create([
                'uniqueName' => $room,
                'type' => 'group',
                'recordParticipantsOnConnect' => false
            ]);
        }
        if($plk->is_group == 1){
            auth()->user()->students()->attach($users,['room_id'=>$room,'is_group'=>1]);
            auth()->user()->tutor_session()->attach($users,['session_id'=>$session,'is_group'=>1,'status'=>1,'room_id'=>$room]);
        }else{
            auth()->user()->students()->attach($users,['room_id'=>$room,'is_group'=>0]);
            auth()->user()->tutor_session()->attach($users,['session_id'=>$session,'is_group'=>0,'status'=>1,'room_id'=>$room]);
        }
        ClassPlan::whereId($id)->delete();
        return redirect('/dashboard-call/group/'.$room);
    }

    public function create_group(Request $request){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $room = substr(str_shuffle($permitted_chars), 0, 10);
        $session = substr(str_shuffle($permitted_chars), 0, 32);
        $client = new Client($this->sid, $this->token);
        $exists = $client->video->rooms->read([ 'uniqueName' => $room]);
        if (empty($exists)) {
            $client->video->rooms->create([
                'uniqueName' => $room,
                'type' => 'group',
                'recordParticipantsOnConnect' => false
            ]);
        }
        auth()->user()->students()->attach($request->participents,['room_id'=>$room,'is_group'=>1]);
        auth()->user()->tutor_session()->attach($request->participents,['session_id'=>$session,'is_group'=>1,'status'=>1,'room_id'=>$room]);
        return redirect('/dashboard-call/group/'.$room);
    }
    public function joinGroupRoom($roomName)
    {
        // A unique identifier for this user
        $identity = Auth::user()->email;

        Log::debug("joined with identity: $identity");
        $token = new AccessToken($this->sid, $this->key, $this->secret, 3600, $identity);

        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($roomName);

        $token->addGrant($videoGrant);

        if(auth()->user()->hasRole('coach')){
            if (auth()->user()->tutor_session()->where('status',1)->where('is_group',1)->exists()){
                $session_id = auth()->user()->tutor_session()->where('status',1)->where('is_group',1)->first();
                if($session_id){
                    $messages = Message::where('session_id',$session_id->pivot->session_id)->where('is_group',1)->get();
                    $usert = auth()->user()->tutor_session()->where('session_id',$session_id->pivot->session_id)->with('profile')->first();
                    $sessionId = $session_id->pivot->session_id;
                }else{
                    dd('$session_id ni mili');
                }
            }else{
                dd('group exist ni krta');
            }
        }else{
            if (auth()->user()->student_session()->where('status',1)->where('is_group',1)->exists()){
                $session_id = auth()->user()->student_session()->where('is_group',1)->where('status',1)->first();
                if($session_id){
                    $messages = Message::where('session_id',$session_id->pivot->session_id)->get();
                    $usert = auth()->user()->student_session()->where('session_id',$session_id->pivot->session_id)->with('profile')->first();
                    $sessionId = $session_id->pivot->session_id;
                }
            }else{
                dd('group exist ni krta');
            }
        }
        return view('user.dashboard.pages.calling-page', [ 'accessToken' => $token->toJWT(), 'roomName' => $roomName,'messages'=>$messages,'user'=>$usert,'session_id'=>$sessionId ]);
    }

    public function end_session($id){
        $r = DB::table('sessions')->where('room_id',$id)->where('status',1)->update(['status'=>2]);
        return redirect()->back();
    }

    public function joinRoom(Request $request, $roomName)
    {
        // A unique identifier for this user
        $identity = Auth::user()->email;

        Log::debug("joined with identity: $identity");
        $token = new AccessToken($this->sid, $this->key, $this->secret, 3600, $identity);

        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($roomName);

        $token->addGrant($videoGrant);
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $session = substr(str_shuffle($permitted_chars), 0, 32);
        $messages = null;
        $usert = null;
        $sessionId = null;

        if(auth()->user()->hasRole('coach')){
            $r = auth()->user()->students()->where('room_id',$roomName)->first();
            if (auth()->user()->tutor_session()->where('user_id',$r->id)->where('status',1)->exists()){
                $session_id = auth()->user()->tutor_session()->where('user_id',$r->id)->where('status',1)->first();
                if($session_id){
                    $messages = Message::where('session_id',$session_id->pivot->session_id)->get();
                    $usert = auth()->user()->tutor_session()->where('session_id',$session_id->pivot->session_id)->with('profile')->first();
                    $sessionId = $session_id->pivot->session_id;
                }
            }else{
                auth()->user()->tutor_session()->attach($r->id,['session_id'=>$session,'status'=>1,'room_id'=>$roomName]);
                $sessionId = $session;
            }
        }else{
            $r = auth()->user()->tutors()->where('room_id',$roomName)->first();
            if (auth()->user()->student_session()->where('tutor_id',$r->id)->where('status',1)->exists()){
                $session_id = auth()->user()->student_session()->where('tutor_id',$r->id)->where('status',1)->first();
                if($session_id){
                    $messages = Message::where('session_id',$session_id->pivot->session_id)->get();
                    $usert = auth()->user()->student_session()->where('session_id',$session_id->pivot->session_id)->with('profile')->first();
                    $sessionId = $session_id->pivot->session_id;
                }
            }else{
                auth()->user()->student_session()->attach($r->id,['session_id'=>$session,'status'=>1,'room_id'=>$roomName]);
                $sessionId = $session;
            }
        }
        return view('user.dashboard.pages.calling-page', [ 'accessToken' => $token->toJWT(), 'roomName' => $roomName,'messages'=>$messages,'user'=>$usert,'session_id'=>$sessionId ]);
    }
}
