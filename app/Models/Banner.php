<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $primaryKey = 'id';

    protected $fillable = ['video_url', 'heading', 'first_button', 'second_button'];
}
