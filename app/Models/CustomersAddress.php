<?php

namespace App\Models;

use App\Models\Ward;
use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersAddress extends Model
{
    use HasFactory;

    protected $table = 'customers_address';

    protected $fillable = [
        'customer_id',
        'client_name',
        'client_phone',
        'is_default',
        'province_id',
        'district_id',
        'ward_id',
        'address'
    ];

    public $timestamps = true;

    public  function city(){
        return $this->hasOne(Province::class, 'matp', 'province_id');
    }

    public function district(){
        return $this->hasOne(District::class,'maqh','district_id');
    }

    public function ward(){
        return $this->hasOne(Ward::class,'xaid','ward_id');
    }

}
