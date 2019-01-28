<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title','description','published_date', 'user_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
