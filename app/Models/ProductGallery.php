<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = ['image' , 'alt'];
    
    public function product()
    {
        return $this->belongsTo(product::class);
    }
}