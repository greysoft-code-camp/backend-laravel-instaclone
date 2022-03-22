<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        "caption",
        "location",
        "photo"
    ];

    public function scopeAll($query)
    {
        return $query->all()->orderBy("created_at", "Desc");
    }

    public function formattedCreatedDate() {
        if ($this->created_at->diffInDays() > 30) {
            return $this->created_at->toFormattedDateString();
        } else {
            return $this->created_at->diffForHumans();
        }
    }
}
