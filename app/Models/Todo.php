<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //テーブル名
    protected $table = 'todos';

    //可変項目
    protected $fillable = [
        'title'
    ];
}
