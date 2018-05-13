<?php

namespace App\Services;


use App\Bookmark;
use App\BookmarkContext;
use App\Exceptions\BaseException;
use App\Role;
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

        $context = new BookmarkContext($attrs['url'], $attrs['title'], $attrs['description']);
        $bookmark->edit($context, $category_ids, $attrs['visibility_id']);

        // grant read access to users
        $roleId = Role::$rolesMap['reader'];

        foreach($attrs['access'] as $userId) {
            $bookmark->grantAccess($userId, $roleId);
        }

        return $bookmark;
    }
}