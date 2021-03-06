<?php
namespace App\Repositories;

use App\Positions;

class PositionRepository
{
    public $name_position;
    public $created_at;
    public $updated_at;
    public $order_position_name;
    public $order_created_at;
    public $order_updated_at;

    public function __construct()
    {
        $this->name_position = NULL;
        $this->created_at = NUll;
        $this->updated_at = NULL;
        $this->order_position_name = NULL; 
        $this->order_created_at = NULL;
        $this->order_updated_at = NULL;
    }
    
    public function GetPositions()
    {
        $qwery = Positions::paginate(10);
        return $qwery;
        
    }
    
    public function SearchPosition()
    {
        $arrayWhere = array();
        $Order = '';
        $sort = '';
        if(!empty($this->name_position)){
            $arrayWhere[] = ['name_position',$this->name_position];
        }
        if(!empty($this->created_at)){
            $arrayWhere[] = ['created_at','>=',date("Y-m-d",strtotime($this->created_at))];
            $arrayWhere[] = ['created_at','<',date("Y-m-d",(strtotime($this->created_at))+86400)];
        }
         if(!empty($this->updated_at)){
            $arrayWhere[] = ['updated_at','>=',date("Y-m-d",strtotime($this->updated_at))];
            $arrayWhere[] = ['updated_at','<',date("Y-m-d",(strtotime($this->updated_at))+86400)];
        }
        $i = 0;
        if(!empty($this->order_position_name)){
           $Order = 'name_position';
           $sort = $this->order_position_name;
           $i++;
        }
        if(!empty($this->order_created_at)){
           $Order = 'created_at';
           $sort = $this->order_created_at;
           $i++;
        }
        if(!empty($this->order_updated_at)){
           $Order = 'updated_at';
           $sort = $this->order_updated_at;
           $i++;
        }
        if($i!=0)
        {
            $qwery = Positions::where($arrayWhere)->orderBy($Order, $sort)->paginate(10);
        }else{
            $qwery = Positions::where($arrayWhere)->paginate(10);
        }    
        return $qwery;        
    }
    public function getGlifkon($name)
    {
        if(!empty($this->$name)){
            if(strcasecmp ("ASC" , $this->$name) == 0)
            {
                return "glyphicon glyphicon-sort-by-attributes-alt";
            }else{
                return "glyphicon glyphicon-sort-by-attributes";
            }    
        }else{
            return "";
        }
    }
}
