<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2017-10-07
 * Time: 11:29 AM
 */

namespace Tests\Unit;

use App\Bookmark;
use App\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function can_get_popular_categories()
    {
        $category = Category::create(['title' => 'Test']);
        $bookmark = Bookmark::fromForm('google.com', 'Google', 'Great search engine.')
                    ->addCategory($category);
        $bookmark2 = Bookmark::fromForm('www.laravel.com', 'Laravel', 'Awesome PHP framework.')
            ->addCategory($category);

        $popularCategories = Category::popular()->get();

        $this->assertEquals(true, $popularCategories->contains($category));
    }
}