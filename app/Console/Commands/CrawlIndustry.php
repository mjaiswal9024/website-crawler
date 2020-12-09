<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;
use App\Http\Controllers\CrawlingController;

class CrawlIndustry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:industry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to crawl website and load data in our database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $categories = Category::pluck('name')->toArray();

        if (!count($categories)) {
            return $this->info('No category to choose. Please load the category first');
        }
        
        $category = $this->choice('What is your name?', $categories, 'Company');

        $searchStr = $this->ask('Enter your query');

        $url = 'http://www.mycorporateinfo.com/find/?code='.$searchStr.'&option='.$category.'&page=1';

        (new CrawlingController())->CrawlIndustryData($url, $category);
    }
}
