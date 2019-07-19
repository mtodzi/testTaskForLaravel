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
                    <h4>Должность</h4>
                    
                </div>
                <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success">Название должности - {{$position->name_position}}</li>
                    <li class="list-group-item list-group-item-info">
                        Описание должности:</br>
                        {{$position->description_position}}
                    </li>
                    <li class="list-group-item list-group-item-warning">Дата добавления - {{ date("d.m.Y",strtotime($position->created_at))  }}</li>
                    <li class="list-group-item list-group-item-danger">Дата обновления - {{ date("d.m.Y",strtotime($position->updated_at))  }}</li>
                </ul>
                </div>
                <div class="panel-footer">
                    <a href="{{ url('/positions') }}" class="btn btn-success">Вернуться</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

