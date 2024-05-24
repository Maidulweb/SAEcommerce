<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subCategories(){
        $this->hasMany(SubCategory::class);
    }

    public function childCategories(){
        $this->hasMany(ChildCategory::class);
    }


}
