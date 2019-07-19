<!-- resources/views/tasks/index.blade.php -->
<?php
//print_r($position);   
?>
@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Ошибка</h4></div>
                <div class="panel-body">
                    <div class="alert alert-danger">
                        {{$id}}
                    </div>
                </div>
                <div class="panel-footer"> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

