<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KubAT\PhpSimple\HtmlDomParser;
use App\Http\Controllers\DatabaseController;

class CompanyController
{
	public function crawlIndustrySearch($url)
	{
		$dom = $this->curlRequest($url);

		$company = $dom->find('tr');

		if(!count($company) || !$company)
			return print_r('No Company records found. Please try some other key word'.PHP_EOL);

		foreach ($company as $key => $value) {
			if ($key == 0) continue;

			$td = $value->find('td');

			$nameRow = $td[1]->find('a',0);
			$name = html_entity_decode($nameRow->innertext());
			$link = $nameRow->href;

			print_r('Saving data for '.$name.PHP_EOL);

			$industry = (new DatabaseController())->saveIndustry(1, $name, $td[0]->innertext(), $td[2]->innertext(), $td[3]->innertext());

			$this->crawlIndustryDetails($link, $industry);
		}

		$dom->clear();
		unset($dom);
	}

	private function crawlIndustryDetails($link, $industry)
	{
		$link = 'http://www.mycorporateinfo.com/'.$link;

		$dom = $this->curlRequest($link);

		$description = strip_tags($dom->find('div[class=main_test]',0)->children(4));

		$table = $dom->find('div[id=companyinformation]',0)->children(1)->children(0);

		$incDate = substr($table->find('tr',3)->children(1)->children(2)->innertext(), -10);
		$regNum = $table->find('tr',4)->children(1)->innertext();

		$table = $dom->find('div[id=contactdetails]',0)->children(1)->children(0);
		$email = html_entity_decode(strip_tags($table->children(0)->children(1)->innertext()));
		$addres = html_entity_decode(strip_tags($table->children(1)->children(1)->innertext()));

		$table = $dom->find('div[id=otherinformation]',0)->children(2)->children(0);
		$state = $table->children(1)->children(1)->children(0)->innertext();
		$city = $table->children(2)->children(1)->children(0)->innertext();
		$pin = $table->children(3)->children(1)->children(0)->innertext();

		(new DatabaseController())->saveIndustryDetails($description, $industry->id, $incDate, $regNum, $email, $addres, $state, $city, $pin);
	}

	private function curlRequest($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$curlResponse = curl_exec($ch);
		curl_close($ch);

		return HtmlDomParser::str_get_html($curlResponse);
	}
}
