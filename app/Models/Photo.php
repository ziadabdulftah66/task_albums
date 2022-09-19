<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table='photos';
    protected $guarded=[];
    public function getPhotoAttribute($value){
        return ($value!==null)?asset('assets/photos/'.$value):"";
    }
    public function album(){
    return   $this->belongsTo(Album::class,'album_id');
    }
}
