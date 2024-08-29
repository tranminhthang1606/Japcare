<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'feedbacks';
    protected $fillable = [
        'title',
        'name',
        'status',
        'user_id',
        'content',
        'is_reply',
        'reply',
        'email'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
