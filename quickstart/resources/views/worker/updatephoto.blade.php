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
                <div class="panel-heading"><h4>Обновить фото</h4></div>
                <div class="panel-body">
                    <form enctype="multipart/form-data" action="{{url('/updateworkersphoto/'.$worker->id)}}" method="POST">
                        {{ csrf_field() }}
                        <img id="img_photo" src="{{$worker->getUrlFoto()}}" style="display: none; width: 100px; height: 100px;">
                        <div class="file-loading">
                            <input id="file-fr" name="file" type="file" multiple>
                        </div>
                    </form>                    
                </div> 
                <div class="panel-footer">       
                    <a href="{{ url('/workers') }}" class="btn btn-success">Вернуться</a>
                    <a href="{{ url('/deleteworkersphoto/'.$worker->id) }}" class="btn btn-danger">Удалить фото</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    
</script> 
@endsection

