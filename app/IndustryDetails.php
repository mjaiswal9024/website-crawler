<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndustryDetails extends Model
{
    protected $table = 'industry_details';

    protected $fillable = ['industry_list_id', 'description', 'incorporation_date', 'registration_number', 'email', 'office_address', 'state', 'city', 'pin'];
}
