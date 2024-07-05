<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function productImageGallery(){
        return $this->hasMany(ProductImageGallery::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function productVariant(){
        return $this->hasMany(ProductVariant::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function productReview(){
        return $this->hasMany(ProductReview::class);
    }
}
