<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $table = 'industry_list';

    protected $fillable = ['category_id', 'name', 'cin', 'state', 'status'];
}
