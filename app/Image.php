<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path', 'blog_post_id'];

    public function blogPost()
    {
        return $this->belongsTo('App\BlogPost');
    }

    public function url()
    {
        return Storage::url($this->path);
    }
}
