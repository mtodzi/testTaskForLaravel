<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AjaxWorkersRepository;
use App\Repositories\PositionAjaxRepository;
use Illuminate\Support\Facades\Storage;
use App\Workers;
use App\Positions;

class AjaxWorkersController extends Controller
{
   public function __construct()
   {
        $this->middleware('auth');
   }
   
   public function index(Request $request)           
    {
       $modelSerch = new AjaxWorkersRepository();
       $modelSerchPosition = new PositionAjaxRepository();
       if ($request->isMethod('post')) 
       {
           $params = $this->SetSerchWorkers($request, $modelSerch);
           return response()->json(array('msg'=> $this->getViewIndex($params->SearchPosition()),'pg'=> $this->getViewIndexPagination($params), 200));
       }       
       return view('ajaxworkers.index',[
           'workers'=>$modelSerch->GetWorkers(), 
           'params'=>$modelSerch,
           'positions'=>$modelSerchPosition->GetPositions(),
           'params_position'=>$modelSerchPosition
               ]);
       
    }
    
    public function indexNewWorker(Request $request)           
    {
       $modelSerch = new AjaxWorkersRepository();
       $modelSerchPosition = new PositionAjaxRepository();
       if ($request->isMethod('post')) 
       {
           $params = $this->SetSerchWorkers($request, $modelSerch);
           return response()->json(array('msg'=> $this->getViewIndexNewWorker($params->SearchPosition()),'pg'=> $this->getViewIndexPaginationNewWorker($params), 200));
       }       
       return view('ajaxworkers.index',[
           'workers'=>$modelSerch->GetWorkers(), 
           'params'=>$modelSerch,
           'positions'=>$modelSerchPosition->GetPositions(),
           'params_position'=>$modelSerchPosition
               ]);
       
    }
    
    public function Create(Request $request){
        if ($request->isMethod('post')) 
        {
            $worker = new Workers();
            if(!empty($request->surname)){
                $lenght = 100;
                if(strlen($request->surname)>=$lenght){
                    return response()->json(array('msg'=> "Ошибка - Фамилия должна быть не больше ".$lenght." символов!!!",'step'=>1, 0));
                }
            }else{
                return response()->json(array('msg'=> 'Ошибка - заполните поле Фамилия!!!','step'=>1, 0));
            }
            if(!empty($request->name)){
                $lenght = 100;
                if(strlen($request->name)>=$lenght){
                    return response()->json(array('msg'=> "Ошибка - Имени должна быть не больше ".$lenght." символов!!!",'step'=>1, 0));
                }
            }else{
                return response()->json(array('msg'=> 'Ошибка - заполните поле Имени!!!','step'=>1, 0));
            }
            if(!empty($request->patronymic)){
                $lenght = 100;
                if(strlen($request->patronymic)>=$lenght){
                    return response()->json(array('msg'=> "Ошибка - Фамилия должна быть не больше ".$lenght." символов!!!",'step'=>1, 0));
                }
            }else{
                return response()->json(array('msg'=> 'Ошибка - заполните поле Фамилии!!!','step'=>1, 0));
            }
            if(!empty($request->salary)){
                if(!is_numeric($request->salary)){
                    return response()->json(array('msg'=> "Ошибка - Зарплата должна быть числом!!!",'step'=>1, 0));
                }
            }else{
                return response()->json(array('msg'=> 'Ошибка - заполните поле Зарплата!!!','step'=>1, 0));
            }
            if(empty($request->date_receipt)){
                return response()->json(array('msg'=> 'Ошибка - заполните поле приняли на работу!!!','step'=>1, 0));
            }
            $worker->surname = $request->surname;
            $worker->name = $request->name;
            $worker->patronymic = $request->patronymic;
            $worker->salary = $request->salary;
            $worker->date_receipt = date("Y-m-d",strtotime($request->date_receipt));
            if($request->id_position != 0){                
                $position = Positions::find($request->id_position);
                if($worker !== NULL){
                    $worker->id_position = $request->id_position;
                }else{
                    return response()->json(array('msg'=> 'Ошибка - По какой-то причине не была найдена выбранная должность!!!','step'=>2, 0));
                }
            }else{
                $worker->id_position = NULL;
            }
            if($request->id_worker != 0){                
                $worker_id = Workers::find($request->id_worker);
                if($worker_id !== NULL){
                    $worker->id_worker = $request->id_worker;
                }else{
                    return response()->json(array('msg'=> 'Ошибка - По какой-то причине не был найден выбранный начальник!!!','step'=>3, 0));
                }
            }else{
                $worker->id_worker = NULL;        
            }
            $result = $worker->save();
            if($result){
                return response()->json(array('msg'=> $this->getViewIndexNewWorkerOne($worker), 200));    
            }else{
                return response()->json(array('msg'=> 'Ошибка на сервере что то пошло не так обновите страницу и повторите!!!','step'=>0, 0));
            }            
        }else{
            return response()->json(array('msg'=> 'Ошибка на сервере что то пошло не так обновите страницу и повторите!!!','step'=>0, 0));
        }
    }
    
    public function Update(Request $request){

        if ($request->isMethod('post')) 
        {
            if(!empty($request->id))
            {
                $worker = Workers::find($request->id);
                if($worker !== NULL){
                    $name = $this->getRequestName($request);
                    switch ($name){
                        case 'surname':
                            if(!empty($request->surname)){
                                $lenght = 100;
                                if(strlen($request->surname)<=$lenght){
                                    $worker->surname = $request->surname;
                                    $worker->save();
                                    return response()->json(array('msg'=> 'Данные Фамилии были обновлены успешно', 200));
                                }else{
                                    return response()->json(array('msg'=> "Ошибка - Фамилия должна быть не больше ".$lenght." символов!!!", 0));
                                }
                            }else{
                                return response()->json(array('msg'=> 'Ошибка - заполните поле Фамилия!!!', 0));
                            }
                            break;
                        case 'name':
                            if(!empty($request->name)){
                                $lenght = 100;
                                if(strlen($request->name)<=$lenght){
                                    $worker->name = $request->name;
                                    $worker->save();
                                    return response()->json(array('msg'=> 'Данные Имени были обновлены успешно', 200));
                                }else{
                                    return response()->json(array('msg'=> "Ошибка - Имени должна быть не больше ".$lenght." символов!!!", 0));
                                }
                            }else{
                                return response()->json(array('msg'=> 'Ошибка - заполните поле Имени!!!', 0));
                            }
                            break;
                        case 'patronymic':
                            if(!empty($request->patronymic)){
                                $lenght = 100;
                                if(strlen($request->patronymic)<=$lenght){
                                    $worker->patronymic = $request->patronymic;
                                    $worker->save();
                                    return response()->json(array('msg'=> 'Данные Фамилии были обновлены успешно', 200));
                                }else{
                                    return response()->json(array('msg'=> "Ошибка - Фамилия должна быть не больше ".$lenght." символов!!!", 0));
                                }
                            }else{
                                return response()->json(array('msg'=> 'Ошибка - заполните поле Фамилии!!!', 0));
                            }
                            break;
                        case 'salary':
                            if(!empty($request->salary)){
                                if(is_numeric($request->salary)){
                                    $worker->salary = $request->salary;
                                    $worker->save();
                                    return response()->json(array('msg'=> 'Данные Зарплаты были обновлены успешно', 200));
                                }else{
                                    return response()->json(array('msg'=> "Ошибка - Зарплата должна быть числом!!!", 0));
                                }
                            }else{
                                return response()->json(array('msg'=> 'Ошибка - заполните поле Зарплата!!!', 0));
                            }
                            break;
                        case 'date_receipt':
                            if(!empty($request->date_receipt)){
                                    $worker->date_receipt = date("Y-m-d",strtotime($request->date_receipt));
                                    $worker->save();
                                    return response()->json(array('msg'=> 'Данные поля приняли на работу были обновлены успешно', 200));
                            }else{
                                return response()->json(array('msg'=> 'Ошибка - заполните поле приняли на работу!!!', 0));
                            }
                            break;    
                    }
                }else{
                    return response()->json(array('msg'=> 'Ошибка на сервере что то пошло не так обновите страницу и повторите!!!', 0));
                }            
            }else{
                return response()->json(array('msg'=> 'Ошибка на сервере что то пошло не так обновите страницу и повторите!!!', 0));
            }
        }
    }
    
    private function getRequestName(Request $request){
            if(!empty($request->surname))
            {
                $name = 'surname'; 
            }
            if(!empty($request->name))
            {
                $name = 'name'; 
            }
            if(!empty($request->patronymic))
            {
                $name = 'patronymic'; 
            }
            if(!empty($request->salary))
            {
                $name = 'salary'; 
            }
            if(!empty($request->date_receipt))
            {
                $name = 'date_receipt'; 
            }
            return $name;
        } 

    private function SetSerchWorkers(Request $request, AjaxWorkersRepository $workers){
        
        if(!empty($request->surname))
        {
           $workers->surname = $request->surname; 
        }
        if(!empty($request->name))
        {
           $workers->name = $request->name; 
        }
        if(!empty($request->patronymic))
        {
           $workers->patronymic = $request->patronymic; 
        }
        if(!empty($request->salary))
        {
           $workers->salary = $request->salary; 
        }
        if(!empty($request->date_receipt))
        {
           $workers->date_receipt = $request->date_receipt; 
        }
        if(!empty($request->name_position))
        {
           $workers->name_position = $request->name_position; 
        }
        if(!empty($request->chief))
        {
           $workers->chief = $request->chief; 
        }
        if(!empty($request->created_at)){
            $workers->created_at = $request->created_at;
        }
        if(!empty($request->updated_at)){
            $workers->updated_at = $request->updated_at;
        }
        if(!empty($request->order_surname)){
            $workers->order_surname = $request->order_surname;
        }
        if(!empty($request->order_name)){
            $workers->order_name = $request->order_name;
        }
        if(!empty($request->order_patronymic)){
            $workers->order_patronymic = $request->order_patronymic;
        }
        if(!empty($request->order_salary)){
            $workers->order_salary = $request->order_salary;
        }
        
        if(!empty($request->order_date_receipt)){
            $workers->order_date_receipt = $request->order_date_receipt;
        }
        if(!empty($request->order_name_position)){
            $workers->order_name_position = $request->order_name_position;
        }
        if(!empty($request->order_chief)){
            $workers->order_chief = $request->order_chief;
        }
        if(!empty($request->order_created_at)){
            $workers->order_created_at = $request->order_created_at;
        }
        if(!empty($request->order_updated_at)){
            $workers->order_updated_at = $request->order_updated_at;
        }
        if(!empty($request->page)){
            $workers->page = $request->page;
        }
        
        return $workers;        
    }
    
    public function getViewIndex($workers){
        $str = "";
        foreach ($workers as $worker){
            $str = $str.
                "<tr class='worker' id='worker-".$worker->id."'>"
                    ."<td id='worker-photo-".$worker->id."' class='worker_photo'>"
                        ."<img id='img-".$worker->id."' src='".$worker->getUrlFoto()."'  width='30' height='30'>"
                            ."<div class='modal fade' id='myModal-".$worker->id."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>"
                                ."<div class='modal-dialog'>"
                                    ."<div class='modal-content'>"
                                        ."<div class='modal-header'>"
                                            ."<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>"
                                            ."<h4 class='modal-title' id='myModalLabel'>Фото работника ".$worker->surname." ".$worker->name."</h4>"
                                        ."</div>"
                                        ."<div class='modal-body'>"
                                            ."<form enctype='multipart/form-data'>"
                                                .csrf_field()
                                                ."<img id='img_photo-".$worker->id."' src='".$worker->getUrlFoto()."' style='display: none; width: 100px; height: 100px;'>"
                                                ."<div class='file-loading'>"
                                                    ."<input id='file-fr-".$worker->id."' name='file' type='file' multiple>"
                                                ."</div>"
                                            ."</form>"
                                        ."</div>"
                                        ."<div class='modal-footer'>"
                                            ."<button type='button' class='btn btn-default close-modal' data-dismiss='modal'>Закрыть</button>"
                                        ."</div>"
                                    ."</div>"
                                ."</div>"
                            ."</div>"
                    ."</td>"
                    ."<td id='worker-surname-".$worker->id."' class='worker_surname'>"
                        ."<span id='span-surname-".$worker->id."'>".$worker->surname."</span>"
                            ."<form id='my_form_ajax_worker_update_surname-".$worker->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$worker->surname."' name='surname' id='input-worker-surname-".$worker->id."' class='form-control'>"
                                ."<input type='hidden' value='".$worker->id."' name='id' id='input-worker-id-".$worker->id."' class='form-control'>"
                                ."<button id='update-worker-surname-".$worker->id."' type='submit' class='btn btn-warning btn-xs update-worker-surname-btn'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                    ."</td>"
                    ."<td id='worker-name-".$worker->id."' class='worker_name'>"
                        ."<span id='span-name-".$worker->id."'>".$worker->name."</span>"
                            ."<form id='my_form_ajax_worker_update_name-".$worker->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$worker->name."' name='name' id='input-worker-name-".$worker->id."' class='form-control'>"
                                ."<input type='hidden' value='".$worker->id."' name='id' id='input-worker-id-".$worker->id."' class='form-control'>"
                                ."<button id='update-worker-name-".$worker->id."' type='submit' class='btn btn-warning btn-xs update-worker-name-btn'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                    ."</td>"
                    ."<td id='worker-patronymic-".$worker->id."' class='worker_patronymic'>"
                        ."<span id='span-patronymic-".$worker->id."'>".$worker->patronymic."</span>"
                            ."<form id='my_form_ajax_worker_update_patronymic-".$worker->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$worker->patronymic."' name='patronymic' id='input-worker-patronymic-".$worker->id."' class='form-control'>"
                                ."<input type='hidden' value='".$worker->id."' name='id' id='input-worker-id-".$worker->id."' class='form-control'>"
                                ."<button id='update-worker-patronymic-".$worker->id."' type='submit' class='btn btn-warning btn-xs update-worker-patronymic-btn'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                    ."</td>"
                    ."<td id='worker-salary-".$worker->id."' class='worker_salary'>"
                        ."<span id='span-salary-".$worker->id."'>".$worker->salary."</span>"
                            ."<form id='my_form_ajax_worker_update_salary-".$worker->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$worker->salary."' name='salary' id='input-worker-salary-".$worker->id."' class='form-control'>"
                                ."<input type='hidden' value='".$worker->id."' name='id' id='input-worker-id-".$worker->id."' class='form-control'>"
                                ."<button id='update-worker-salary-".$worker->id."' type='submit' class='btn btn-warning btn-xs update-worker-salary-btn'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                    ."</td>"
                    ."<td id='worker-date_receipt-".$worker->id."' class='worker_date_receipt'>"
                        ."<span id='span-date_receipt-".$worker->id."'>".date("d.m.Y",strtotime($worker->date_receipt))."</span>"
                            ."<form id='my_form_ajax_worker_update_date_receipt-".$worker->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".date("d.m.Y",strtotime($worker->date_receipt))."' name='date_receipt' id='input-worker-date_receipt-".$worker->id."' class='form-control date'>"
                                ."<input type='hidden' value='".$worker->id."' name='id' id='input-worker-id-".$worker->id."' class='form-control'>"
                                ."<button id='update-worker-date_receipt-".$worker->id."' type='submit' class='btn btn-warning btn-xs update-worker-date_receipt-btn'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                    ."</td>"
                    ."<td id='worker-position-".$worker->id."' class='worker_position'>";
                    if(empty($worker->id_position)){
                        $str = $str.'нет';
                    }else{
                        $str = $str.$worker->position->name_position;
                    }    
                    $str = $str."</td>";
                    $str = $str."<td>";
                    if($worker->id_worker === NULL){
                        $str = $str.'не задан';    
                    }else{
                        $str = $str.$worker->worker->surname;
                    }
                    $str = $str."</td>"
                    ."<td>".date("d.m.Y",strtotime($worker->created_at))."</td>"
                    ."<td>".date("d.m.Y",strtotime($worker->updated_at))."</td>"
                    ."<td>"
                            ."<button type='submit' id='delete-position-".$worker->id."' class='btn btn-danger btn-xs btn-position'>"
                                ."Удалить"
                            ."</button>"
                    ."</td>"
                ."</tr>"
                ."<tr>"
                    ."<td id='td-error-worker-".$worker->id."' colspan='11' style='display: none'>"
                        ."<ul class='list-group'>"    
                            ."<li id='li-error-worker-".$worker->id."' class='list-group-item list-group-item-danger'>Ошибка</li>"        
                        ."</ul>"
                    ."</td>"
                ."</tr>";
        }
        return $str; 
    }
    
    public function getViewIndexNewWorkerOne($worker){
        $str = "";
            $str = $str.
                "<tr class='worker' id='worker-".$worker->id."' style='background:#fc0;'>"
                    ."<td id='worker-photo-".$worker->id."' class='worker_photo'>"
                        ."<img id='img-".$worker->id."' src='".$worker->getUrlFoto()."'  width='30' height='30'>"
                            ."<div class='modal fade' id='myModal-".$worker->id."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>"
                                ."<div class='modal-dialog'>"
                                    ."<div class='modal-content'>"
                                        ."<div class='modal-header'>"
                                            ."<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>"
                                            ."<h4 class='modal-title' id='myModalLabel'>Фото работника ".$worker->surname." ".$worker->name."</h4>"
                                        ."</div>"
                                        ."<div class='modal-body'>"
                                            ."<form enctype='multipart/form-data'>"
                                                .csrf_field()
                                                ."<img id='img_photo-".$worker->id."' src='".$worker->getUrlFoto()."' style='display: none; width: 100px; height: 100px;'>"
                                                ."<div class='file-loading'>"
                                                    ."<input id='file-fr-".$worker->id."' name='file' type='file' multiple>"
                                                ."</div>"
                                            ."</form>"
                                        ."</div>"
                                        ."<div class='modal-footer'>"
                                            ."<button type='button' class='btn btn-default close-modal' data-dismiss='modal'>Закрыть</button>"
                                        ."</div>"
                                    ."</div>"
                                ."</div>"
                            ."</div>"
                    ."</td>"
                    ."<td id='worker-surname-".$worker->id."' class='worker_surname'>"
                        ."<span id='span-surname-".$worker->id."'>".$worker->surname."</span>"
                            ."<form id='my_form_ajax_worker_update_surname-".$worker->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$worker->surname."' name='surname' id='input-worker-surname-".$worker->id."' class='form-control'>"
                                ."<input type='hidden' value='".$worker->id."' name='id' id='input-worker-id-".$worker->id."' class='form-control'>"
                                ."<button id='update-worker-surname-".$worker->id."' type='submit' class='btn btn-warning btn-xs update-worker-surname-btn'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                    ."</td>"
                    ."<td id='worker-name-".$worker->id."' class='worker_name'>"
                        ."<span id='span-name-".$worker->id."'>".$worker->name."</span>"
                            ."<form id='my_form_ajax_worker_update_name-".$worker->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$worker->name."' name='name' id='input-worker-name-".$worker->id."' class='form-control'>"
                                ."<input type='hidden' value='".$worker->id."' name='id' id='input-worker-id-".$worker->id."' class='form-control'>"
                                ."<button id='update-worker-name-".$worker->id."' type='submit' class='btn btn-warning btn-xs update-worker-name-btn'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                    ."</td>"
                    ."<td id='worker-patronymic-".$worker->id."' class='worker_patronymic'>"
                        ."<span id='span-patronymic-".$worker->id."'>".$worker->patronymic."</span>"
                            ."<form id='my_form_ajax_worker_update_patronymic-".$worker->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$worker->patronymic."' name='patronymic' id='input-worker-patronymic-".$worker->id."' class='form-control'>"
                                ."<input type='hidden' value='".$worker->id."' name='id' id='input-worker-id-".$worker->id."' class='form-control'>"
                                ."<button id='update-worker-patronymic-".$worker->id."' type='submit' class='btn btn-warning btn-xs update-worker-patronymic-btn'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                    ."</td>"
                    ."<td id='worker-salary-".$worker->id."' class='worker_salary'>"
                        ."<span id='span-salary-".$worker->id."'>".$worker->salary."</span>"
                            ."<form id='my_form_ajax_worker_update_salary-".$worker->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$worker->salary."' name='salary' id='input-worker-salary-".$worker->id."' class='form-control'>"
                                ."<input type='hidden' value='".$worker->id."' name='id' id='input-worker-id-".$worker->id."' class='form-control'>"
                                ."<button id='update-worker-salary-".$worker->id."' type='submit' class='btn btn-warning btn-xs update-worker-salary-btn'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                    ."</td>"
                    ."<td id='worker-date_receipt-".$worker->id."' class='worker_date_receipt'>"
                        ."<span id='span-date_receipt-".$worker->id."'>".date("d.m.Y",strtotime($worker->date_receipt))."</span>"
                            ."<form id='my_form_ajax_worker_update_date_receipt-".$worker->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".date("d.m.Y",strtotime($worker->date_receipt))."' name='date_receipt' id='input-worker-date_receipt-".$worker->id."' class='form-control date'>"
                                ."<input type='hidden' value='".$worker->id."' name='id' id='input-worker-id-".$worker->id."' class='form-control'>"
                                ."<button id='update-worker-date_receipt-".$worker->id."' type='submit' class='btn btn-warning btn-xs update-worker-date_receipt-btn'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                    ."</td>"
                    ."<td id='worker-position-".$worker->id."' class='worker_position'>";
                    if(empty($worker->id_position)){
                        $str = $str.'нет';
                    }else{
                        $str = $str.$worker->position->name_position;
                    }    
                    $str = $str."</td>";
                    $str = $str."<td>";
                    if($worker->id_worker === NULL){
                        $str = $str.'не задан';    
                    }else{
                        $str = $str.$worker->worker->surname;
                    }
                    $str = $str."</td>"
                    ."<td>".date("d.m.Y",strtotime($worker->created_at))."</td>"
                    ."<td>".date("d.m.Y",strtotime($worker->updated_at))."</td>"
                    ."<td>"
                            ."<button type='submit' id='delete-position-".$worker->id."' class='btn btn-danger btn-xs btn-position'>"
                                ."Удалить"
                            ."</button>"
                    ."</td>"
                ."</tr>"
                ."<tr>"
                    ."<td id='td-error-worker-".$worker->id."' colspan='11' style='display: none'>"
                        ."<ul class='list-group'>"    
                            ."<li id='li-error-worker-".$worker->id."' class='list-group-item list-group-item-danger'>Ошибка</li>"        
                        ."</ul>"
                    ."</td>"
                ."</tr>";
        return $str; 
    }
    
    public function getViewIndexNewWorker($workers){
        $str = "";
        foreach ($workers as $worker){
            $str = $str.
            "<tr class='new_worker_worker' id='new_worker_worker-'".$worker->id."'>".
                "<td id='new_worker_worker-surname-".$worker->id."' class='worker_surname'>".                    
                    "<span id='new_worker_span-surname-".$worker->id."'>".$worker->surname."</span>".       
                "</td>".
                "<td id='new_worker_worker-name-".$worker->id."' class='worker_name'>".
                    "<span id='new_worker_span-name-".$worker->id."'>".$worker->name."</span>".                                                
                "</td>".
                "<td id='new_worker_worker-patronymic-".$worker->id."' class='worker_patronymic'>".
                    "<span id='new_worker_span-patronymic-".$worker->id."'>".$worker->patronymic."</span>".                                                
                "</td>".
                "<td id='new_worker_worker-position-".$worker->id."' class='new_worker_worker_position'>";
                if(empty($worker->id_position)){
                    $str = $str.'нет';
                }else{
                    $str = $str.$worker->position->name_position;
                }    
                $str = $str."</td>";
                $str = $str."<td id='new_worker_worker-workers-".$worker->id."'>";
                if($worker->id_worker === NULL){
                    $str = $str.'не задан';    
                }else{
                    $str = $str.$worker->worker->surname;
                }
                $str = $str."</td>".
                "<td>".        
                "<button type='submit' id='new_worker_choose_workers-".$worker->id."' class='btn btn-danger btn-xs btn-new-worker-workers'>".
                    "Выбрать".
                "</button>".
                "</td>".
                "</tr>";
                
        }
        return $str;
    }
    
    
    public function getViewIndexPagination($params){
        $str = '';
        $a = ceil($params->count/$params->limit);                
        if ($a>1){
            
            if ($params->page == 1){
                $str = $str."<li class='disabled'><span>«</span></li>"; 
            }else{
                $str = $str."<li><a  id ='".($params->page-1)."' class='my_page_ajax_workers' rel='next'>«</a></li>"; 
            }
            
            for ($i = 1; $i <= $a; $i++){            
                if ($params->page == $i){
                    $str = $str."<li class='active'><span>".$i."</span></li>"; 
                }else{
                    if(($i >= ($params->page-2))  &&  ($i <= ($params->page+2))){
                        $str = $str."<li><a  id ='".$i."' class='my_page_ajax_workers' >".$i."</a></li>";  
                    }else{
                        if ($i == 1){
                            $str = $str."<li><a  id ='".$i."' class='my_page_ajax_workers'>".$i."</a></li>";
                            $str = $str."<li class='disabled'><span>...</span></li>";
                        }
                        if ($i == $a){
                            $str = $str."<li class='disabled'><span>...</span></li>";
                            $str = $str."<li><a  id ='".$i."' class='my_page_ajax_workers'>".$i."</a></li>";                
                        }
                    }  
                }     
            }
            if ($params->page == $a){
                $str = $str."<li class='disabled'><span>»</span></li>"; 
            }else{
                $str = $str."<li><a  id ='".($params->page+1)."' class='my_page_ajax_workers' rel='next'>»</a></li>"; 
            }
        
        return $str;
    }
    
}
    
    public function getViewIndexPaginationNewWorker($params){
        $str = '';
        $a = ceil($params->count/$params->limit);                
        if ($a>1){
            
            if ($params->page == 1){
                $str = $str."<li class='disabled'><span>«</span></li>"; 
            }else{
                $str = $str."<li><a  id ='".($params->page-1)."' class='new_worker_my_page_ajax_workers' rel='next'>«</a></li>"; 
            }
            
            for ($i = 1; $i <= $a; $i++){            
                if ($params->page == $i){
                    $str = $str."<li class='active'><span>".$i."</span></li>"; 
                }else{
                    if(($i >= ($params->page-2))  &&  ($i <= ($params->page+2))){
                        $str = $str."<li><a  id ='".$i."' class='new_worker_my_page_ajax_workers' >".$i."</a></li>";  
                    }else{
                        if ($i == 1){
                            $str = $str."<li><a  id ='".$i."' class='new_worker_my_page_ajax_workers'>".$i."</a></li>";
                            $str = $str."<li class='disabled'><span>...</span></li>";
                        }
                        if ($i == $a){
                            $str = $str."<li class='disabled'><span>...</span></li>";
                            $str = $str."<li><a  id ='".$i."' class='new_worker_my_page_ajax_workers'>".$i."</a></li>";                
                        }
                    }  
                }     
            }
            if ($params->page == $a){
                $str = $str."<li class='disabled'><span>»</span></li>"; 
            }else{
                $str = $str."<li><a  id ='".($params->page+1)."' class='new_worker_my_page_ajax_workers' rel='next'>»</a></li>"; 
            }
        
        return $str;
    }
    
}

    public function updatePhoto(Request $request){
        
        if ($request->isMethod('post')) 
        {  
            if(!empty($request->id)){
                $worker = Workers::find($request->id);
                if($worker !== NULL){
                    $file = $request->file('file');
                    $f = Storage::disk('local');
                    $exists = $f->files('public/foto/'.$worker->id);
                    if(!empty($exists)){
                        $exists =  explode("/", $exists[0]);
                        $f->delete("public/foto/".$worker->id."/".$exists[3]);
                        $f->makeDirectory('public/foto/'.$worker->id);
                        $f->putFile('public/foto/'.$worker->id.'/', $file);
                        return response()->json(array(
                                                    'initialPreview'=>"<img class='file-preview-image' id='img_photo_preview-".$worker->id."' src='".$worker->getUrlFoto()."'  style=' width: 200px; height: 200px;'>",
                                                    'initialPreviewConfig' => array(
                                                                                array('caption'=>$file->getClientOriginalName(),
                                                                                    'url'=>'/ajaxdeleteworkerphoto',
                                                                                    'key'=>100,
                                                                                    'extra'=>array(
                                                                                        'id'=>$worker->id,
                                                                                        '_token'=>$request->_token
                                                                                    )
                                                                                )    
                                                        ),
                                                    'append' => FALSE,
                                                    ));
                    }else{
                        $f->makeDirectory('public/foto/'.$worker->id);
                        $f->putFile('public/foto/'.$worker->id.'/', $file);
                        return response()->json(array(
                                                    'initialPreview'=>"<img class='file-preview-image' id='img_photo_preview-".$worker->id."' src='".$worker->getUrlFoto()."'  style=' width: 200px; height: 200px;'>",
                                                    'initialPreviewConfig' => array(
                                                                                array('caption'=>$file->getClientOriginalName(),
                                                                                      'url'=>'/ajaxdeleteworkerphoto',
                                                                                      'key'=>100,
                                                                                      'extra'=>array(
                                                                                        'id'=>$worker->id,
                                                                                        '_token'=>$request->_token
                                                                                        )
                                                                                    )
                                                    ),
                                                    'append' => FALSE,
                                                    ));
                    }
                }else{
                    return response()->json(array('error'=> 'По какой-то причине не найден пользователь которому меняют фото'));
                }
            }
        }else{
            return response()->json(array('error'=> 'По какой-то причине ваш запрос не POST обратитесь к админу'));
        }
        
    }
    
    public function deletePhoto(Request $request){
        if ($request->isMethod('post')) 
        {
            if(!empty($request->id)){
                $worker = Workers::find($request->id);
                if($worker !== NULL){
                    $f = Storage::disk('local');
                    $exists = $f->files('public/foto/'.$worker->id);
                    if(!empty($exists)){
                        $exists =  explode("/", $exists[0]);
                        $f->delete("public/foto/".$worker->id."/".$exists[3]);       
                        return response()->json(array('append' => FALSE,));
                    }else{
                        return response()->json(array('error'=> 'По какой-то причине не найден файл который необходимо удалить'));
                    }
                }else{
                    return response()->json(array('error'=> 'По какой-то причине не найден пользователь которому удаляют фото'));
                }
            }else{
                return response()->json(array('error'=> 'По какой-то причине не был передан идентификатор записи'));
            }
        }else{
            return response()->json(array('error'=> 'По какой-то причине ваш запрос не POST обратитесь к админу'));
        }
    }

    public function updatePosition(Request $request){
        if ($request->isMethod('post')) 
        {
            if(!empty($request->worker_id) && !empty($request->position_id)){
                $worker = Workers::find($request->worker_id);
                $position = Positions::find($request->position_id);
                if($worker !== NULL && $position !== NULL){
                    $worker->id_position = $position->id;
                    $worker->save();
                    return response()->json(array('msg'=> 'Данные о должности были обновлены успешно','position'=>$position->name_position, 200));
                }else{
                    return response()->json(array('msg'=> 'По какой-то причине не найден пользователь которому меняют должность', 0));
                }                
            }else{
                return response()->json(array('msg'=> 'По какой-то причине не найден пользователь которому меняют должность', 0));
            }
        }else{
            return response()->json(array('msg'=> 'По какой-то причине ваш запрос не POST обратитесь к админу', 0));
        }
    }
}