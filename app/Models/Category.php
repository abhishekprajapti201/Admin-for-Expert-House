<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = ['category_name','slug'];
    protected $primaryKey = 'id';

    public function insight(){
        return $this->hasMany(InsightPages::class."cat_id");
    }
}
