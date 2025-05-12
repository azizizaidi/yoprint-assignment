<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'upload_id',
        'unique_key',
        'product_title',
        'product_description',
        'style',
        'mainframe_color',
        'size',
        'color_name',
        'piece_price',
    ];

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
