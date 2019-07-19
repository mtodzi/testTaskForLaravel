<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Workers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $durektor = Workers::where('id_worker',NULL)->first();
        if($durektor === NULL){            
           return view('home_none'); 
        }else{
            $deputyDerektors = Workers::where('id_worker',$durektor->id)->get();
            return view('home',['durektor'=>$durektor,'deputyDerektors'=>$deputyDerektors]);
        }
        
    }
    public function GetWorkers(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            $workers = Workers::where('id_worker',$request->id)->get();
            $chif = $durektor = Workers::where('id',$request->id)->first();
            if($workers->count() == 0){
                return response()->json(array('msg'=>"У ".$chif->surname." ".$chif->name." ".$chif->patronymic." нет подчененных." , 300));
            }else{
                return response()->json(array('msg'=> $this->getViewIndex($workers,$request->style), 200));
            }
            
        }else{
            return response()->json(array('msg'=> 'Ошибка на сервере что то пошло не так обновите страницу и повторите!!!', 0));
        }
    }
    
    public function getViewIndex($workers,$style)
    {
        $style = $style+30;
        $str = "";
        foreach ($workers as $worker){
            $str = $str.
                "<div id = '".$worker->id."' class='Chief-".$worker->id_worker."'>".    
                "<div class='row' style='margin-left: ".$style."px; ' id = 'row-worker-".$worker->id."'>".
                    "<form id = 'form-worker-".$worker->id."'>".
                        csrf_field().
                        "<input type='hidden' name='id' id='worker-id-".$worker->id."' value='".$worker->id."' class='form-control'>".
                        "<input type='hidden' name='style' id='style-".$worker->id."' value='".$style."' class='form-control'>".
                        "<input type='hidden' name='id_worker' id='id_worker-".$worker->id."' value='".$worker->id_worker."' class='form-control'>".
                        "<input type='hidden' name='position' id='position-".$worker->id."' value='0' class='form-control'>".
                    "</form>".
                    "<div class='col-sm-6 col-md-4 thumbnail workers' id = 'worker-".$worker->id."'>".
                        "<ul class='media-list'>".
                            "<li class='media'>".
                                "<a class='pull-left' href='#'>".
                                    "<img class='media-object' src='".$worker->getUrlFoto()."' alt='' width='100' height='100'>".
                                "</a>".
                                "<div class='media-body'>".
                                    "<h4 class='media-heading'>Личные данные</h4>".
                                        "<ul class='list-group'>".
                                            "<li class='list-group-item list-group-item-success'><strong>".$worker->surname." ".$worker->name." ".$worker->patronymic."</strong></li>".
                                            "<li class='list-group-item list-group-item-info'><strong>Зарплата</strong> - ".$worker->salary."</li>".
                                            "<li class='list-group-item list-group-item-warning'><strong>Должность</strong> - ".$worker->getPosition()."</li>".
                                            "<li class='list-group-item list-group-item-danger'><strong>Начальник</strong> - ".$worker->getChief()."</li>".
                                        "</ul>".
                                "</div>".
                            "</li>".
                        "</ul>".
                    "</div>".
                "</div>".
            "</div>";
            }
            return $str;
    }
    
    
}
