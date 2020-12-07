<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KubAT\PhpSimple\HtmlDomParser;
use App\Industry;

class CrawlingController extends Controller
{
	public function CrawlIndustryData ($url, $category)
	{
		$method = 'Crawl'.ucfirst(strtolower($category));

		if(!method_exists($this, $method))
			return print_r('Category not implemented. Please try some other Category'.PHP_EOL);

		self::$method($url);
	}

	private function CrawlCompany ($url)
	{
		$curlResponse = $this->curlRequest($url);

		$dom = HtmlDomParser::str_get_html($curlResponse);

		$company = $dom->find('tr');

		if(!count($company) || !$company)
			return print_r('No Company records found. Please try some other key word'.PHP_EOL);

		foreach ($company as $key => $value) {
			if ($key == 0) continue;

			$td = $value->find('td');
			$name = html_entity_decode($td[1]->find('a')[0]->innertext());

			print_r('Saving data for '.$name.PHP_EOL);

			$this->saveIndustry(1, $name, $td[0]->innertext(), $td[2]->innertext(), $td[3]->innertext());
		}

		$dom->clear();
		unset($dom);
	}

	private function CrawlCin ($url)
	{
		return print_r('Only "Company" category implemented for now.'.PHP_EOL);
	}

	private function CrawlDin ($url)
	{
		return print_r('Only "Company" category implemented for now.'.PHP_EOL);
	}

	private function CrawlDirector ($url)
	{
		return print_r('Only "Company" category implemented for now.'.PHP_EOL);
	}

	private function CrawlTrademark ($url)
	{
		return print_r('Only "Company" category implemented for now.'.PHP_EOL);
	}

	private function saveIndustry($category, $name, $cin, $state, $status)
	{
		Industry::firstOrCreate(
			['name' => $name],
			['category_id' => $category,'cin' => $cin, 'state' => $state, 'status' => $status]
		);
	}

	private function curlRequest ($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}
}
