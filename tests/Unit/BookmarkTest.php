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

        $bookmark = Bookmark::fromForm("www.google.com", 'Google', 'Search Engine', [$category]);

        $this->assertEquals($bookmark->url, "www.google.com");
        $this->assertEquals($bookmark->title, "Google");
        $this->assertEquals($bookmark->description, "Search Engine");
        $this->assertTrue($bookmark->categories->contains($category));
    }
}