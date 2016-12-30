<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'due_date','priority_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];


    public function users()
    {
        return $this->belongsToMany('App\User','user_tasks','user_id','task_id');
    }

    /*Get prioritie of the task*/
    public function priorities()
    {
        return $this->belongsTo('App\Priority', 'priority_id');
    }

}
