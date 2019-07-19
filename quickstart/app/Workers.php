<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Workers extends Model
{
    public function position()
    {
        return $this->belongsTo(Positions::class,'id_position');
    }
    
    public function worker()
    {
        return $this->belongsTo(Workers::class,'id_worker');    
    }
    
    public function getUrlFoto(){
        $f = Storage::disk('local');
        //$exists  = Storage::files('/public/storage/foto/'.$this->id);;
        $exists = $f->files('public/foto/'.$this->id);//file('/public/storage/foto/'.$this->id);
        if(!empty($exists)){ 
            $exists =  explode("/", $exists[0]);
            $str = "storage/foto/".$this->id."/".$exists[3];
            $exists = asset($str);//'public/foto/'.$this->id.'/'.
        }else{
            $exists = asset('storage/foto/default/avatar5.png');
        }
        return $exists;
    }
    
    public function getPosition(){
        if($this->id_position === NULL){
            return "не задан";  
        }else{
            return $this->position->name_position;
        } 
                                
    }
    
    public function getChief(){
        if($this->id_worker === NULL){
            return "не задан";  
        }else{
            return $this->worker->surname." ".$this->worker->name;
        } 
                                
    }
}
