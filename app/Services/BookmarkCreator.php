<?php
namespace App\Services;

use App\Bookmark;
use App\BookmarkContext;
use App\Category;
use App\Exceptions\BaseException;
use App\User;
use App\Validators\BookmarkValidator;
use Illuminate\Support\Facades\Auth;

class BookmarkCreator
{
    /**
     * @var BookmarkValidator
     */
    protected $validator;
    /**
     * @var array[string, mixed]
     * optionalkey => defaultVal
     */
    protected $optionalKeys = ['description' => null, 'visibility_id' => 2];

    public function __construct(BookmarkValidator $validator)
    {
        $this->validator = $validator;
    }

    public function create(array $attrs, array $category_ids)
    {
        if(!$this->validator->validate($attrs)) {
            throw new BaseException("Bookmark exception", $this->validator->getErrors(), 412);
        }

        // format data to account for possible missing keys
        foreach($this->optionalKeys as $key => $defaultVal) {
            if(!array_key_exists($key, $attrs)) {
                $attrs[$key] = $defaultVal;
            }
        }

        /** @var User $user */
        $user = Auth::user();
        $context = new BookmarkContext($attrs['url'], $attrs['title'], $attrs['description']);

        // create bookmark for user and set the categories
        $bookmark = $user->createBookmark($context, $attrs['visibility_id']);
        $bookmark->setCategories($category_ids);

        return $bookmark;
    }
}