<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewForm extends Model
{
    use HasFactory;
    protected $guarded = false;
    public function from_review()
    {
        return $this->belongsTo(Review::class, 'review_id', 'id');
    }
}
