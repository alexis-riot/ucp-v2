<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugImage extends Model
{
    protected $table = "cp_bugs_images";
    protected $fillable = [
        'bug_id', 'path',
    ];

    protected $allowedExtensions = array('.png', '.jpg', '.jpeg');

    public function isValidImage()
    {
        return preg_match_all("/\b(" . implode($this->allowedExtensions, "|") . ")\b/i", $this->path);
    }
}
