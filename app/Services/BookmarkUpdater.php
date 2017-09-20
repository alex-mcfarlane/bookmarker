<?php

namespace App\Services;


use App\Bookmark;
use App\Exceptions\BaseException;
use App\Validators\BookmarkValidator;

class BookmarkUpdater
{
    protected $validator;

    public function __construct(BookmarkValidator $validator)
    {
        $this->validator = $validator;
    }

    public function update(Bookmark $bookmark, array $attrs, array $category_ids)
    {
        if(!$this->validator->validate($attrs)) {
            throw new BaseException('Invalid input', $this->validator->getErrors());
        }

        $bookmark->edit($attrs['url'], $attrs['title'], $attrs['description'], $category_ids);

        return $bookmark;
    }
}