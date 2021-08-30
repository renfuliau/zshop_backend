<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password', 'phone', 'address', 'total_shopping_amount', 'reward_money', 'role', 'user_level_id', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function new (array $data) {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'active',
            'user_level_id' => 1,
        ]);
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'user_id');
    }

    public function userLevel()
    {
        return $this->hasOne('App\Models\UserLevel', 'id', 'user_level_id');
    }
}
