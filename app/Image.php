<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Image extends Model
{
    protected $baseDir = 'images';

    public static function fromRequest(UploadedFile $file)
    {
        $image = new static;

        $name = time(). str_replace(" ", "_", $file->getClientOriginalName());

        $image->path = $image->baseDir. '/' . $name;

        $image->store($file, $name);

        $image->save();

        return $image;
    }

    public function store(UploadedFile $file, $name)
    {
        $file->move($this->baseDir, $name);
    }
}
