<?php

namespace App\Models;

use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Model;
use URL;
use Image;
use File;
use Illuminate\Support\Facades\Auth;

class Media extends Model
{
    protected $table = 'media';
    protected $appends = array('CheckTypeFile');
    protected $fillable = [
        'id',
        'file',
        'alt',
        'type',
        'folder_parent',
        'folder',
        'id_empresa'
    ];


    public function scopeEmpresa($query)
    {
        return $query->where('id_empresa', '=', Auth::user()->id_empresa);
    }
    public function fullpatch($width = null, $height = null)
    {


        return URL::to('/') . '/'. $this->folder_parent . $this->folder . $this->file ?? null;
    }
    public function getCheckTypeFileAttribute()
    {
        return $this->CheckType();
    }
    public function CheckType()
    {
        $type = $this->type;
        if (in_array(strtolower($type), ['jpg', 'png', 'gif', 'tif', 'svg', 'webp', 'jpeg'])) {
            return "image";
        } elseif (in_array($type, ['mov', 'mp4', 'avi', '3gp'])) {
            return "video";
        } elseif (in_array($type, ['pdf', 'word', 'ppt', 'xls'])) {
            return "document";
        } else {
            return "outher";
        }
    }
}
