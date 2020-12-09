<?php

namespace App\Http\Controllers;

use KubAT\PhpSimple\HtmlDomParser;
use App\Http\Controllers\DatabaseController;

class CrawlingController
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
		(new CompanyController())->crawlIndustrySearch($url);
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
}
