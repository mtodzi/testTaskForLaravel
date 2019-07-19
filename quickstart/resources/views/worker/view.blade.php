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
                    <h4>Работник</h4>
                    
                </div>
                <div class="panel-body">
                <img src="{{$worker->getUrlFoto()}}" width="150" height="150" class="img-thumbnail">
                <br>
                <br>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success">Фамилия - {{$worker->surname}}</li>
                    <li class="list-group-item list-group-item-success">Имя - {{$worker->name}}</li>
                    <li class="list-group-item list-group-item-success">Отчество - {{$worker->patronymic}}</li>
                    <li class="list-group-item list-group-item-success">Зарплата - {{$worker->salary}}</li>
                    <li class="list-group-item list-group-item-success">Должность - {{empty($worker->id_position)?'Нет':$worker->position->name_position}}</li>
                    <li class="list-group-item list-group-item-success">Начальник - {{empty($worker->id_worker)?'Не назначен':$worker->worker->surname." ".$worker->worker->name." ".$worker->worker->patronymic}}</li>
                    <li class="list-group-item list-group-item-warning">Дата приема на работу  - {{ date("d.m.Y",strtotime($worker->date_receipt))  }}</li>
                    <li class="list-group-item list-group-item-warning">Дата добавления - {{ date("d.m.Y",strtotime($worker->created_at))  }}</li>
                    <li class="list-group-item list-group-item-warning">Дата обновления - {{ date("d.m.Y",strtotime($worker->updated_at))  }}</li>
                </ul>
                </div>
                <div class="panel-footer">
                    <a href="{{ url('/workers') }}" class="btn btn-success">Вернуться</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

