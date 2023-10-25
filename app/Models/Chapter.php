<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'chapters';

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
