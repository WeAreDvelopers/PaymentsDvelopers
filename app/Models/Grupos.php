<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Grupos extends Model
{
    use HasFactory;
    protected $table = 'grupos';
    protected $appends = ['url'];
    
    protected $fillable = [
        'id_empresa',
        'descricao',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getUrlAttribute($value)
    {
        return route('getProductsByGroup',['id'=>$this->id]);
    }

}
