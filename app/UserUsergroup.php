<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserUsergroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'usergroup_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function user() {
        $this->belongsToMany('App\User');
    }

    public function usergroup() {
        $this->belongsToMany('App\Usergroup');
    }
}
