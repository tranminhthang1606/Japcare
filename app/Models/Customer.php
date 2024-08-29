<?php

namespace App\Models;

use App\Notifications\Auth\ResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use CanResetPassword;
    use Notifiable;

    protected $fillable = [
        'full_name',
        'user_name',
        'phone',
        'email',
        'sex',
        'birthdate',
        'avatar',
        'password',
        'remember_token',
        'is_active',
        'deleted_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function customersAddress()
    {
        return $this->hasMany(CustomersAddress::class, 'customer_id');
    }

    public function viewed() {
        return $this->hasMany(ViewedProduct::class, 'customer_id','id');
    }

    public function bought() {
        return $this->hasMany(BoughtProduct::class, 'customer_id');
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function orders() {
        return $this->hasMany(Order::class, 'customer_id');
    }

}
