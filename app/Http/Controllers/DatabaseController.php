<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industry;
use App\IndustryDetails;

class DatabaseController
{
	public function saveIndustry($category, $name, $cin, $state, $status)
	{
		return Industry::firstOrCreate(
			['name' => $name],
			['category_id' => $category,'cin' => $cin, 'state' => $state, 'status' => $status]
		);
	}

	public function saveIndustryDetails($desc, $indusId, $incDate, $regNum, $email, $addr, $state, $city, $pin)
	{
		return IndustryDetails::firstOrCreate(
			['industry_list_id' => $indusId],
			['description' => $desc, 'incorporation_date' => date('Y-m-d',strtotime($incDate)), 'registration_number' => $regNum, 'email' => $email, 'office_address'=> $addr, 'state'=> $state, 'city'=> $city, 'pin'=> $pin]
		);
	}
}
