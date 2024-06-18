<?php

namespace App\Models;

use App\Notifications\EmailReconfirmationNotification;
use App\Scopes\EmpresaScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'role',
        'id_empresa',
        'email_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function scopeFilterEmpresa(Builder $query): void{
        $query->where('id_empresa',Auth::user()->id_empresa);
    }
    public function empresa(){
        return $this->hasOne(Empresas::class,'id','id_empresa');
    }
    public function dados(){
        return $this->hasOne(DadosClientes::class,'id_user','id');
    }
    public function tokenAssas($id_empresa){
        return $this->hasOne(ClientesTokens::class,'id_user','id')->where('id_empresa',$id_empresa);
    }
   
 
 


}
