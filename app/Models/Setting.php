<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';

    protected $fillable = [
        'st_name_site',
        'st_logo',
        'admin_logo',
        'favicon',
        'phone',
        'hotline',
        'email',
        'url_website',
        'footer_about',
        'facebook',
        'youtube',
        'tiktok',
        'shopee',
        'instagram',
        'banner_top',
        'copyright',
        'address',
        'working_time',
        'customer_service',
        'meta_description',
        'meta_keywords',
        'product_service',
        'purchase_guide_banner',
        'bank_transfer_guide',
        'ship_block',
        'footer_service',
    ];
}
