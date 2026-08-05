<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsightPages extends Model
{
    protected $table = "insight_pages";
    protected $primaryKey = 'id';
    protected $fillable = ['heading','paragraph','image','description','created_by','note','date','cat_id'];

    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }
}
