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
    public function sendEmailReconfirmationNotification()
{
    $this->notify(new EmailReconfirmationNotification);
}
    public function getFirstNameAttribute($value)
    {
        $explode = explode(' ', $this->name);
      
        return ucfirst($explode[0]);
    }
    public function getProfileAttribute($value)
    {
      
        return base64_decode($value);
    }

   
    public function empresa(){
        return $this->hasOne(Empresa::class,'id','id_empresa');
    }

    public function comunicacao(){
        return $this->hasOne(UserComunicacao::class,'id_user','id');
    }

    public function profile($w = 'sm'){
       
        if($this->profile == ""){
            return '<span class="first-caracter '.$w.'">'.substr($this->name,0,1).'</span>';
        }else{
            return '<img src="'. $this->profile .'" class="img-fluid img-thumbnail rounded-circle img-perfil '.$w.'">' ;                             
        }
    }

    public function notificacoesPessoais(){
        return $this->hasMany(Notificacoes::class,'id_user','id')->where('grupo','financas_pessoais');
    }
    public function notificacoesEmpresas(){
        return $this->hasMany(Notificacoes::class,'id_empresa','id_empresa')->where('grupo','gestao_financeira');
    }
    public function confis(){
        return $this->hasMany(UsersConfis::class,'id_user','id')->get()->pluck('value','param');
   }
}
