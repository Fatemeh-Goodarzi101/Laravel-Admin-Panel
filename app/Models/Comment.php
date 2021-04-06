<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['comment' , 'approved' , 'parent_id' , 'commentable_id' , 'commentable_type' ];    

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function child()
    {
        return $this->hasMany(Comment::class , 'parent_id' , 'id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
