<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2017-06-10
 * Time: 12:50 PM
 */

namespace Tests\Unit;


use App\Bookmark;
use App\Category;
use Carbon\Carbon;
use App\Queries\BookmarkQuery;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BookmarkTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function can_create_a_categorized_bookmark()
    {
        $category = Category::create(['title' => 'Basics']);

        $bookmark = Bookmark::fromForm("www.google.com", 'Google', 'Search Engine');
        $bookmark->addCategory($category);

        $this->assertEquals($bookmark->url, "www.google.com");
        $this->assertEquals($bookmark->title, "Google");
        $this->assertEquals($bookmark->description, "Search Engine");
        $this->assertTrue($bookmark->categories->contains($category));
    }

    /**
     * @test
     */
    public function can_filter_bookmarks()
    {
        $filter_date = Carbon::now();
        $filter_date->subSecond();

        $bookmark1 = Bookmark::fromForm("www.google.com", 'Google', 'Search Engine');
        $bookmark2 = Bookmark::fromForm("www.laracasts.com", 'Laracasts', 'Laravel and PHP Tutorials', []);
        $bookmark3 = Bookmark::fromForm("www.sherdog.com", 'Sherdog', 'MMA News', []);

        $yesterday = Carbon::yesterday();
        $bookmark2->created_at = $yesterday;
        $bookmark2->save();

        $bookmarkQuery = new BookmarkQuery(['started' => $filter_date]);
        $collection = $bookmarkQuery->applyFilters((new Bookmark)->query())->get();

        $this->assertTrue($collection->contains($bookmark1));
        $this->assertTrue($collection->contains($bookmark3));
    }
}