<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntryTags extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'entry_id',
        'tag_name'
    ];
}
