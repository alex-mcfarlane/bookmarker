<?php

namespace Tests\Unit;

use App\Validators\BookmarkValidator;
use Tests\TestCase;

class ValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function bookmark_input_is_valid()
    {
        $validator = new BookmarkValidator();

        $isValid = $validator->validate([
            'url' => 'wwww.google.com',
            'title' => 'Bookmark title',
            'description' => 'Bookmark description'
        ]);

        $this->assertTrue($isValid);
    }
}