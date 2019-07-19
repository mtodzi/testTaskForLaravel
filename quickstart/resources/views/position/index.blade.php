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
                <div class="row">
                    <div class="col-md-8" style="padding-bottom: 5px;">
                        <a href="{{ url('/newposition') }}" class="btn btn-success">Добавить</a>    
                    </div>
                </div>
                <form  id="my_form" action="{{ url('positions') }}" method="POST"> {{ csrf_field() }}</form>
                <table class="table table-striped">
                    <tr>
                        <th>
                            <a id = "order_position_name" class="order">Название должности</a>
                            <span id = "span_order_position_name" class="{{$params->getGlifkon('order_position_name')}}"></span>
                            <input id = "input_order_position_name" type="hidden" value = "{{ $params->order_position_name}}" name="order_position_name" class="form-control" form="my_form">
                        </th> 
                        <th>Описание должности</th>
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
                            <span>Поиск по названию должности</span>
                            <input type="text" value = "{{ $params->name_position }}" name="name_position" id="position-position_name" class="form-control" form="my_form">                     
                        </div>
                        </td>
                        <td></td>
                        <td>                             
                        <div class="input-group">
                            <span>Поиск по дате добавления</span>
                            <input type="text" value = "{{ $params->created_at }}" name="created_at" id="position-created_at" class="form-control date" form="my_form">                     
                        </div>
                        </td>
                        <td>
                        <div class="input-group">
                            <span>Поиск по дате обновления</span>
                            <input type="text" value = "{{ $params->updated_at }}" name="updated_at" id="position-created_at" class="form-control date" form="my_form">                     
                            <input type="submit" title="" form="my_form" style="display: none;">
                        </div>
                        </td>
                        <td></td>
                    </tr>
                    @foreach ($positions as $position)
                    <tr>
                        <td>{{ $position->name_position  }}</td>
                        <td>{{ $position->description_position  }}</td>
                        <td>{{ date("d.m.Y",strtotime($position->created_at))  }}</td>
                        <td>{{ date("d.m.Y",strtotime($position->updated_at))  }}</td>
                        <td>
                            <a href="{{ url('/position/'.$position->id) }}" class="btn btn-primary btn-xs btn-position">Просмотр</a>
                            <a href="{{ url('/updatposition/'.$position->id) }}" class="btn btn-warning btn-xs btn-position">Обновить</a>
                            <form action="{{ url('position/'.$position->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" id="delete-position-{{ $position->id }}" class="btn btn-danger btn-xs btn-position">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                   
                    @endforeach  
                </table>    
                </div>
                <div class="panel-footer">
                    {{ $positions->links() }}    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

