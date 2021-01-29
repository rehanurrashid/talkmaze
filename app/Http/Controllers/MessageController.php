<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function send(Request $request){
        $x = '';
        $msg = new Message;
        $request['sender_id'] = auth()->id();
        $request['delv'] = 1;
        if ($request->file){
            if ($request['carPic']){

            }
            $request['message'] = $request->file('file')->store('public/brands');
            $request['message'] = Storage::url($request['message']);
            $request['message'] = asset($request['message']);
        }
        $msg->create($request->all());
        return response()->json(['message'=>'success'],200);
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
}
