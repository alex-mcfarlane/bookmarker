<?php

namespace App\Queries;

use App\User;
use Illuminate\Support\Facades\Auth;

class BookmarkQuery extends Query
{
    protected $validFields = ['read'];

    protected function started($date)
    {
        // validate date
        if(!$this->validateDate($date)) {
            throw new \Exception('Invalid date');
        }

        return $this->builder->where('created_at', '>', $date);
    }

    protected function ended($date)
    {
        // validate date
        if(!$this->validateDate($date)) {
            throw new \Exception('Invalid date');
        }

        return $this->builder->where('created_at', '<', $date);
    }

    protected function newest($switch)
    {
        if ($switch) {
            return $this->builder->latest();
        }
        return $this->builder;
    }

    protected function owner($id)
    {
        if(User::find($id) == null) {
            throw new \Exception('No user found for the id ' . $id);
        }

        return $this->builder->where('user_id', $id);
    }

    protected function excludeUsers(array $userIds)
    {
        foreach($userIds as $id) {
            $this->builder->whereNotIn('user_id', $userIds);
        }

        return $this->builder;
    }

    protected function visibility($toggle)
    {
        switch($toggle) {
            case 'public':
                return $this->builder->withVisibility('Public');
            case 'private':
                return $this->builder->withVisibility('Private');
            default:
                return $this->builder;
        }
    }

    protected function access($userId)
    {
        if($userId != Auth::id()) {
            throw new \Exception('Permission Denied: You are not permitted to read bookmarks you haven\'t been granted access to.');
        }

        if(array_key_exists('owner', $this->params)) {
            return $this->builder->withAccess($userId, $this->params['owner']);
        } else {
            return $this->builder->withAccess($userId);
        }
    }

    private function validateDate($date)
    {
        $splitDate = explode('-', $date);

        if(count($splitDate) != 3) {
            return false;
        }

        return true;
    }
}