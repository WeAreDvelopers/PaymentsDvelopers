<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    
    protected $fillable = [

        'id_produto',
        'id_media_popup',
        'informativo',
        'status'
    ];

 public function media(){
        return $this->hasOne(Media::class,'id','id_media_popup');
  }
}


