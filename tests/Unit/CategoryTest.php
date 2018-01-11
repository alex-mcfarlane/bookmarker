<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2017-10-07
 * Time: 11:29 AM
 */

namespace Tests\Unit;

use App\Bookmark;
use App\BookmarkContext;
use App\Category;
use App\Image;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->seed('VisibilitiesTableSeeder');
    }

    /**
     * @test
     */
    public function can_get_popular_categories()
    {
        $category = Category::create(['title' => 'Test']);
        $user = factory(User::class)->create();
        $context1 = new BookmarkContext("http://google.com", 'Google', 'Search Engine');
        $context2 = new BookmarkContext('www.laravel.com', 'Laravel', 'Awesome PHP framework.');

        $bookmark = $user->createBookmark($context1)->addCategory($category);
        $bookmark2 = $user->createBookmark($context1)->addCategory($category);

        $popularCategories = Category::popular()->get();

        $this->assertEquals(true, $popularCategories->contains($category));
    }

    /**
     * @test
     */
    public function can_add_an_image()
    {
        $category = Category::create(['title' => 'Test']);
        $fakeUpload = UploadedFile::fake()->image('category.jpg');
        $image = $category->addImage($fakeUpload);

        $this->assertEquals($image->toArray(), $category->image->toArray());
    }
}