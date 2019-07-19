<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PositionAjaxRepository;
use App\Positions;

class AjaxPositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)           
    {
        $modelSerch = new PositionAjaxRepository();
       
        if ($request->isMethod('post')) 
        {
            $params = $this->SetSerchPosition($request, $modelSerch);
            return response()->json(array('msg'=> $this->getViewIndex($params->SearchPosition()),'pg'=> $this->getViewIndexPagination($params), 200));
            //$params = $this->SetSerchPosition($request, $modelSerch);
            //return view('ajaxposition.index',['positions'=> $params->SearchPosition(), 'params'=>$params]);
        }
        
        return view('ajaxposition.index',['positions'=>$modelSerch->GetPositions(), 'params'=>$modelSerch ]);
    }
    
    public function indexModal(Request $request)           
    {
        $modelSerch = new PositionAjaxRepository();
       
        if ($request->isMethod('post')) 
        {
            $params = $this->SetSerchPosition($request, $modelSerch);
            return response()->json(array('msg'=> $this->getViewIndexModal($params->SearchPosition()),'pg'=> $this->getViewIndexPaginationModal($params), 200));
            //$params = $this->SetSerchPosition($request, $modelSerch);
            //return view('ajaxposition.index',['positions'=> $params->SearchPosition(), 'params'=>$params]);
        }
        
        return view('ajaxposition.index',['positions'=>$modelSerch->GetPositions(), 'params'=>$modelSerch ]);
    }
    
    public function indexNewWorker(Request $request)           
    {
        $modelSerch = new PositionAjaxRepository();
       
        if ($request->isMethod('post')) 
        {
            $params = $this->SetSerchPosition($request, $modelSerch);
            return response()->json(array('msg'=> $this->getViewIndexNewWorker($params->SearchPosition()),'pg'=> $this->getViewIndexPaginationNewWorker($params), 200));
        }
        
        return view('ajaxposition.index',['positions'=>$modelSerch->GetPositions(), 'params'=>$modelSerch ]);
    }
    
    public function Create(Request $request)
    {       
        if ($request->isMethod('post')) 
        {
            $position = new Positions();
            if(!empty($request->name_position))
            {
                $lenght = 100;
                if(strlen($request->name_position)<=$lenght){
                    $modelSerch = new PositionAjaxRepository();
                    $position->name_position = $request->name_position;
                    $position->description_position = $request->description_position;
                    $position->save();
                    return response()->json(array('msg'=> $this->getViewIndex($modelSerch->GetPositions()),'pg'=> $this->getViewIndexPagination($modelSerch), 200));
                }else{
                    return response()->json(array('msg'=> 'Ошибка - название должности должно быть не больше '.$lenght.' символов!!!', 0));
                }             
            }else{
                return response()->json(array('msg'=> 'Ошибка - заполните поле название должности!!!', 0));
            }
            /*
            $position->name_position = $request->name_position;
            $position->description_position = $request->description_position;
            $position->save();
             * 
             */
           
        }
    }
    public function Update(Request $request){

        if ($request->isMethod('post')) 
        {
            if(!empty($request->id))
            {
                $position = Positions::find($request->id);
                if($position->id == $request->id){
                    if(!empty($request->name_position))
                    {
                        $lenght = 100;
                        if(strlen($request->name_position)<=$lenght){
                            $position->name_position = $request->name_position;
                            $position->save();
                            return response()->json(array('msg'=> 'Данные должности были обновлены успешно', 200));
                        }else{
                            return response()->json(array('msg'=> 'Ошибка - название должности должно быть не больше '.$lenght.' символов!!!', 0));
                        }
                    }else{
                        if(!empty($request->description_position)){
                            $position->description_position = $request->description_position;
                            $position->save();
                            return response()->json(array('msg'=> 'Данные должности были обновлены успешно', 200));
                        }else{
                            $position->description_position = $request->description_position;
                            $position->save();
                            return response()->json(array('msg'=> 'Данные должности были обновлены успешно', 200));
                        }
                        return response()->json(array('msg'=> 'Ошибка - заполните поле название должности!!!', 0));
                    }
                }else{
                    return response()->json(array('msg'=> 'Ошибка на сервере что то пошло не так обновите страницу и повторите!!!', 0));
                }
            }else{
                return response()->json(array('msg'=> 'Ошибка на сервере что то пошло не так обновите страницу и повторите!!!', 0));
            }   
        }
    }
    
    public function destroy(Request $request)
    {
            if(!empty($request->id))
            {
                $position = Positions::find($request->id);
                if($position->id == $request->id){
                    $position->delete();
                    return response()->json(array('msg'=> 'Данные должности были удаленны успешно', 200));
                }else{
                    return response()->json(array('msg'=> 'Ошибка на сервере что то пошло не так обновите страницу и повторите!!! не нашли модель', 0));
                }
            }else{
                return response()->json(array('msg'=> 'Ошибка на сервере что то пошло не так обновите страницу и повторите!!! нет id', 0));
            }              
    }
    
    private function SetSerchPosition(Request $request, PositionAjaxRepository $positions){
        
        if(!empty($request->name_position))
        {
           $positions->name_position = $request->name_position; 
        }
        if(!empty($request->created_at)){
            $positions->created_at = $request->created_at;
        }
        if(!empty($request->updated_at)){
            $positions->updated_at = $request->updated_at;
        }
        if(!empty($request->order_position_name)){
            $positions->order_position_name = $request->order_position_name;
        }
        if(!empty($request->order_created_at)){
            $positions->order_created_at = $request->order_created_at;
        }
        if(!empty($request->order_updated_at)){
            $positions->order_updated_at = $request->order_updated_at;
        }
        
        if(!empty($request->page)){
            $positions->page = $request->page;
        }
        
        return $positions;        
    }
    
    
    public function getViewIndex($positions){
        $str = "";
        foreach ($positions as $position){
            $str =  $str."<tr class='position' id='position-".$position->id."'>"
                        ."<td id='position-name_position-".$position->id."' class='nameposition'>"
                            ."<span id='span-name_position-".$position->id."'>".$position->name_position."</span>"
                            ."<form id='my_form_ajax_update_name_position-".$position->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$position->name_position."' name='name_position' id='input-position-name_position-".$position->id."' class='form-control'>"
                                ."<input type='hidden' value='".$position->id."' name='id' id='input-position-id-".$position->id."' class='form-control'>"
                                ."<button id='update-".$position->id."' type='submit' class='btn btn-warning btn-xs update-btn' form='my_form'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                        ."</td>"
                        ."<td  id='position-description_position-".$position->id."' class='description_position'>"
                            ."<span id='span-description_position-".$position->id."'>".$position->description_position."</span>"
                            ."<form id='my_form_ajax_update_description_position-".$position->id."' style='display:none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<textarea type='text' name='description_position' id='input-position-description_position-".$position->id."' class='form-control'>".$position->description_position."</textarea>"
                                ."<input type='hidden' value='".$position->id."' name='id' id='input-position-id-".$position->id."' class='form-control'>"
                                ."<button id='update-".$position->id."' type='submit' class='btn btn-warning btn-xs update-btn-description_position'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                        ."</td>"
                        ."<td>".date("d.m.Y",strtotime($position->created_at))."</td>"
                        ."<td>".date("d.m.Y",strtotime($position->updated_at))."</td>"
                        ."<td>"                            
                            ."<form id='my_form_ajax_delete_position-".$position->id."'>"
                                .csrf_field()
                                .method_field('DELETE')
                                ."<input type='hidden' value='".$position->id."' name='id' id='input-position-id-".$position->id."' class='form-control'>"
                                ."<button id='delete-position-".$position->id."' type='submit' id='delete-position-".$position->id."' class='btn btn-danger btn-xs btn-position btn-delete'>"
                                ."Удалить"
                                ."</button>"
                            ."</form>"
                        ."</td>"
                    ."</tr>"
                    ."<tr>"
                        ."<td id='td-error-name_position-".$position->id."' colspan='5' style='display: none'>"
                            ."<ul class='list-group'>"    
                                ."<li id='li-error-name_position-".$position->id."' class='list-group-item list-group-item-danger' >Ошибка</li>"        
                            ."</ul>"
                        ."</td>"
                    ."</tr>"
                    ;
        }           
        return $str;
    }
    
    public function getViewIndexNewWorker($positions){
        $str = "";
        foreach ($positions as $position){
            $str =  $str."<tr class='position_new_worker' id='new-worker-position-".$position->id."'>"
                        ."<td id='position-name_position-".$position->id."' class='nameposition_new_worker'>"
                            ."<span id='new-worker-span-name_position-".$position->id."'>".$position->name_position."</span>"
                            ."<form id='new-worker-my_form_ajax_update_name_position-".$position->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$position->name_position."' name='name_position' id='new-worker-input-position-name_position-".$position->id."' class='form-control'>"
                                ."<input type='hidden' value='".$position->id."' name='id' id='new-worker-input-position-id-".$position->id."' class='form-control'>"
                                ."<button id='update-".$position->id."' type='submit' class='btn btn-warning btn-xs new-worker-update-btn-nameposition'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                        ."</td>"
                        ."<td  id='position-description_position-".$position->id."' class='description_position_new_worker'>"
                            ."<span id='new-worker-span-description_position-".$position->id."'>".$position->description_position."</span>"
                            ."<form id='new-worker-my_form_ajax_update_description_position-".$position->id."' style='display:none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<textarea type='text' name='description_position' id='new-worker-input-position-description_position-".$position->id."' class='form-control'>".$position->description_position."</textarea>"
                                ."<input type='hidden' value='".$position->id."' name='id' id='new-worker-input-position-id-".$position->id."' class='form-control'>"
                                ."<button id='update-".$position->id."' type='submit' class='btn btn-warning btn-xs new-worker-update-btn-description_position'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                        ."</td>"
                        ."<td id='new-worker-td-created_at-".$position->id."'>".date("d.m.Y",strtotime($position->created_at))."</td>"
                        ."<td id='new-worker-td-updated_at-".$position->id."'>".date("d.m.Y",strtotime($position->updated_at))."</td>"
                        ."<td>"
                            ."<button id='new-worker-position-button-".$position->id."' type='submit' id='delete-position-".$position->id."' class='btn btn-danger btn-xs btn-position-new-worker'>"
                            ."Выбрать"
                            ."</button>"                            
                        ."</td>"
                    ."</tr>"
                    ."<tr>"
                        ."<td id='new-worker-td-error-name_position-".$position->id."' colspan='5' style='display: none'>"
                            ."<ul class='list-group'>"    
                                ."<li id='new-worker-li-error-name_position-".$position->id."' class='list-group-item list-group-item-danger' >Ошибка</li>"        
                            ."</ul>"
                        ."</td>"
                    ."</tr>"
                    ;
        }           
        return $str;
    }
    
    public function getViewIndexModal($positions){
        $str = "";
        foreach ($positions as $position){
            $str =  $str."<tr class='position' id='position-".$position->id."'>"
                        ."<td id='position-name_position-".$position->id."' class='nameposition'>"
                            ."<span id='span-name_position-".$position->id."'>".$position->name_position."</span>"
                            ."<form id='my_form_ajax_update_name_position-".$position->id."' style='display: none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<input type='text' value='".$position->name_position."' name='name_position' id='input-position-name_position-".$position->id."' class='form-control'>"
                                ."<input type='hidden' value='".$position->id."' name='id' id='input-position-id-".$position->id."' class='form-control'>"
                                ."<button id='update-".$position->id."' type='submit' class='btn btn-warning btn-xs update-btn' form='my_form'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                        ."</td>"
                        ."<td  id='position-description_position-".$position->id."' class='description_position'>"
                            ."<span id='span-description_position-".$position->id."'>".$position->description_position."</span>"
                            ."<form id='my_form_ajax_update_description_position-".$position->id."' style='display:none;' class='form-horizontal'>"
                                .csrf_field()
                                ."<textarea type='text' name='description_position' id='input-position-description_position-".$position->id."' class='form-control'>".$position->description_position."</textarea>"
                                ."<input type='hidden' value='".$position->id."' name='id' id='input-position-id-".$position->id."' class='form-control'>"
                                ."<button id='update-".$position->id."' type='submit' class='btn btn-warning btn-xs update-btn-description_position'>"
                                    ."Обновить"
                                ."</button>"                  
                            ."</form>"
                        ."</td>"
                        ."<td>".date("d.m.Y",strtotime($position->created_at))."</td>"
                        ."<td>".date("d.m.Y",strtotime($position->updated_at))."</td>"
                        ."<td>"                            
                            ."<form id = 'change-position-".$position->id."'>"
                                .csrf_field()
                                ."<input id = 'worker_id-".$position->id."' type='hidden' value = '' name='worker_id'>"
                                ."<input id = 'position_id' type='hidden' value = '".$position->id."' name='position_id'>"
                                ."<button type='submit' id='change-position-button-".$position->id."' class='btn btn-danger btn-xs btn-position-change'>"
                                    ."Заменить"    
                                ."</button>"
                            ."</form>"
                        ."</td>"
                    ."</tr>"
                    ."<tr>"
                        ."<td id='td-error-name_position-".$position->id."' colspan='5' style='display: none'>"
                            ."<ul class='list-group'>"    
                                ."<li id='li-error-name_position-".$position->id."' class='list-group-item list-group-item-danger' >Ошибка</li>"        
                            ."</ul>"
                        ."</td>"
                    ."</tr>"
                    ;
        }           
        return $str;
    }
    
    public function getViewIndexPaginationModal($params){
        $str = '';
        $a = ceil($params->count/$params->limit);                
        if ($a>1){
            
            if ($params->page == 1){
                $str = $str."<li class='disabled'><span>«</span></li>"; 
            }else{
                $str = $str."<li><a  id ='".($params->page-1)."' class='my_position_page_ajax' rel='next'>«</a></li>"; 
            }
            
            for ($i = 1; $i <= $a; $i++){            
                if ($params->page == $i){
                    $str = $str."<li class='active'><span>".$i."</span></li>"; 
                }else{
                    if ($i >= $params->page-2  &&  $i <= $params->page+2){
                        $str = $str."<li><a  id ='".$i."' class='my_position_page_ajax' >".$i."</a></li>";  
                    }else{
                        if ($i == 1){
                            $str = $str."<li><a  id ='".$i."' class='my_position_page_ajax'>".$i."</a></li>";
                            $str = $str."<li class='disabled'><span>...</span></li>";
                        }
                        if ($i == $a){
                            $str = $str."<li class='disabled'><span>...</span></li>";
                            $str = $str."<li><a  id ='".$i."' class='my_position_page_ajax'>".$i."</a></li>";                
                        }  
                    }
                                
                }  
            }
            if ($params->page == $a){
                $str = $str."<li class='disabled'><span>»</span></li>"; 
            }else{
                $str = $str."<li><a  id ='".($params->page+1)."' class='my_position_page_ajax' rel='next'>»</a></li>"; 
            }

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
                $str = $str."<li><a  id ='".($params->page-1)."' class='my_page_ajax' rel='next'>«</a></li>"; 
            }
            
            for ($i = 1; $i <= $a; $i++){            
                if ($params->page == $i){
                    $str = $str."<li class='active'><span>".$i."</span></li>"; 
                }else{
                    if ($i >= $params->page-2  &&  $i <= $params->page+2){
                        $str = $str."<li><a  id ='".$i."' class='my_page_ajax' >".$i."</a></li>";  
                    }else{
                        if ($i == 1){
                            $str = $str."<li><a  id ='".$i."' class='my_page_ajax'>".$i."</a></li>";
                            $str = $str."<li class='disabled'><span>...</span></li>";
                        }
                        if ($i == $a){
                            $str = $str."<li class='disabled'><span>...</span></li>";
                            $str = $str."<li><a  id ='".$i."' class='my_page_ajax'>".$i."</a></li>";                
                        }  
                    }
                                
                }  
            }
            if ($params->page == $a){
                $str = $str."<li class='disabled'><span>»</span></li>"; 
            }else{
                $str = $str."<li><a  id ='".($params->page+1)."' class='my_page_ajax' rel='next'>»</a></li>"; 
            }

        }
        return $str;
    }
    
    public function getViewIndexPaginationNewWorker($params){
        $str = '';
        $a = ceil($params->count/$params->limit);                
        if ($a>1){
            
            if ($params->page == 1){
                $str = $str."<li class='disabled'><span>«</span></li>"; 
            }else{
                $str = $str."<li><a  id ='".($params->page-1)."' class='my_position_page_ajax_new_worker' rel='next'>«</a></li>"; 
            }
            
            for ($i = 1; $i <= $a; $i++){            
                if ($params->page == $i){
                    $str = $str."<li class='active'><span>".$i."</span></li>"; 
                }else{
                    if ($i >= $params->page-2  &&  $i <= $params->page+2){
                        $str = $str."<li><a  id ='".$i."' class='my_position_page_ajax_new_worker' >".$i."</a></li>";  
                    }else{
                        if ($i == 1){
                            $str = $str."<li><a  id ='".$i."' class='my_position_page_ajax_new_worker'>".$i."</a></li>";
                            $str = $str."<li class='disabled'><span>...</span></li>";
                        }
                        if ($i == $a){
                            $str = $str."<li class='disabled'><span>...</span></li>";
                            $str = $str."<li><a  id ='".$i."' class='my_position_page_ajax_new_worker'>".$i."</a></li>";                
                        }  
                    }
                                
                }  
            }
            if ($params->page == $a){
                $str = $str."<li class='disabled'><span>»</span></li>"; 
            }else{
                $str = $str."<li><a  id ='".($params->page+1)."' class='my_position_page_ajax_new_worker' rel='next'>»</a></li>"; 
            }

        }
        return $str;
    }
    
}
