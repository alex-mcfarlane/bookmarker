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
use App\Image;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
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

    /**
     * @test
     */
    public function can_add_an_image()
    {
        $category = Category::create(['title' => 'Test']);
        $image = Image::fromRequest(UploadedFile::fake()->image('category.jpg'));
        $category->addImage($image);

        $this->assertEquals($image->toArray(), $category->image->toArray());
    }
}