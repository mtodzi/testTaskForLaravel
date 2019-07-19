<?php
namespace App\Repositories;

use App\Workers;
use Illuminate\Support\Facades\DB;

class WorkersRepository
{    
    public $surname;
    public $name;
    public $patronymic;
    public $date_receipt;
    public $salary;
    public $chief;
    public $name_position;
    public $created_at;
    public $updated_at;
    public $order_surname;
    public $order_name;
    public $order_patronymic;
    public $order_date_receipt;
    public $order_salary;
    public $order_chief;
    public $order_name_position;
    public $order_created_at;
    public $order_updated_at;
    public $page;
    public $count;
    public $limit;




    public function __construct()
    {
        $this->surname = NULL;
        $this->name = NULL;
        $this->patronymic = NULL;
        $this->date_receipt = NULL;
        $this->salary = NULL;
        $this->chief = NULL;
        $this->name_position = NULL;
        $this->created_at = NULL;
        $this->updated_at = NULL;
        $this->order_surname = NULL;
        $this->order_name = NULL;
        $this->order_patronymic = NULL;
        $this->order_date_receipt = NULL;
        $this->order_salary = NULL;
        $this->order_chief = NULL;
        $this->order_name_position = NULL;
        $this->order_created_at = NULL;
        $this->order_updated_at = NULL;
        $this->page = 1;
        $this->count = Workers::count();
        $this->limit = 10;
        
    }
    public function GetWorkers()
    {
        $qwery = Workers::select('*')->limit($this->limit)->get();
        return $qwery;
        
    }
    
     public function SearchPosition()
    {
        $arrayWhere = array();
        $arrayJoin = array();
        $Order = '';
        $sort = '';
        $keyJoin = 0;
        if(!empty($this->order_name_position)|| !empty($this->order_chief)){
            $keyJoin = 1;
        }
        if(!empty($this->name_position)){
            $keyJoin = 1;
            //$arrayJoin[] = ['positions','workers.id_position','=','positions.id'];
            $arrayWhere[] = ['positions.name_position',"=",$this->name_position];
        }
        if(!empty($this->chief)){
            $keyJoin = 1;
            //$arrayJoin[] = ['workers','workerss.chief','=','workerss.id'];
            $arrayWhere[] = ['l2.surname',"=",$this->chief];
        }
        if(!empty($this->surname)){
            if($keyJoin == 0){
                $arrayWhere[] = ['surname',$this->surname];
            }else{
                $arrayWhere[] = ['l1.surname',$this->surname];
            }    
        }
        if(!empty($this->name)){
            if($keyJoin == 0){
                $arrayWhere[] = ['name',$this->name];
            } else {
                $arrayWhere[] = ['l1.name',$this->name];    
            }    
        }
        if(!empty($this->patronymic)){
            if($keyJoin == 0){
                $arrayWhere[] = ['patronymic',$this->patronymic];
            } else {
                $arrayWhere[] = ['l1.patronymic',$this->patronymic];
            }    
        }
        if(!empty($this->salary)){
            if($keyJoin == 0){
                $arrayWhere[] = ['salary',$this->salary];
            }else{
                $arrayWhere[] = ['l1.salary',$this->salary];
            }    
        }
        if(!empty($this->date_receipt)){
            if($keyJoin == 0){
                $arrayWhere[] = ['date_receipt','=',date("Y-m-d",strtotime($this->date_receipt))];
            }else{
                $arrayWhere[] = ['l1.date_receipt','=',date("Y-m-d",strtotime($this->date_receipt))];
            }    
                
        }
        if(!empty($this->created_at)){
            if($keyJoin == 0){
                $arrayWhere[] = ['created_at','>=',date("Y-m-d",strtotime($this->created_at))];
                $arrayWhere[] = ['created_at','<',date("Y-m-d",(strtotime($this->created_at))+86400)];
            }else{
                $arrayWhere[] = ['l1.created_at','>=',date("Y-m-d",strtotime($this->created_at))];
                $arrayWhere[] = ['l1.created_at','<',date("Y-m-d",(strtotime($this->created_at))+86400)];
            }            
        }
        if(!empty($this->updated_at)){
            if($keyJoin == 0){
                $arrayWhere[] = ['updated_at','>=',date("Y-m-d",strtotime($this->updated_at))];
                $arrayWhere[] = ['updated_at','<',date("Y-m-d",(strtotime($this->updated_at))+86400)];
            }else{
                $arrayWhere[] = ['l1.updated_at','>=',date("Y-m-d",strtotime($this->updated_at))];
                $arrayWhere[] = ['l1.updated_at','<',date("Y-m-d",(strtotime($this->updated_at))+86400)];
            }    
        }
        $i = 0;
        if(!empty($this->order_surname)){
           if($keyJoin == 0){ 
            $Order = 'surname';
            $sort = $this->order_surname;
            $i++;
           }else{
            $Order = 'l1.surname';
            $sort = $this->order_surname;
            $i++;
           }
        }
        if(!empty($this->order_name)){
           if($keyJoin == 0){
            $Order = 'name';
            $sort = $this->order_name;
            $i++;
           }else{
            $Order = 'l1.name';
            $sort = $this->order_name;
            $i++;
           } 
        }
        if(!empty($this->order_patronymic)){
           if($keyJoin == 0){ 
            $Order = 'patronymic';
            $sort = $this->order_patronymic;
            $i++;
           }else{
            $Order = 'l1.patronymic';
            $sort = $this->order_patronymic;
            $i++;
           } 
        }
        if(!empty($this->order_salary)){
           if($keyJoin == 0){ 
            $Order = 'salary';
            $sort = $this->order_salary;
            $i++;
           }else{
            $Order = 'l1.salary';
            $sort = $this->order_salary;
            $i++;
           } 
        }
        if(!empty($this->order_date_receipt)){
           if($keyJoin == 0){ 
            $Order = 'date_receipt';
            $sort = $this->order_date_receipt;
            $i++;
           }else{
            $Order = 'l1.date_receipt';
            $sort = $this->order_date_receipt;
            $i++;
           } 
        }
        if(!empty($this->order_name_position)){
           $keyJoin = 1;  
           $Order = 'positions.name_position';
           $sort = $this->order_name_position;
           $i++;
        }
        if(!empty($this->order_chief)){
           $keyJoin = 1;  
           $Order = 'l2.surname';
           $sort = $this->order_chief;
           $i++;
        }
        if(!empty($this->order_created_at)){
           if($keyJoin == 0){ 
            $Order = 'created_at';
            $sort = $this->order_created_at;
            $i++;
           }else{
            $Order = 'l1.created_at';
            $sort = $this->order_created_at;
            $i++;
           } 
        }
        if(!empty($this->order_updated_at)){
           if($keyJoin == 0){ 
            $Order = 'updated_at';
            $sort = $this->order_updated_at;
            $i++;
           }else{
            $Order = 'l1.updated_at';
            $sort = $this->order_updated_at;
            $i++;    
           } 
        }
        if($i!=0)
        {   if($keyJoin ==0){
                $this->count = Workers::where($arrayWhere)->count();         
                $qwery = Workers::where($arrayWhere)->orderBy($Order, $sort)->offset(($this->page*$this->limit)-$this->limit)->limit($this->limit)->get();
                if($this->count<=10){
                    $this->page = 1;
                }
            }else{

                $this->count = Workers::from('workers AS l1')
                        ->leftJoin('positions','l1.id_position','=','positions.id')
                        ->join('workers AS l2','l1.id_worker','=','l2.id')
                        ->where($arrayWhere)->count();         
                $qwery = Workers::select(
                            'l1.id as id',
                            'l1.surname as surname',
                            'l1.name as name',
                            'l1.patronymic as patronymic',
                            'l1.date_receipt as date_receipt',
                            'l1.salary as salary',
                            'l1.id_position as id_position',
                            'l1.id_worker as id_worker',
                            'l1.created_at as created_at',
                            'l1.updated_at as updated_at'
                        )->from('workers AS l1')
                        ->leftJoin('positions','l1.id_position','=','positions.id')
                        ->join('workers AS l2','l1.id_worker','=','l2.id')
                        ->where($arrayWhere)->orderBy($Order, $sort)
                        ->offset(($this->page*$this->limit)-$this->limit)
                        ->limit($this->limit)->get();
                if($this->count<=10){
                    $this->page = 1;
                }
              
            }    
        }else{
            if($keyJoin == 0){
                $this->count = Workers::where($arrayWhere)->count();
                $qwery = Workers::where($arrayWhere)->offset(($this->page*$this->limit)-$this->limit)->limit($this->limit)->get();
                if($this->count<=10){
                    $this->page = 1;
                }
                
            }else{
                /*SELECT * FROM workers l1 JOIN workers l2 ON l1.id_worker = l2.id WHERE l2.surname = 'Логинов'*/
                $this->count = Workers::from('workers AS l1')
                        ->leftJoin('positions','l1.id_position','=','positions.id')
                        ->join('workers AS l2','l1.id_worker','=','l2.id')
                        ->where($arrayWhere)->count();
                $qwery = Workers::select(
                            'l1.id as id',
                            'l1.surname as surname',
                            'l1.name as name',
                            'l1.patronymic as patronymic',
                            'l1.date_receipt as date_receipt',
                            'l1.salary as salary',
                            'l1.id_position as id_position',
                            'l1.id_worker as id_worker',
                            'l1.created_at as created_at',
                            'l1.updated_at as updated_at'
                        )->from('workers AS l1')
                        ->leftJoin('positions','l1.id_position','=','positions.id')
                        ->join('workers AS l2','l1.id_worker','=','l2.id')
                        ->where($arrayWhere)->offset(($this->page*$this->limit)-$this->limit)
                        ->limit($this->limit)->get();
                if($this->count<=10){
                    $this->page = 1;
                }
               
                
            }    
        }
       
        return $qwery;        
    }
    
    public function getGlifkon($name)
    {
        if(!empty($this->$name)){
            if(strcasecmp ("ASC" , $this->$name) == 0)
            {
                return "glyphicon glyphicon-sort-by-attributes";
            }else{
                return "glyphicon glyphicon-sort-by-attributes-alt";
            }    
        }else{
            return "";
        }
    }
      
}
