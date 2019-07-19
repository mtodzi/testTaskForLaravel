
<?php
   
?>
@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Работники</h4>            
                </div>
                
                <div class="panel-body">
                <ul class='list-group' id='ul-error' style="display: none;">    
                    <li id='li-error' class='list-group-item list-group-item-success'>Ошибка</li>        
                </ul>     
                <div class="row">
                    <div class="col-md-8" style="padding-bottom: 5px;">
                        <a class="btn btn-success" id = 'newworker'>Добавить</a>    
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">    
                        <div class="panel panel-default" id="new_worker" style="display: none;">
                            <div class="panel-heading"><h4>Добавить работника</h4></div>
                            <div class="panel-body">
                                <ul class='list-group' id='ul-error-new-worker' style="display: none;">    
                                    <li id='li-error-new-worker' class='list-group-item list-group-item-danger'>Ошибка</li>        
                                </ul>
                                <form id="my_form_new_worker" action="{{ url('#') }}" method="POST" class="form-horizontal">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="step" id="step" value="1" class="form-control">
                                    <input type="hidden" name="id_position" id="worker-id_position-ajax" value="0" class="form-control">
                                    <input type="hidden" name="id_worker" id="worker-id_worker-ajax" value="0" class="form-control">
                                </form>
                                <div id = "step1">
                                <div class="form-group">
                                    <div class="row">
                                    <label for="worker" class="col-sm-3 control-label">Фамилия</label>
                                    <div class="col-sm-6" id="div-worker-surname-ajax">
                                        <input type="text" name="surname" id="worker-surname-ajax" class="form-control" form="my_form_new_worker">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <label for="worker" class="col-sm-3 control-label">Имя</label>
                                    <div class="col-sm-6" id="div-worker-name-ajax">
                                        <input type="text" name="name" id="worker-name-ajax" class="form-control" form="my_form_new_worker">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <label for="worker" class="col-sm-3 control-label">Отчество</label>
                                    <div class="col-sm-6" id="div-worker-patronymic-ajax">
                                        <input type="text" name="patronymic" id="worker-patronymic-ajax" class="form-control" form="my_form_new_worker">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <label for="worker" class="col-sm-3 control-label">Зарплата</label>
                                    <div class="col-sm-6" id="div-worker-salary-ajax">
                                        <input type="text" name="salary" id="worker-salary-ajax" class="form-control" form="my_form_new_worker">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <label for="worker" class="col-sm-3 control-label">Дата приема на работу</label>
                                    <div class="col-sm-6" id="div-worker-date_receipt-ajax">
                                        <input type="text" name="date_receipt" id="worker-date_receipt-ajax" class="form-control date" form="my_form_new_worker">
                                    </div>
                                    </div>
                                </div>                    
                            </div>
                                <div id = "step2" style="display: none;">
                                <div id = "position_selection">    
                                <form  id="new_worker_my_form_ajax"  method="POST"> {{ csrf_field() }}</form>
                                    <table class="table table_position_new_worker table-striped">
                                        <tr>
                                            <th>
                                                <a id = "order_position_name" class="order_ajax_new_worker">Название должности</a>
                                                <span id = "span_new_worker_order_position_name" class="{{$params_position->getGlifkon('order_position_name')}}"></span>
                                                <input id = "input_new_worker_order_position_name" type="hidden" value = "{{ $params_position->order_position_name}}" name="order_position_name" class="form-control" form="new_worker_my_form_ajax">
                                            </th> 
                                            <th>Описание должности</th>
                                            <th>
                                                <a id = "order_created_at" class="order_ajax_new_worker">Добавили</a>
                                                <span id = "span_new_worker_order_created_at" class="{{$params_position->getGlifkon('order_created_at')}}"></span>
                                                <input id = "input_new_worker_order_created_at" type="hidden" value = "{{ $params_position->order_created_at}}" name="order_created_at"  class="form-control" form="new_worker_my_form_ajax">
                                            </th>
                                            <th>
                                                <a id = "order_updated_at" class="order_ajax_new_worker">Обновили</a>
                                                <span id = "span_new_worker_order_updated_at" class="{{$params_position->getGlifkon('order_updated_at')}}"></span>
                                                <input id = "input_new_worker_order_updated_at" type="hidden" value = "{{ $params_position->order_updated_at}}" name="order_updated_at"  class="form-control" form="new_worker_my_form_ajax">
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>    
                                            <div class="input-group">  
                                                <span>Поиск по названию должности</span>
                                                <input type="text" value = "{{$params_position->name_position }}" name="name_position" id="position-position_name" class="form-control" form="new_worker_my_form_ajax">                     
                                            </div>
                                            </td>
                                            <td></td>
                                            <td>                             
                                            <div class="input-group">
                                                <span>Поиск по дате добавления</span>
                                                <input type="text" value = "{{$params_position->created_at }}" name="created_at" id="position-created_at" class="form-control date" form="new_worker_my_form_ajax">                     
                                            </div>
                                            </td>
                                            <td>
                                            <div class="input-group">
                                                <span>Поиск по дате обновления</span>
                                                <input type="text" value = "{{$params_position->updated_at }}" name="updated_at" id="position-created_at" class="form-control date" form="new_worker_my_form_ajax">                     
                                                <input type="submit" id="btn_new_worker_serch"  title="" form="new_worker_my_form_ajax" style="display: none;">                        
                                            </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        @foreach ($positions as $position)
                                        <tr class="position_new_worker" id="new-worker-position-{{$position->id}}">
                                            <td id="position-name_position-{{$position->id}}" class="nameposition_new_worker">
                                                <span id='new-worker-span-name_position-{{$position->id}}'>{{ $position->name_position  }}</span>
                                                <form id='new-worker-my_form_ajax_update_name_position-{{$position->id}}' style='display: none;' class='form-horizontal'>
                                                    {{ csrf_field() }}
                                                    <input type='text' value='{{$position->name_position}}' name='name_position' id='new-worker-input-position-name_position-{{$position->id}}' class='form-control'>
                                                    <input type='hidden' value='{{$position->id}}' name='id' id='new-worker-input-position-id-{{$position->id}}' class='form-control'>
                                                    <button id='update-{{$position->id}}' type='submit' class='btn btn-warning btn-xs new-worker-update-btn-nameposition'  >
                                                        Обновить
                                                    </button>                  
                                                </form>
                                            </td>
                                            <td id='position-description_position-{{$position->id}}' class="description_position_new_worker">
                                                <span id='new-worker-span-description_position-{{$position->id}}'>{{$position->description_position}}</span>
                                                <form id='new-worker-my_form_ajax_update_description_position-{{$position->id}}' style='display:none;' class='form-horizontal'>
                                                    {{ csrf_field() }}
                                                    <textarea type='text' name='description_position' id='new-worker-input-position-description_position-{{$position->id}}' class='form-control'>{{$position->description_position}}</textarea>
                                                    <input type='hidden' value='{{$position->id}}' name='id' id='new-worker-input-position-id-{{$position->id}}' class='form-control'>
                                                    <button id='update-{{$position->id}}' type='submit' class='btn btn-warning btn-xs new-worker-update-btn-description_position'>
                                                        Обновить
                                                    </button>                  
                                                </form>
                                            </td>
                                            <td id='new-worker-td-created_at-{{$position->id}}'>{{ date("d.m.Y",strtotime($position->created_at))  }}</td>
                                            <td id='new-worker-td-updated_at-{{$position->id}}'>{{ date("d.m.Y",strtotime($position->updated_at))  }}</td>
                                            <td>                                                                            
                                                <button type="submit" id="new-worker-position-button-{{$position->id}}" class="btn btn-danger btn-xs btn-position-new-worker">
                                                    Выбрать    
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id='new-worker-td-error-name_position-{{$position->id}}' colspan='5' style='display: none'>
                                                <ul class='list-group'>    
                                                    <li id='new-worker-li-error-name_position-{{$position->id}}' class='list-group-item list-group-item-danger'>Ошибка</li>        
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach  
                                    </table>
                                    
                                    <ul class="pagination pagination_new_worker" style="margin-top: 0px; margin-bottom: 0px; float: inline-start;">
                                        <input id = "input_position_page_new_worker_ajax" type="hidden" value = "{{ $params_position->page}}" name="page"  class="form-control" form="new_worker_my_form_ajax">    
                                        <?php
                                            $a = ceil($params_position->count/$params_position->limit);
                                        ?>
                                        @if ($a>1)
                                            @if ($params_position->page == 1)
                                                <li class="disabled"><span>«</span></li> 
                                            @else
                                                <li><a  id ="{{$params_position->page-1}}" class="my_position_page_ajax_new_worker" rel="next">«</a></li> 
                                            @endif
                                        @for ($i = 1; $i <= $a; $i++)            
                                            @if ($params_position->page == $i)
                                                <li class="active"><span>{{$i}}</span></li> 
                                            @else
                                                @if ($i >= $params_position->page-2  &&  $i <= $params_position->page+2)
                                                    <li><a  id ="{{$i}}" class="my_position_page_ajax_new_worker" >{{$i}}</a></li>  
                                                @else
                                                    @if ($i == 1)
                                                        <li><a  id ="{{$i}}" class="my_position_page_ajax_new_worker">{{$i}}</a></li>
                                                        <li class="disabled"><span>...</span></li>
                                                    @endif
                                                    @if ($i == $a)
                                                        <li class="disabled"><span>...</span></li>
                                                        <li><a  id ="{{$i}}" class="my_position_page_ajax_new_worker">{{$i}}</a></li>                
                                                    @endif
                                                    @continue  
                                                @endif                  
                                            @endif
                                        @endfor
                                        @if ($params_position->page == $a)
                                            <li class="disabled"><span>»</span></li> 
                                        @else
                                            <li><a  id ="{{$params_position->page+1}}" class="my_position_page_ajax_new_worker" rel="next">»</a></li> 
                                        @endif
                                        @endif
                                    </ul>
                                    </div>
                                    <table class="table chek_table_position_new_worker table-striped" style="display: none;">
                                        <tr>
                                            <th>
                                                Название должности
                                            </th> 
                                            <th>Описание должности</th>
                                            <th>
                                               Добавили
                                            </th>
                                            <th>
                                                Обновили
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr style="background:#fc0;">
                                            <td id = "chek_name_position"></td>                                            
                                            <td id = "chek_description_position"></td>
                                            <td id = "chek_created_at"></td>
                                            <td id = "chek_updated_at"></td>
                                            <td>
                                                <button type="submit" id="chek-new-worker-position-button" class="btn btn-danger btn-xs btn-not-chek-position-new-worker">
                                                    Отменить выбор    
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div id = "step3" style="display: none;">
                                    <div id = "worker_selection">
                                    <form  id="my_form_ajax_workers_new_worker" > 
                                        {{ csrf_field() }}
                                    </form>
                                    <table class="table table-striped my_table_workers_new_worker">
                                        <tr>
                                            <th>
                                                <a id = "new_worker_order_surname" class="new_worker_order_ajax_workers">Фамилия</a>
                                                <span id = "span_new_worker_order_surname" class="{{$params->getGlifkon('order_surname')}}"></span>
                                                <input id = "input_new_worker_order_surname" type="hidden" value = "{{ $params->order_surname}}" name="order_surname" class="form-control" form="my_form_ajax_workers_new_worker">
                                            </th> 
                                            <th>
                                                <a id = "new_worker_order_name" class="new_worker_order_ajax_workers">Имя</a>
                                                <span id = "span_new_worker_order_name" class="{{$params->getGlifkon('order_name')}}"></span>
                                                <input id = "input_new_worker_order_name" type="hidden" value = "{{ $params->order_name}}" name="order_name" class="form-control" form="my_form_ajax_workers_new_worker">
                                            </th>
                                            <th>
                                                <a id = "new_worker_order_patronymic" class="new_worker_order_ajax_workers">Отчество</a>
                                                <span id = "span_new_worker_order_patronymic" class="{{$params->getGlifkon('order_patronymic')}}"></span>
                                                <input id = "input_new_worker_order_patronymic" type="hidden" value = "{{ $params->order_patronymic}}" name="order_patronymic" class="form-control" form="my_form_ajax_workers_new_worker">
                                            </th>
                                            <th>
                                                <a id = "new_worker_order_name_position" class="new_worker_order_ajax_workers">Должность</a>
                                                <span id = "span_new_worker_order_name_position" class="{{$params->getGlifkon('order_name_position')}}"></span>
                                                <input id = "input_new_worker_order_name_position" type="hidden" value = "{{ $params->order_name_position}}" name="order_name_position" class="form-control" form="my_form_ajax_workers_new_worker">
                                            </th>
                                            <th>
                                                <a id = "new_worker_order_chief" class="new_worker_order_ajax_workers">Начальник</a>
                                                <span id = "span_new_worker_order_chief" class="{{$params->getGlifkon('order_chief')}}"></span>
                                                <input id = "input_new_worker_order_chief" type="hidden" value = "{{ $params->order_chief}}" name="order_chief" class="form-control" form="my_form_ajax_workers_new_worker">
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>    
                                                <div class="input-group">  
                                                    <span>Поиск по фамилии</span>
                                                    <input type="text" value = "{{ $params->surname }}" name="surname" id="new_worker_worker-surname" class="form-control" form="my_form_ajax_workers_new_worker">                     
                                                </div>
                                            </td>
                                            <td>    
                                                <div class="input-group">  
                                                    <span>Поиск по имени</span>
                                                    <input type="text" value = "{{ $params->name }}" name="name" id="new_worker_worker-name" class="form-control" form="my_form_ajax_workers_new_worker">                     
                                                </div>
                                            </td>
                                            <td>    
                                                <div class="input-group">  
                                                    <span>Поиск по отчеству</span>
                                                    <input type="text" value = "{{ $params->patronymic }}" name="patronymic" id="new_worker_worker-patronymic" class="form-control" form="my_form_ajax_workers_new_worker">                     
                                                </div>
                                            </td>
                                            <td>                             
                                                <div class="input-group">
                                                    <span>Поиск по должности</span>
                                                    <input type="text" value = "{{ $params->name_position }}" name="name_position" id="new_worker_name_position" class="form-control" form="my_form_ajax_workers_new_worker">                     
                                                </div>
                                            </td>
                                            <td>                             
                                                <div class="input-group">
                                                    <span>Поиск по начальнику</span>
                                                    <input type="text" value = "{{ $params->chief }}" name="chief" id="new_worker_chief" class="form-control" form="my_form_ajax_workers_new_worker">                     
                                                    <input type="submit" id ="btn_serch_workers_new_worker" title="" form="my_form_ajax_workers_new_worker" style="display: none;">
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        @foreach ($workers as $worker)
                                        <tr class="new_worker_worker" id="new_worker_worker-{{$worker->id}}">
                                            <td id="new_worker_worker-surname-{{$worker->id}}" class="worker_surname">
                                                <span id='new_worker_span-surname-{{$worker->id}}'>{{$worker->surname}}</span>
                                            </td>
                                            <td id="new_worker_worker-name-{{$worker->id}}" class="worker_name">
                                                <span id='new_worker_span-name-{{$worker->id}}'>{{$worker->name}}</span>
                                                
                                            </td>
                                            <td id="new_worker_worker-patronymic-{{$worker->id}}" class="worker_patronymic">
                                                <span id='new_worker_span-patronymic-{{$worker->id}}'>{{$worker->patronymic}}</span>
                                                
                                            </td>
                                            <td id="new_worker_worker-position-{{$worker->id}}" class="new_worker_worker_position">
                                                {{empty($worker->id_position)?'нет':$worker->position->name_position }}
                                            </td>
                                            <td id="new_worker_worker-workers-{{$worker->id}}">
                                                <?php
                                                if($worker->id_worker === NULL){
                                                        echo "не задан";  
                                                    }else{
                                                        echo $worker->worker->surname;
                                                    }    
                                                ?>    
                                            </td>
                                            <td>
                                                <button type="submit" id="new_worker_choose_workers-{{ $worker->id }}" class="btn btn-danger btn-xs btn-new-worker-workers">
                                                    Выбрать
                                                </button>
                                            </td>
                                        </tr>
                                        
                                        @endforeach  
                                    </table>    
                                    <ul class="pagination new_worker_pagination_workers">
                                    <input id = "new_worker_input_page_ajax" type="hidden" value = "{{ $params->page}}" name="page"  class="form-control" form="my_form_ajax_workers_new_worker">    
                                        <?php
                                        $a = ceil($params->count/$params->limit);

                                        ?>
                                        @if ($params->count>=10)
                                        @if ($params->page == 1)
                                            <li class="disabled"><span>«</span></li> 
                                        @else
                                        <li><a  id ="{{$params->page-1}}" class="new_worker_my_page_ajax_workers" rel="next">«</a></li> 
                                        @endif
                                        @for ($i = 1; $i <= $a; $i++)            
                                            @if ($params->page == $i)
                                                <li class="active"><span>{{$i}}</span></li> 
                                            @else
                                                @if ($i >= $params->page-2  &&  $i <= $params->page+2)
                                                    <li><a  id ="{{$i}}" class="new_worker_my_page_ajax_workers" >{{$i}}</a></li>  
                                                @else
                                                    @if ($i == 1)
                                                        <li><a  id ="{{$i}}" class="new_worker_my_page_ajax_workers">{{$i}}</a></li>
                                                        <li class="disabled"><span>...</span></li>
                                                    @endif
                                                    @if ($i == $a)
                                                        <li class="disabled"><span>...</span></li>
                                                        <li><a  id ="{{$i}}" class="new_worker_my_page_ajax_workers">{{$i}}</a></li>                
                                                    @endif
                                                    @continue  
                                                @endif

                                            @endif
                                        @endfor
                                        @if ($params->page == $a)
                                            <li class="disabled"><span>»</span></li> 
                                        @else
                                            <li><a  id ="{{$params->page+1}}" class="new_worker_my_page_ajax_workers" rel="next">»</a></li> 
                                        @endif
                                        @endif
                                        </ul>
                                    </div>
                                    <div id="teble-selection" style="display: none;">
                                        <table class="table table-striped my_table_workers_new_worker_selection">
                                        <tr>
                                            <th>
                                                Фамилия                                                
                                            </th> 
                                            <th>
                                                Имя
                                            </th>
                                            <th>
                                                Отчество
                                            </th>
                                            <th>
                                                Должность
                                            </th>
                                            <th>
                                                Начальник
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr style="background:#fc0;">
                                            <td id="new_worker_worker_selection-surname" class="worker_surname">
                                            </td>
                                            <td id="new_worker_worker_selection-name" class="worker_name">
                                            </td>
                                            <td id="new_worker_worker_selection-patronymic" class="worker_patronymic">
                                            </td>
                                            <td id="new_worker_worker_selection-position" class="new_worker_worker_position">                                                
                                            </td>
                                            <td id="new_worker_worker_selection-worker_surnamen">
                                            </td>
                                            <td>
                                                <button type="submit" id="new_worker_choose_workers" class="btn btn-danger btn-xs btn-selection-new_worker-worker">
                                                Отменить выбор
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                    </div>
                                </div>
                            </div>    
                            <div class="panel-footer">
                                <button id="btn_step" type="submit" class="btn btn-success">
                                    Шаг 1
                                </button>
                                <a id="btn_back_new_worker" class="btn btn-success">Свернуть</a>    
                            </div>
                        </div>
                    </div>    
                </div>
                <form  id="my_form_ajax_workers" > 
                    {{ csrf_field() }}
                </form>
                <table class="table table-striped my_table_workers">
                    <tr>
                        <th></th>
                        <th>
                            <a id = "order_surname" class="order_ajax_workers">Фамилия</a>
                            <span id = "span_order_surname" class="{{$params->getGlifkon('order_surname')}}"></span>
                            <input id = "input_order_surname" type="hidden" value = "{{ $params->order_surname}}" name="order_surname" class="form-control" form="my_form_ajax_workers">
                        </th> 
                        <th>
                            <a id = "order_name" class="order_ajax_workers">Имя</a>
                            <span id = "span_order_name" class="{{$params->getGlifkon('order_name')}}"></span>
                            <input id = "input_order_name" type="hidden" value = "{{ $params->order_name}}" name="order_name" class="form-control" form="my_form_ajax_workers">
                        </th>
                        <th>
                            <a id = "order_patronymic" class="order_ajax_workers">Отчество</a>
                            <span id = "span_order_patronymic" class="{{$params->getGlifkon('order_patronymic')}}"></span>
                            <input id = "input_order_patronymic" type="hidden" value = "{{ $params->order_patronymic}}" name="order_patronymic" class="form-control" form="my_form_ajax_workers">
                        </th>
                        <th>
                            <a id = "order_salary" class="order_ajax_workers">Зарплата</a>
                            <span id = "span_order_salary" class="{{$params->getGlifkon('order_salary')}}"></span>
                            <input id = "input_order_salary" type="hidden" value = "{{ $params->order_salary}}" name="order_salary" class="form-control" form="my_form_ajax_workers">
                        </th>
                        <th>
                            <a id = "order_date_receipt" class="order_ajax_workers">Приняли на работу</a>
                            <span id = "span_order_date_receipt" class="{{$params->getGlifkon('order_date_receipt')}}"></span>
                            <input id = "input_order_date_receipt" type="hidden" value = "{{ $params->order_date_receipt}}" name="order_date_receipt" class="form-control" form="my_form_ajax_workers">
                        </th>
                        <th>
                            <a id = "order_name_position" class="order_ajax_workers">Должность</a>
                            <span id = "span_order_name_position" class="{{$params->getGlifkon('order_name_position')}}"></span>
                            <input id = "input_order_name_position" type="hidden" value = "{{ $params->order_name_position}}" name="order_name_position" class="form-control" form="my_form_ajax_workers">
                        </th>
                        <th>
                            <a id = "order_chief" class="order_ajax_workers">Начальник</a>
                            <span id = "span_order_chief" class="{{$params->getGlifkon('order_chief')}}"></span>
                            <input id = "input_order_chief" type="hidden" value = "{{ $params->order_chief}}" name="order_chief" class="form-control" form="my_form_ajax_workers">
                        </th>
                        <th>
                            <a id = "order_created_at" class="order_ajax_workers">Добавили</a>
                            <span id = "span_order_created_at" class="{{$params->getGlifkon('order_created_at')}}"></span>
                            <input id = "input_order_created_at" type="hidden" value = "{{ $params->order_created_at}}" name="order_created_at"  class="form-control" form="my_form_ajax_workers">
                        </th>
                        <th>
                            <a id = "order_updated_at" class="order_ajax_workers">Обновили</a>
                            <span id = "span_order_updated_at" class="{{$params->getGlifkon('order_updated_at')}}"></span>
                            <input id = "input_order_updated_at" type="hidden" value = "{{ $params->order_updated_at}}" name="order_updated_at"  class="form-control" form="my_form_ajax_workers">
                        </th>
                        <th></th>
                    </tr>
                    <tr>
                        <td></td>
                        <td>    
                        <div class="input-group">  
                            <span>Поиск по фамилии</span>
                            <input type="text" value = "{{ $params->surname }}" name="surname" id="worker-surname" class="form-control" form="my_form_ajax_workers">                     
                        </div>
                        </td>
                        <td>    
                        <div class="input-group">  
                            <span>Поиск по имени</span>
                            <input type="text" value = "{{ $params->name }}" name="name" id="worker-name" class="form-control" form="my_form_ajax_workers">                     
                        </div>
                        </td>
                        <td>    
                        <div class="input-group">  
                            <span>Поиск по отчеству</span>
                            <input type="text" value = "{{ $params->patronymic }}" name="patronymic" id="worker-patronymic" class="form-control" form="my_form_ajax_workers">                     
                        </div>
                        </td>
                        <td>    
                        <div class="input-group">  
                            <span>Поиск по зарплате</span>
                            <input type="text" value = "{{ $params->salary }}" name="salary" id="worker-salary" class="form-control" form="my_form_ajax_workers">                     
                        </div>
                        </td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по дате принятия на работу</span>
                            <input type="text" value = "{{ $params->date_receipt }}" name="date_receipt" id="worker-date_receipt" class="form-control date" form="my_form_ajax_workers">                     
                        </div>
                        </td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по должности</span>
                            <input type="text" value = "{{ $params->name_position }}" name="name_position" id="name_position" class="form-control" form="my_form_ajax_workers">                     
                        </div>
                        </td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по начальнику</span>
                            <input type="text" value = "{{ $params->chief }}" name="chief" id="chief" class="form-control" form="my_form_ajax_workers">                     
                        </div>
                        </td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по дате добавления</span>
                            <input type="text" value = "{{ $params->created_at }}" name="created_at" id="worker-created_at" class="form-control date" form="my_form_ajax_workers">                     
                        </div>
                        </td>
                        <td>
                        <div class="input-group">
                            <span>Поиск по дате обновления</span>
                            <input type="text" value = "{{ $params->updated_at }}" name="updated_at" id="worker-created_at" class="form-control date" form="my_form_ajax_workers">                     
                            <input type="submit" id ="btn_serch_workers" title="" form="my_form_ajax_workers" style="display: none;">
                        </div>
                        </td>
                        <td></td>
                    </tr>
                    @foreach ($workers as $worker)
                    <tr class="worker" id="worker-{{$worker->id}}">
                        <td id="worker-photo-{{$worker->id}}" class="worker_photo">
                            <img id="img-{{$worker->id}}" src="{{$worker->getUrlFoto()}}"  width="30" height="30">
                            <div class="modal fade" id="myModal-{{$worker->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Фото работника {{$worker->surname}} {{$worker->name}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <img id="img_photo-{{$worker->id}}" src="{{$worker->getUrlFoto()}}" style="display: none; width: 100px; height: 100px;">
                                                <div class="file-loading">
                                                    <input id="file-fr-{{$worker->id}}" name="file" type="file" multiple>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Закрыть</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td id="worker-surname-{{$worker->id}}" class="worker_surname">
                            <span id='span-surname-{{$worker->id}}'>{{$worker->surname}}</span>
                            <form id='my_form_ajax_worker_update_surname-{{$worker->id}}' style='display: none;' class='form-horizontal'>
                                {{ csrf_field() }}
                                <input type='text' value='{{$worker->surname}}' name='surname' id='input-worker-surname-{{$worker->id}}' class='form-control'>
                                <input type='hidden' value='{{$worker->id}}' name='id' id='input-worker-id-{{$worker->id}}' class='form-control'>
                                <button id='update-worker-surname-{{$worker->id}}' type='submit' class='btn btn-warning btn-xs update-worker-surname-btn'  >
                                    Обновить
                                </button>                  
                            </form>
                        </td>
                        <td id="worker-name-{{$worker->id}}" class="worker_name">
                            <span id='span-name-{{$worker->id}}'>{{$worker->name}}</span>
                            <form id='my_form_ajax_worker_update_name-{{$worker->id}}' style='display: none;' class='form-horizontal'>
                                {{ csrf_field() }}
                                <input type='text' value='{{$worker->name}}' name='name' id='input-worker-name-{{$worker->id}}' class='form-control'>
                                <input type='hidden' value='{{$worker->id}}' name='id' id='input-worker-id-{{$worker->id}}' class='form-control'>
                                <button id='update-worker-name-{{$worker->id}}' type='submit' class='btn btn-warning btn-xs update-worker-name-btn'  >
                                    Обновить
                                </button>                  
                            </form>
                        </td>
                        <td id="worker-patronymic-{{$worker->id}}" class="worker_patronymic">
                            <span id='span-patronymic-{{$worker->id}}'>{{$worker->patronymic}}</span>
                            <form id='my_form_ajax_worker_update_patronymic-{{$worker->id}}' style='display: none;' class='form-horizontal'>
                                {{ csrf_field() }}
                                <input type='text' value='{{$worker->patronymic}}' name='patronymic' id='input-worker-patronymic-{{$worker->id}}' class='form-control'>
                                <input type='hidden' value='{{$worker->id}}' name='id' id='input-worker-id-{{$worker->id}}' class='form-control'>
                                <button id='update-worker-patronymic-{{$worker->id}}' type='submit' class='btn btn-warning btn-xs update-worker-patronymic-btn'  >
                                    Обновить
                                </button>                  
                            </form>
                        </td>
                        <td id="worker-salary-{{$worker->id}}" class="worker_salary">
                            <span id='span-salary-{{$worker->id}}'>{{$worker->salary}}</span>
                            <form id='my_form_ajax_worker_update_salary-{{$worker->id}}' style='display: none;' class='form-horizontal'>
                                {{ csrf_field() }}
                                <input type='text' value='{{$worker->salary}}' name='salary' id='input-worker-salary-{{$worker->id}}' class='form-control'>
                                <input type='hidden' value='{{$worker->id}}' name='id' id='input-worker-id-{{$worker->id}}' class='form-control'>
                                <button id='update-worker-salary-{{$worker->id}}' type='submit' class='btn btn-warning btn-xs update-worker-salary-btn'  >
                                    Обновить
                                </button>                  
                            </form>
                        </td>
                        <td id="worker-date_receipt-{{$worker->id}}" class="worker_date_receipt">
                            <span id='span-date_receipt-{{$worker->id}}'>{{date("d.m.Y",strtotime($worker->date_receipt))}}</span>
                            <form id='my_form_ajax_worker_update_date_receipt-{{$worker->id}}' style='display: none;' class='form-horizontal'>
                                {{ csrf_field() }}
                                <input type='text' value='{{date("d.m.Y",strtotime($worker->date_receipt))}}' name='date_receipt' id='input-worker-date_receipt-{{$worker->id}}' class='form-control date'>
                                <input type='hidden' value='{{$worker->id}}' name='id' id='input-worker-id-{{$worker->id}}' class='form-control'>
                                <button id='update-worker-date_receipt-{{$worker->id}}' type='submit' class='btn btn-warning btn-xs update-worker-date_receipt-btn'  >
                                    Обновить
                                </button>                  
                            </form>
                        </td>
                        <td id="worker-position-{{$worker->id}}" class="worker_position">
                            {{empty($worker->id_position)?'нет':$worker->position->name_position }}
                        </td>
                        <td>
                            <?php
                            if($worker->id_worker === NULL){
                                    echo "не задан";  
                                }else{
                                    echo $worker->worker->surname;
                                }    
                            ?>    
                        </td>
                        <td>{{ date("d.m.Y",strtotime($worker->created_at))  }}</td>
                        <td>{{ date("d.m.Y",strtotime($worker->updated_at))  }}</td>
                        <td>
                                <button type="submit" id="delete-position-{{ $worker->id }}" class="btn btn-danger btn-xs btn-position">
                                    Удалить
                                </button>
                        </td>
                    </tr>
                    <tr>
                        <td id='td-error-worker-{{$worker->id}}' colspan='11' style='display: none'>
                            <ul class='list-group'>    
                                <li id='li-error-worker-{{$worker->id}}' class='list-group-item list-group-item-danger'>Ошибка</li>        
                            </ul>
                        </td>
                    </tr>
                    @endforeach  
                </table>    
                </div>
                <div class="panel-footer">
                    <ul class="pagination pagination_workers">
                    <input id = "input_page_ajax" type="hidden" value = "{{ $params->page}}" name="page"  class="form-control" form="my_form_ajax_workers">    
                        <?php
                        $a = ceil($params->count/$params->limit);
                        
                        ?>
                        @if ($params->count>=10)
                        @if ($params->page == 1)
                            <li class="disabled"><span>«</span></li> 
                        @else
                        <li><a  id ="{{$params->page-1}}" class="my_page_ajax_workers" rel="next">«</a></li> 
                        @endif
                        @for ($i = 1; $i <= $a; $i++)            
                            @if ($params->page == $i)
                                <li class="active"><span>{{$i}}</span></li> 
                            @else
                                @if ($i >= $params->page-2  &&  $i <= $params->page+2)
                                    <li><a  id ="{{$i}}" class="my_page_ajax_workers" >{{$i}}</a></li>  
                                @else
                                    @if ($i == 1)
                                        <li><a  id ="{{$i}}" class="my_page_ajax_workers">{{$i}}</a></li>
                                        <li class="disabled"><span>...</span></li>
                                    @endif
                                    @if ($i == $a)
                                        <li class="disabled"><span>...</span></li>
                                        <li><a  id ="{{$i}}" class="my_page_ajax_workers">{{$i}}</a></li>                
                                    @endif
                                    @continue  
                                @endif
                                
                            @endif
                        @endfor
                        @if ($params->page == $a)
                            <li class="disabled"><span>»</span></li> 
                        @else
                            <li><a  id ="{{$params->page+1}}" class="my_page_ajax_workers" rel="next">»</a></li> 
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal-positions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Выбрать должность работника</h4>
            </div>
            <div class="modal-body">
            <input id="modal_worker_id"  type="hidden" value = "" >    
            <form  id="my_form_ajax"  method="POST"> {{ csrf_field() }}</form>
                <table class="table table_position_modal table-striped">
                    <tr>
                        <th>
                            <a id = "order_position_name" class="order_ajax_modal">Название должности</a>
                            <span id = "span_modal_order_position_name" class="{{$params_position->getGlifkon('order_position_name')}}"></span>
                            <input id = "input_modal_order_position_name" type="hidden" value = "{{ $params_position->order_position_name}}" name="order_position_name" class="form-control" form="my_form_ajax">
                        </th> 
                        <th>Описание должности</th>
                        <th>
                            <a id = "order_created_at" class="order_ajax_modal">Добавили</a>
                            <span id = "span_modal_order_created_at" class="{{$params_position->getGlifkon('order_created_at')}}"></span>
                            <input id = "input_modal_order_created_at" type="hidden" value = "{{ $params_position->order_created_at}}" name="order_created_at"  class="form-control" form="my_form_ajax">
                        </th>
                        <th>
                            <a id = "order_updated_at" class="order_ajax_modal">Обновили</a>
                            <span id = "span_modal_order_updated_at" class="{{$params_position->getGlifkon('order_updated_at')}}"></span>
                            <input id = "input_modal_order_updated_at" type="hidden" value = "{{ $params_position->order_updated_at}}" name="order_updated_at"  class="form-control" form="my_form_ajax">
                        </th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>    
                        <div class="input-group">  
                            <span>Поиск по названию должности</span>
                            <input type="text" value = "{{$params_position->name_position }}" name="name_position" id="position-position_name" class="form-control" form="my_form_ajax">                     
                        </div>
                        </td>
                        <td></td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по дате добавления</span>
                            <input type="text" value = "{{$params_position->created_at }}" name="created_at" id="position-created_at" class="form-control date" form="my_form_ajax">                     
                        </div>
                        </td>
                        <td>
                        <div class="input-group">
                            <span>Поиск по дате обновления</span>
                            <input type="text" value = "{{$params_position->updated_at }}" name="updated_at" id="position-created_at" class="form-control date" form="my_form_ajax">                     
                            <input type="submit" id="btn_modal"  title="" form="my_form_ajax" style="display: none;">                        
                        </div>
                        </td>
                        <td></td>
                    </tr>
                    @foreach ($positions as $position)
                    <tr class="position" id="position-{{$position->id}}">
                        <td id="position-name_position-{{$position->id}}" class="nameposition">
                            <span id='span-name_position-{{$position->id}}'>{{ $position->name_position  }}</span>
                            <form id='my_form_ajax_update_name_position-{{$position->id}}' style='display: none;' class='form-horizontal'>
                                {{ csrf_field() }}
                                <input type='text' value='{{$position->name_position}}' name='name_position' id='input-position-name_position-{{$position->id}}' class='form-control'>
                                <input type='hidden' value='{{$position->id}}' name='id' id='input-position-id-{{$position->id}}' class='form-control'>
                                <button id='update-{{$position->id}}' type='submit' class='btn btn-warning btn-xs update-btn'  >
                                    Обновить
                                </button>                  
                            </form>
                        </td>
                        <td id='position-description_position-{{$position->id}}' class="description_position">
                            <span id='span-description_position-{{$position->id}}'>{{$position->description_position}}</span>
                            <form id='my_form_ajax_update_description_position-{{$position->id}}' style='display:none;' class='form-horizontal'>
                                {{ csrf_field() }}
                                <textarea type='text' name='description_position' id='input-position-description_position-{{$position->id}}' class='form-control'>{{$position->description_position}}</textarea>
                                <input type='hidden' value='{{$position->id}}' name='id' id='input-position-id-{{$position->id}}' class='form-control'>
                                <button id='update-{{$position->id}}' type='submit' class='btn btn-warning btn-xs update-btn-description_position'>
                                    Обновить
                                </button>                  
                            </form>
                        </td>
                        <td>{{ date("d.m.Y",strtotime($position->created_at))  }}</td>
                        <td>{{ date("d.m.Y",strtotime($position->updated_at))  }}</td>
                        <td>                            
                            <form id = "change-position-{{$position->id}}">
                                {{ csrf_field() }}
                                <input id = "worker_id-{{$position->id}}" type="hidden" value = "" name="worker_id">
                                <input id = "position_id" type="hidden" value = "{{$position->id}}" name="position_id">
                                <button type="submit" id="change-position-button-{{$position->id}}" class="btn btn-danger btn-xs btn-position-change">
                                Заменить    
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td id='td-error-name_position-{{$position->id}}' colspan='5' style='display: none'>
                            <ul class='list-group'>    
                                <li id='li-error-name_position-{{$position->id}}' class='list-group-item list-group-item-danger'>Ошибка</li>        
                            </ul>
                        </td>
                    </tr>
                    @endforeach  
                </table>                  
            </div>
            <div class="modal-footer">
                <ul class="pagination pagination_modal pagination_position" style="margin-top: 0px; margin-bottom: 0px; float: inline-start;">
                    <input id = "input_position_page_ajax" type="hidden" value = "{{ $params_position->page}}" name="page"  class="form-control" form="my_form_ajax">    
                        <?php
                        $a = ceil($params_position->count/$params_position->limit);
                        ?>
                        @if ($a>1)
                        @if ($params_position->page == 1)
                            <li class="disabled"><span>«</span></li> 
                        @else
                        <li><a  id ="{{$params_position->page-1}}" class="my_position_page_ajax" rel="next">«</a></li> 
                        @endif
                        @for ($i = 1; $i <= $a; $i++)            
                            @if ($params_position->page == $i)
                                <li class="active"><span>{{$i}}</span></li> 
                            @else
                                @if ($i >= $params_position->page-2  &&  $i <= $params_position->page+2)
                                    <li><a  id ="{{$i}}" class="my_position_page_ajax" >{{$i}}</a></li>  
                                @else
                                    @if ($i == 1)
                                        <li><a  id ="{{$i}}" class="my_position_page_ajax">{{$i}}</a></li>
                                        <li class="disabled"><span>...</span></li>
                                    @endif
                                    @if ($i == $a)
                                        <li class="disabled"><span>...</span></li>
                                        <li><a  id ="{{$i}}" class="my_position_page_ajax">{{$i}}</a></li>                
                                    @endif
                                    @continue  
                                @endif
                                
                            @endif
                        @endfor
                        @if ($params_position->page == $a)
                            <li class="disabled"><span>»</span></li> 
                        @else
                            <li><a  id ="{{$params_position->page+1}}" class="my_position_page_ajax" rel="next">»</a></li> 
                        @endif
                        @endif
                    </ul>
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
@endsection

