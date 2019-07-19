<!-- resources/views/tasks/index.blade.php -->
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
                    <h4>Обновить начальника шаг - 3</h4>            
                </div>
                <div class="panel-body">
                <form action="{{ url('/updateworkers/'.$worker_id) }}" method="POST">
                    {{ csrf_field() }}
                    <input id = "worker" type="hidden" value = "{{0}}" name="worker" class="form-control">
                    <input id = "step" type="hidden" value = "{{$step+1}}" name="step" class="form-control">
                    <input id = "worker_id" type="hidden" value = "{{$worker_id}}" name="worker_id" class="form-control">
                    <button type="submit"  class="btn btn-danger" style="margin-bottom: 5px">
                        Пропустить шаг    
                    </button>
                </form>    
                <form  id="my_form" action="{{ url('/updateworkers/'.$worker_id) }}" method="POST">    
                    {{ csrf_field() }}
                    <input id = "worker_id" type="hidden" value = "{{$worker_id}}" name="worker_id" class="form-control">
                    <input id = "step" type="hidden" value = "{{$step}}" name="step" class="form-control">
                </form>
                <table class="table table-striped my_table_workers">
                    <tr>
                        <th>
                            <a id = "order_surname" class="order">Фамилия</a>
                            <span id = "span_order_surname" class="{{$params->getGlifkon('order_surname')}}"></span>
                            <input id = "input_order_surname" type="hidden" value = "{{ $params->order_surname}}" name="order_surname" class="form-control" form="my_form">
                        </th> 
                        <th>
                            <a id = "order_name" class="order">Имя</a>
                            <span id = "span_order_name" class="{{$params->getGlifkon('order_name')}}"></span>
                            <input id = "input_order_name" type="hidden" value = "{{ $params->order_name}}" name="order_name" class="form-control" form="my_form">
                        </th>
                        <th>
                            <a id = "order_patronymic" class="order">Отчество</a>
                            <span id = "span_order_patronymic" class="{{$params->getGlifkon('order_patronymic')}}"></span>
                            <input id = "input_order_patronymic" type="hidden" value = "{{ $params->order_patronymic}}" name="order_patronymic" class="form-control" form="my_form">
                        </th>
                        <th>
                            <a id = "order_salary" class="order">Зарплата</a>
                            <span id = "span_order_salary" class="{{$params->getGlifkon('order_salary')}}"></span>
                            <input id = "input_order_salary" type="hidden" value = "{{ $params->order_salary}}" name="order_salary" class="form-control" form="my_form">
                        </th>
                        <th>
                            <a id = "order_date_receipt" class="order">Приняли на работу</a>
                            <span id = "span_order_date_receipt" class="{{$params->getGlifkon('order_date_receipt')}}"></span>
                            <input id = "input_order_date_receipt" type="hidden" value = "{{ $params->order_date_receipt}}" name="order_date_receipt" class="form-control" form="my_form">
                        </th>
                        <th>
                            <a id = "order_name_position" class="order">Должность</a>
                            <span id = "span_order_name_position" class="{{$params->getGlifkon('order_name_position')}}"></span>
                            <input id = "input_order_name_position" type="hidden" value = "{{ $params->order_name_position}}" name="order_name_position" class="form-control" form="my_form">
                        </th>
                        <th>
                            <a id = "order_chief" class="order">Начальник</a>
                            <span id = "span_order_chief" class="{{$params->getGlifkon('order_chief')}}"></span>
                            <input id = "input_order_chief" type="hidden" value = "{{ $params->order_chief}}" name="order_chief" class="form-control" form="my_form">
                        </th>
                        <th>
                            <a id = "order_created_at" class="order">Добавили</a>
                            <span id = "span_order_created_at" class="{{$params->getGlifkon('order_created_at')}}"></span>
                            <input id = "input_order_created_at" type="hidden" value = "{{ $params->order_created_at}}" name="order_created_at"  class="form-control" form="my_form">
                        </th>
                        <th>
                            <a id = "order_updated_at" class="order">Обновили</a>
                            <span id = "span_order_updated_at" class="{{$params->getGlifkon('order_updated_at')}}"></span>
                            <input id = "input_order_updated_at" type="hidden" value = "{{ $params->order_updated_at}}" name="order_updated_at"  class="form-control" form="my_form">
                        </th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>    
                        <div class="input-group">  
                            <span>Поиск по фамилии</span>
                            <input type="text" value = "{{ $params->surname }}" name="surname" id="worker-surname" class="form-control" form="my_form">                     
                        </div>
                        </td>
                        <td>    
                        <div class="input-group">  
                            <span>Поиск по имени</span>
                            <input type="text" value = "{{ $params->name }}" name="name" id="worker-name" class="form-control" form="my_form">                     
                        </div>
                        </td>
                        <td>    
                        <div class="input-group">  
                            <span>Поиск по отчеству</span>
                            <input type="text" value = "{{ $params->patronymic }}" name="patronymic" id="worker-patronymic" class="form-control" form="my_form">                     
                        </div>
                        </td>
                        <td>    
                        <div class="input-group">  
                            <span>Поиск по зарплате</span>
                            <input type="text" value = "{{ $params->salary }}" name="salary" id="worker-salary" class="form-control" form="my_form">                     
                        </div>
                        </td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по дате принятия на работу</span>
                            <input type="text" value = "{{ $params->date_receipt }}" name="date_receipt" id="worker-date_receipt" class="form-control date" form="my_form">                     
                        </div>
                        </td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по должности</span>
                            <input type="text" value = "{{ $params->name_position }}" name="name_position" id="name_position" class="form-control" form="my_form">                     
                        </div>
                        </td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по начальнику</span>
                            <input type="text" value = "{{ $params->chief }}" name="chief" id="chief" class="form-control" form="my_form">                     
                        </div>
                        </td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по дате добавления</span>
                            <input type="text" value = "{{ $params->created_at }}" name="created_at" id="worker-created_at" class="form-control date" form="my_form">                     
                        </div>
                        </td>
                        <td>
                        <div class="input-group">
                            <span>Поиск по дате обновления</span>
                            <input type="text" value = "{{ $params->updated_at }}" name="updated_at" id="worker-created_at" class="form-control date" form="my_form">                     
                            <input type="submit" title="" form="my_form" style="display: none;">
                        </div>
                        </td>
                        <td></td>
                    </tr>
                    @foreach ($workers as $worker)
                    <tr>
                        <td>{{ $worker->surname }}</td>
                        <td>{{ $worker->name }}</td>
                        <td>{{ $worker->patronymic }}</td>
                        <td>{{ $worker->salary }}</td>
                        <td>{{ date("d.m.Y",strtotime($worker->date_receipt))  }}</td>
                        <td>{{empty($worker->id_position)?'нет':$worker->position->name_position }}</td>
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
                            <form action="{{ url('/updateworkers/'.$worker_id) }}" method="POST">
                                {{ csrf_field() }}
                                <input id = "worker" type="hidden" value = "{{$worker->id}}" name="worker" class="form-control">
                                <input id = "step" type="hidden" value = "{{$step+1}}" name="step" class="form-control">
                                <input id = "worker_id" type="hidden" value = "{{$worker_id}}" name="worker_id" class="form-control">
                                <button type="submit"  class="btn btn-danger btn-xs btn-position">
                                Выбрать    
                                </button>
                            </form>
                        </td>
                    </tr>
                   
                    @endforeach  
                </table>    
                </div>
                <div class="panel-footer">
                    <ul class="pagination">
                    <input id = "input_page" type="hidden" value = "{{ $params->page}}" name="page"  class="form-control" form="my_form">    
                        <?php
                        $a = ceil($params->count/$params->limit);
                        /*
                        if($params->count<=10){
                            $a = 1;
                        }else{
                            if($params->count%$params->limit == 0){
                                $a = $params->count/$params->limit;
                            }else{
                                $a = $params->count%$params->limit;
                            }    
                        }
                         * 
                         */
                        ?>
                        @if ($params->count>=10)
                        @if ($params->page == 1)
                            <li class="disabled"><span>«</span></li> 
                        @else
                        <li><a  id ="{{$params->page-1}}" class="my_page" rel="next">«</a></li> 
                        @endif
                        @for ($i = 1; $i <= $a; $i++)            
                            @if ($params->page == $i)
                                <li class="active"><span>{{$i}}</span></li> 
                            @else
                                @if ($i >= $params->page-2  &&  $i <= $params->page+2)
                                    <li><a  id ="{{$i}}" class="my_page" >{{$i}}</a></li>  
                                @else
                                    @if ($i == 1)
                                        <li><a  id ="{{$i}}" class="my_page">{{$i}}</a></li>
                                        <li class="disabled"><span>...</span></li>
                                    @endif
                                    @if ($i == $a)
                                        <li class="disabled"><span>...</span></li>
                                        <li><a  id ="{{$i}}" class="my_page">{{$i}}</a></li>                
                                    @endif
                                    @continue  
                                @endif
                                
                            @endif
                        @endfor
                        @if ($params->page == $a)
                            <li class="disabled"><span>»</span></li> 
                        @else
                            <li><a  id ="{{$params->page+1}}" class="my_page" rel="next">»</a></li> 
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

