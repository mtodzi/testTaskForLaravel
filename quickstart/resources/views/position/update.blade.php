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
                <div class="panel-heading"><h4>Обновить должность</h4></div>
                <div class="panel-body">
                    @include('common.errors')
                    <form id="my_form" action="{{ url('/updatposition/'.$position->id) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <div class="row">
                        <label for="position" class="col-sm-3 control-label">Название должности</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$position->name_position}}" name="name_position" id="position-name_position" class="form-control">
                        </div>
                        </div>
                        <div class="row">
                        <label for="position" class="col-sm-3 control-label">Описание должности</label>
                        <div class="col-sm-6">
                            <textarea name="description_position" id="position-description_position" class="form-control">{{$position->description_position}}</textarea>
                        </div>
                        </div>
                    </div>                    
                    </form>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-warning" form="my_form">
                        Обновить
                    </button>
                <a href="{{ url('/positions') }}" class="btn btn-success">Вернуться</a>    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

