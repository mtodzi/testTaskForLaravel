<?php
    use App\Positions;
    use App\Workers;
    
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Персонал</h4></div>

                <div class="panel-body" id = "panel-body">
                	Двойным щелчком по карточке отображаются карточки подчиненных работников, повторный двойной щелчок их закрывает. 
                    <div id = "{{$durektor->id}}" class="Chief-0">
                    <div class="row"  style="margin-left: 0px;" id = "row-worker-{{$durektor->id}}">
                        <form id = "form-worker-{{$durektor->id}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="worker-id-{{$durektor->id}}" value="{{$durektor->id}}" class="form-control">
                            <input type="hidden" name="style" id="style-{{$durektor->id}}" value="0" class="form-control">
                            <input type="hidden" name="id_worker" id="id_worker-{{$durektor->id}}" value="{{$durektor->id_worker}}" class="form-control">
                            <input type="hidden" name="position" id="position-{{$durektor->id}}" value="1" class="form-control"> 
                        </form>
                        <div class="col-sm-6 col-md-4 thumbnail workers" id = "worker-{{$durektor->id}}">
                            <ul class="media-list">
                                <li class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="<?=$durektor->getUrlFoto()?>" alt="..." width="100" height="100">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">Личные данные</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item list-group-item-success"><strong>{{$durektor->surname}} {{$durektor->name}} {{$durektor->patronymic}}</strong></li>
                                            <li class="list-group-item list-group-item-info"><strong>Зарплата</strong> - {{$durektor->salary}}</li>
                                            <li class="list-group-item list-group-item-warning"><strong>Должность</strong> - {{$durektor->getPosition()}}</li>
                                            <li class="list-group-item list-group-item-danger"><strong>Начальник</strong> - {{$durektor->getChief()}}</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>    
                    </div>                        
                    @foreach ($deputyDerektors as $deputyDerektor)
                    <div id = "{{$deputyDerektor->id}}" class="Chief-{{$durektor->id}}">
                        <div class="row"  style="margin-left: 30px;" id = "row-worker-{{$deputyDerektor->id}}">
                            <form id = "form-worker-{{$deputyDerektor->id}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="worker-id-{{$deputyDerektor->id}}" value="{{$deputyDerektor->id}}" class="form-control">
                                <input type="hidden" name="style" id="style-{{$deputyDerektor->id}}" value="30" class="form-control">
                                <input type="hidden" name="id_worker" id="id_worker-{{$deputyDerektor->id}}" value="{{$deputyDerektor->id_worker}}" class="form-control">
                                <input type="hidden" name="position" id="position-{{$deputyDerektor->id}}" value="0" class="form-control">
                            </form>
                            <div class="col-sm-6 col-md-4 thumbnail workers" id = "worker-{{$deputyDerektor->id}}">
                                <ul class="media-list">
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="<?=$deputyDerektor->getUrlFoto()?>" alt="..." width="100" height="100">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">Личные данные</h4>
                                            <ul class="list-group">
                                                <li class="list-group-item list-group-item-success"><strong>{{$deputyDerektor->surname}} {{$deputyDerektor->name}} {{$deputyDerektor->patronymic}}</strong></li>
                                                <li class="list-group-item list-group-item-info"><strong>Зарплата</strong> - {{$deputyDerektor->salary}}</li>
                                                <li class="list-group-item list-group-item-warning"><strong>Должность</strong> - {{$deputyDerektor->getPosition()}}</li>
                                                <li class="list-group-item list-group-item-danger"><strong>Начальник</strong> - {{$deputyDerektor->getChief()}}</li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>    
                        </div>
                    </div>    
                    @endforeach
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php 
                    //committed(NULL);
                    function committed($id_chief){
                        $i = 0;
                        $workers = Workers::where('id_worker',$id_chief)->get();
                        if(!empty($workers)){
                            foreach ($workers as $worker){
                                if($i==4){
                                    break;
                                }
                                echo"<ul style= 'border-left: 2px dotted green;'>";
                                echo "<li><strong>ФИО</strong> - ".$worker->surname." ".$worker->name." ".$worker->patronymic." <strong>Должность</strong>:".(empty($worker->id_position)?'нет':$worker->position->name_position)." <strong>Зарплата</strong> - ".$worker->salary;
                                if($worker->id_worker === NULL){
                                    echo " <strong>Руководитель</strong> - не задан";  
                                }else{
                                    echo " <strong>Руководитель</strong> - ".$worker->worker->surname;
                                }
                                echo"</li>";
                                committed($worker->id);
                                echo"</ul>";
                            }
                        }                                       
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
