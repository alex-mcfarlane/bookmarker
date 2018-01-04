<?php
namespace App\Services;

use App\Bookmark;
use App\Category;
use App\Exceptions\BaseException;
use App\Validators\BookmarkValidator;

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

        $bookmark = $user->createBookmark($attrs['url'], $attrs['title'], $attrs['description'], $attrs['visibility_id']);
        $bookmark->setCategories($category_ids);

        return $bookmark;
    }
}