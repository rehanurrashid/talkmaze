<?php

namespace App\Http\Controllers;

use App\UserPlan;
use Illuminate\Http\Request;
use App\Plan;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StorePlan;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            $plan = Plan::select(['id', 'name', 'duration','price','description' ,'created_at', 'updated_at']);
            return Datatables::of($plan)
                ->addColumn('action', function ($plan) {
                    return view('admin.actions.actions_plan',compact('plan'));
                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }
       return view('admin.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlan $request)
    {
        $plan = new Plan;
        $plan->name = $request->name;
        $plan->duration = $request->duration;
        $plan->price = $request->price;
        $plan->description = $request->description;
        $plan->save();

        if($plan){
            Session::flash('message', 'Plan Created Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/plans');
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
        $plan = Plan::find($id);
        return view('admin.plan.edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePlan $request, $id)
    {
        $plan = Plan::find($id);
        $plan->name = $request->name;
        $plan->duration = $request->duration;
        $plan->price = $request->price;
        $plan->description = $request->description;
        $plan->save();

        if($plan){
            Session::flash('message', 'Plan Updated Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/plans');
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

        $plan = Plan::find($id)->delete();
        if($plan){
            return view('admin.plan.index');
        }
    }

    public function userplan(Request $request){
        $uf = UserPlan::where('user_id',auth()->id())->first();
        if($uf){
            $uf->update(['plan_id'=>$request->plan]);
        }else{
            $up = new UserPlan;
            $up->create(['user_id'=>auth()->id(),'plan_id'=>$request->plan]);
        }
        if($request->from == 'dashboard'){
            return response()->json(['url'=>url('/tutor-list/'.$request->data_id)]);
        }else{
            return response()->json(['url'=>url('/dashboard-home')]);
        }
    }
}
