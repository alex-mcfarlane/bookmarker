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

        $bookmark = Bookmark::fromForm($attrs['url'], $attrs['title'], $attrs['description']);

        foreach($category_ids as $category_id) {
            if($category = Category::find($category_id)) {
                $bookmark->addCategory($category);
            }
        }

        return $bookmark;
    }
}