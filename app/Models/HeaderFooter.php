<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderFooter extends Model
{
protected $primaryKey = 'id';
protected $table = "header_footers";
protected $fillable = ['logo',"whatsapp_no",'phone_no','location','whatsappIcon','phoneIcon'];
}
