<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
class Leads extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'leads';

    protected $fillable = [
        
        'id_empresa',
        'nome',
        'email',
        'telefone',
    ];

    public function scopeFilterEmpresa(Builder $query): void{
        $query->where('id_empresa',Auth::user()->id_empresa);
    }
}
