<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'reply_id',
    ];

    protected $guarded = [];

    public function commentable()
    {
        return $this->morphTo();
    }

    // References comment id so no polymorphic relation
    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
