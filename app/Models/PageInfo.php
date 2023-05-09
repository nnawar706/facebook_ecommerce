<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageInfo extends Model
{
    use HasFactory;

    protected $table = 'page_info';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
