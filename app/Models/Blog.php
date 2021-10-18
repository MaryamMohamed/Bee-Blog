<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    // returns the instance of the user who is author of that blog
    public function user()
    {
        # code...
        return $this->belongsTo(User::class);
    }
    
}
