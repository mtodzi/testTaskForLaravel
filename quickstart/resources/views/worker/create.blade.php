<!-- resources/views/tasks/index.blade.php -->
<?php
//print_r($position);   
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Добавить данные работника шаг - 1</h4></div>
                <div class="panel-body">
                    @include('common.errors')
                    <form id="my_form" action="{{ url('/newworkers') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <div class="row">
                        <label for="worker" class="col-sm-3 control-label">Фамилия</label>
                        <div class="col-sm-6">
                            <input type="text" name="surname" id="worker-surname" class="form-control">
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <label for="worker" class="col-sm-3 control-label">Имя</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="worker-name" class="form-control">
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <label for="worker" class="col-sm-3 control-label">Отчество</label>
                        <div class="col-sm-6">
                            <input type="text" name="patronymic" id="worker-patronymic" class="form-control">
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <label for="worker" class="col-sm-3 control-label">Зарплата</label>
                        <div class="col-sm-6">
                            <input type="text" name="salary" id="worker-salary" class="form-control">
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <label for="worker" class="col-sm-3 control-label">Дата приема на работу</label>
                        <div class="col-sm-6">
                            <input type="text" name="date_receipt" id="worker-date_receipt" class="form-control date">
                            <input type="hidden" name="step" id="step" value="{{$step}}" class="form-control date">
                        </div>
                        </div>
                    </div> 
                    </form>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success" form="my_form">
                    Добавить
                </button>
                <a href="{{ url('/workers') }}" class="btn btn-success">Вернуться</a>    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

