<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id', 'user_id', 'name', 'mobile', 'item', 'item_id', 'title', 'content',
        'rate', 'status', 'likes', 'dislikes',
    ];

    public static array $statuses = [
        'active' => 'فعال',
        'inactive' => 'غیر فعال',
    ];

    public static array $statusesLabels = [
        'active' => 'badge badge-success',
        'inactive' => 'badge badge-warning',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function course(): BelongsTo|bool
    {
        if($this->item == 'course') {
            return $this->belongsTo(Course::class, 'item_id');
        }
        return false;
    }
}
