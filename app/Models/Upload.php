<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'status',
        'uploaded_at',
        'completed_at',
    ];

    // Optional: jika mahu relasi ke products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
