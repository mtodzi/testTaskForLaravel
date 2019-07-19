<!-- resources/views/tasks/index.blade.php -->
<?php
   
?>
@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Должности</h4>            
                </div>
                <div class="panel-body">
                <ul class='list-group' id='ul-error' style="display: none;">    
                    <li id='li-error' class='list-group-item list-group-item-success'>Ошибка</li>        
                </ul>    
                <div class="row">
                    <div class="col-md-8" style="padding-bottom: 5px;">
                        <a class="btn btn-success" id = 'newposition'>Добавить</a>    
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">    
                        <div class="panel panel-default" id="new_position" style="display: none;">
                            <div class="panel-heading"><h4>Добавить должность</h4></div>
                            <div class="panel-body">                            
                                <form id="my_form_ajax_newPosition"   class="form-horizontal">
                                    {{ csrf_field() }}                    
                                    <div class="form-group">
                                    <div class="row">
                                        <label for="position" class="col-sm-3 control-label">Название должности</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name_position" id="newposition-name_position" class="form-control">
                                    </div>
                                    </div>    
                                        <div class="row" id="error_name_position" style="display: none; margin: 5px 0px; ">
                                        <div class="col-md-12">    
                                            <ul class="list-group">    
                                                <li id="li_error_name_position" class="list-group-item list-group-item-danger">Ошибка</li>        
                                            </ul>
                                        </div>    
                                    </div>
                                   
                                    <div class="row">
                                        <label for="position" class="col-sm-3 control-label">Описание должности</label>
                                    <div class="col-sm-6">
                                        <textarea name="description_position" id="newposition-description_position" class="form-control"></textarea>
                                    </div>
                                    </div>
                                    </div>                    
                                </form>
                            </div>
                            <div class="panel-footer">
                                <button id="btn_newpas" type="submit" class="btn btn-success" form="my_form_ajax_newPosition">
                                    Добавить
                                </button>
                                <a id="btn_back" class="btn btn-success">Вернуться</a>    
                            </div>
                        </div>
                    </div>    
                </div>
                <form  id="my_form_ajax"  method="POST"> {{ csrf_field() }}</form>
                <table class="table table_position table-striped">
                    <tr>
                        <th>
                            <a id = "order_position_name" class="order_ajax">Название должности</a>
                            <span id = "span_order_position_name" class="{{$params->getGlifkon('order_position_name')}}"></span>
                            <input id = "input_order_position_name" type="hidden" value = "{{ $params->order_position_name}}" name="order_position_name" class="form-control" form="my_form_ajax">
                        </th> 
                        <th>Описание должности</th>
                        <th>
                            <a id = "order_created_at" class="order_ajax">Добавили</a>
                            <span id = "span_order_created_at" class="{{$params->getGlifkon('order_created_at')}}"></span>
                            <input id = "input_order_created_at" type="hidden" value = "{{ $params->order_created_at}}" name="order_created_at"  class="form-control" form="my_form_ajax">
                        </th>
                        <th>
                            <a id = "order_updated_at" class="order_ajax">Обновили</a>
                            <span id = "span_order_updated_at" class="{{$params->getGlifkon('order_updated_at')}}"></span>
                            <input id = "input_order_updated_at" type="hidden" value = "{{ $params->order_updated_at}}" name="order_updated_at"  class="form-control" form="my_form_ajax">
                        </th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>    
                        <div class="input-group">  
                            <span>Поиск по названию должности</span>
                            <input type="text" value = "{{ $params->name_position }}" name="name_position" id="position-position_name" class="form-control" form="my_form_ajax">                     
                        </div>
                        </td>
                        <td></td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по дате добавления</span>
                            <input type="text" value = "{{ $params->created_at }}" name="created_at" id="position-created_at" class="form-control date" form="my_form_ajax">                     
                        </div>
                        </td>
                        <td>
                        <div class="input-group">
                            <span>Поиск по дате обновления</span>
                            <input type="text" value = "{{ $params->updated_at }}" name="updated_at" id="position-created_at" class="form-control date" form="my_form_ajax">                     
                            <input type="submit" id="btn"  title="" form="my_form_ajax" style="display: none;">
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
                            <form id='my_form_ajax_delete_position-{{$position->id}}'>
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type='hidden' value='{{$position->id}}' name='id' id='input-position-id-{{$position->id}}' class='form-control'>
                                <button type="submit" id="delete-position-{{ $position->id }}" class="btn btn-danger btn-xs btn-position btn-delete">
                                    Удалить
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
                <div class="panel-footer">
                    <ul class="pagination pagination_position">
                    <input id = "input_page_ajax" type="hidden" value = "{{ $params->page}}" name="page"  class="form-control" form="my_form_ajax">    
                        <?php
                        $a = ceil($params->count/$params->limit);
                        ?>
                        @if ($a>1)
                        @if ($params->page == 1)
                            <li class="disabled"><span>«</span></li> 
                        @else
                        <li><a  id ="{{$params->page-1}}" class="my_page_ajax" rel="next">«</a></li> 
                        @endif
                        @for ($i = 1; $i <= $a; $i++)            
                            @if ($params->page == $i)
                                <li class="active"><span>{{$i}}</span></li> 
                            @else
                                @if ($i >= $params->page-2  &&  $i <= $params->page+2)
                                    <li><a  id ="{{$i}}" class="my_page_ajax" >{{$i}}</a></li>  
                                @else
                                    @if ($i == 1)
                                        <li><a  id ="{{$i}}" class="my_page_ajax">{{$i}}</a></li>
                                        <li class="disabled"><span>...</span></li>
                                    @endif
                                    @if ($i == $a)
                                        <li class="disabled"><span>...</span></li>
                                        <li><a  id ="{{$i}}" class="my_page_ajax">{{$i}}</a></li>                
                                    @endif
                                    @continue  
                                @endif
                                
                            @endif
                        @endfor
                        @if ($params->page == $a)
                            <li class="disabled"><span>»</span></li> 
                        @else
                            <li><a  id ="{{$params->page+1}}" class="my_page_ajax" rel="next">»</a></li> 
                        @endif
                        @endif
                    </ul>    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

