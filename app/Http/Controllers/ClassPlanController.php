<?php

namespace App\Http\Controllers;

use App\ClassCategory;
use App\ClassPlan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ClassPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ClassPlan $class_plan)
    {
        if($request->ajax()){

            $class_plan = $class_plan->newQuery()->with(['category','host:id,name'])->get();
            // dd($class_plan[0]->host);
            return Datatables::of($class_plan)
                ->addColumn('action', function($class_plan) {
                    return view('admin.actions.actions_class_plan',compact('class_plan'));
                    })
                ->addColumn('image', function($class_plan) {
                    return '<img src="'.$class_plan->image.'" width="200" height="200">';
                    })
                ->addColumn('tutor', function(Classplan $class_plan) {
                    return $class_plan->host_id;
                    })
                ->addColumn('class_category', function($class_plan) {
                    return $class_plan->category->title;
                    })
                ->addColumn('visibility', function($class_plan) {
                        if($class_plan->is_visible == 1){
                            return 'true';
                        }else{
                            return 'false';
                        }
                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->rawColumns(['image'])
                ->make(true);
        }
       return view('admin.class_plan.index');
    }

    public function create()
    {
        $class_cat = ClassCategory::pluck('title','id');
        $tutor = User::where('role','=','tutor')->pluck('name','id');
        return view('admin.class_plan.create',compact('class_cat','tutor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filename ='';
        if ($request['photo']){

            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $filename = $request['picture'];
        }

        $class_plan = new ClassPlan;
        $class_plan->class_category_id = $request->class_category_id;
        $class_plan->host_id = $request->host_id;
        $class_plan->is_visible = $request->is_visible;
        $class_plan->title = $request->title;
        $class_plan->image = $filename;
        $class_plan->description = $request->description;
        $class_plan->price = $request->price;
        $class_plan->date_time = $request->date.' '.$request->time;
        $class_plan->is_group = 1;
        $class_plan->save();

        if($class_plan){
            Session::flash('message', 'Class Plan Created Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/class_plans');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class_plan = ClassPlan::find($id);

        $date_time = explode(' ', $class_plan->date_time);
        
        $class_plan->date = $date_time[0];
        $class_plan->time = $date_time[1];

        $class_cat = ClassCategory::pluck('title','id');
        $tutor = User::where('role','=','tutor')->pluck('name','id');
        return view('admin.class_plan.edit',compact('class_cat','tutor','class_plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $class_plan = ClassPlan::find($id);

        if ($request['photo']){

            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $filename = $request['picture'];
        }
        else{
            $filename = $class_plan->image;
        }

        $class_plan->class_category_id = $request->class_category_id;
        $class_plan->host_id = $request->host_id;
        $class_plan->is_visible = $request->is_visible;
        $class_plan->title = $request->title;
        $class_plan->image = $filename;
        $class_plan->description = $request->description;
        $class_plan->price = $request->price;
        $class_plan->date_time = $request->date.' '.$request->time;
        $class_plan->is_group = 1;
        
        $class_plan->save();

        if($class_plan){
            Session::flash('message', 'Class Plan Updated Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/class_plans');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class_plan = ClassPlan::find($id)->forceDelete();
        if($class_plan){
            return view('admin.class_plan.index');
        }
    }

    public function schedual_meeting(Request $request){
        $plan = new ClassPlan;
        $request['host_id'] = auth()->id();
        $request['is_group'] = $request->is_group ==1 ? 0:1;
        $plan = $plan->create($request->all());
        foreach ($request->participents as $user){
            $plan->enrollments()->attach($user,['is_paid'=>1]);
        }
        return redirect()->back();
    }

}
