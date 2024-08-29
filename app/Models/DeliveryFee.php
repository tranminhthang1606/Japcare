<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryFee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'delivery_fees';

    protected $fillable = [
        'id',
        'matp',
        'fee',
        'admin_change',
        'time_change',
        'status',
        'admin_id',
        'deleted_at',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'matp', 'matp');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'admin_change');
    }
}
