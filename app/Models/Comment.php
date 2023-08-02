<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['name', 'user_id', 'comment'];

    public function getReplies()
    {
        return $this->hasMany(Reply::class, 'comment_id', 'id');
    }
}