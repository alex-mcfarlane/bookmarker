<?php
namespace App\Services;

use App\Bookmark;
use App\BookmarkContext;
use App\Category;
use App\Exceptions\BaseException;
use App\Validators\BookmarkValidator;
use Illuminate\Support\Facades\Auth;

class BookmarkCreator
{
    /**
     * @var BookmarkValidator
     */
    protected $validator;

    public function __construct(BookmarkValidator $validator)
    {
        $this->validator = $validator;
    }

    public function create($attrs, array $category_ids)
    {
        if(!$this->validator->validate($attrs)) {
            throw new BaseException("Bookmark exception", $this->validator->getErrors(), 412);
        }

        $user = Auth::user();
        $context = new BookmarkContext($attrs['url'], $attrs['title'], $attrs['description']);

        // create bookmark for user and set the categories
        $bookmark = $user->createBookmark($context, $attrs['visibility_id']);
        $bookmark->setCategories($category_ids);

        return $bookmark;
    }
}