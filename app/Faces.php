<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faces extends Model
{
    protected $table = 'faces';
    protected $fillable = [
        'x',
        'y',
        'width',
        'height',
        'neighbors',
        'confidence',
        'positionX',
        'positionY',
        'offsetX',
        'offsetY',
        'scaleX',
        'scaleY',
    ];
}
