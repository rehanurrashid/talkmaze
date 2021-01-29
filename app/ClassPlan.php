<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassPlan extends Model
{
    protected $fillable = ['title','description','date_time','host_id','is_group'];
    public function category(){
        return $this->belongsTo(ClassCategory::class,'class_category_id');
    }
    public function enrollments(){
        return $this->belongsToMany(User::class,'enrolled_user','class_plan_id','user_id');
    }
    public function host(){
        return $this->belongsTo(User::class,'host_id','id');
    }
}
