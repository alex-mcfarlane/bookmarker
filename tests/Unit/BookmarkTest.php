<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2017-06-10
 * Time: 12:50 PM
 */

namespace Tests\Unit;


use App\Bookmark;
use App\BookmarkContext;
use App\Category;
use App\Role;
use App\User;
use Carbon\Carbon;
use App\Queries\BookmarkQuery;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class BookmarkTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->seed('RolesTableSeeder');
        $this->seed('VisibilitiesTableSeeder');
    }

    /**
     * @test
     */
    public function user_can_create_a_bookmark()
    {
        $context = new BookmarkContext("http://google.com", 'Google', 'Search Engine');
        $user = factory(User::class)->create();

        $bookmark = $user->createBookmark($context);

        $this->assertEquals($bookmark->user->id, $user->id);
    }


    /**
     * @test
     */
    public function can_create_a_categorized_bookmark()
    {
        $category = Category::create(['title' => 'Basics']);
        $context = new BookmarkContext("http://google.com", 'Google', 'Search Engine');
        $user = factory(User::class)->create();

        $bookmark = $user->createBookmark($context);
        $bookmark->addCategory($category);

        $this->assertEquals($bookmark->url, "http://google.com");
        $this->assertEquals($bookmark->title, "Google");
        $this->assertEquals($bookmark->description, "Search Engine");
        $this->assertTrue($bookmark->categories->contains($category));
    }

    /**
     * @test
     */
    public function can_create_a_public_bookmark()
    {
        $context = new BookmarkContext("http://google.com", 'Google', 'Search Engine');
        $user = factory(User::class)->create();

        $bookmark = $user->createBookmark($context);

        $this->assertEquals($bookmark->visibility->name, 'Public');
    }

    /**
     * @test
     */
    public function can_filter_bookmarks()
    {
        $user = factory(User::class)->create();
        $context1 = new BookmarkContext("www.google.com", 'Google', 'Search Engine');
        $context2 = new BookmarkContext("www.laracasts.com", 'Laracasts', 'Laravel and PHP Tutorials');
        $context3 = new BookmarkContext("www.sherdog.com", 'Sherdog', 'MMA News');
        $filter_date = Carbon::now();
        $filter_date->subSecond();

        $bookmark1 = $user->createBookmark($context1);
        $bookmark2 = $user->createBookmark($context2);
        $bookmark3 = $user->createBookmark($context3);

        $yesterday = Carbon::yesterday();
        $bookmark2->created_at = $yesterday;
        $bookmark2->save();

        $bookmarkQuery = new BookmarkQuery(['started' => $filter_date]);
        $collection = $bookmarkQuery->applyFilters((new Bookmark)->query())->get();

        $this->assertTrue($collection->contains($bookmark1));
        $this->assertTrue($collection->contains($bookmark3));
    }

    /**
     * @test
     */
    public function can_create_a_private_bookmark()
    {
        $user = factory(User::class)->create();
        $context = new BookmarkContext("http://google.com", 'Google', 'Search Engine');

        $bookmark = $user->createBookmark($context, 1);

        $this->assertEquals($bookmark->visibility->name, 'Private');
    }

    /**
     * @test
     */

    public function can_format_invalid_href()
    {
        $user = factory(User::class)->create();
        $context = new BookmarkContext("http://google.com", 'Google', 'Search Engine');

        $bookmark = $user->createBookmark($context);

        $this->assertEquals('http://google.com', $bookmark->url);
    }

    /**
     * @test
     */
    public function can_grant_access_to_a_private_bookmark()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $this->be($user2);

        $context = new BookmarkContext("http://google.com", 'Google', 'Search Engine');
        $context2 = new BookmarkContext("www.laracasts.com", 'Laracasts', 'Laravel and PHP Tutorials');
        $context3 = new BookmarkContext("www.sherdog.com", 'Sherdog', 'MMA News');

        $bookmark = $user1->createBookmark($context, 1);
        $bookmark2 = $user1->createBookmark($context2, 1);
        $bookmark3 = $user2->createBookmark($context3, 1);

        $bookmark->grantAccess($user2->id, Role::$rolesMap['reader']);

        $query = new BookmarkQuery(['visibility' => 'private', 'access' => $user2->id]);

        $bookmarks = $query->applyFilters(Bookmark::query())->get();

        dd($bookmarks);
    }
}