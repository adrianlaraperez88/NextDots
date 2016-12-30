<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the tasks where prioperties was included.
     */
    public function tasks()
    {
        return $this->hasMany('App\Priority');
    }

}
