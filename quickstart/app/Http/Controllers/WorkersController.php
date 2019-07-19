<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\WorkersRepository;
use App\Repositories\PositionRepository;
use Illuminate\Support\Facades\Storage;
use App\Workers;

class WorkersController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
    
   }
   
   public function index(Request $request)           
   {
        $modelSerch = new WorkersRepository();
       
        if ($request->isMethod('post')) 
        {
            $params = $this->SetSerchWorkers($request, $modelSerch);
            return view('worker.index',['workers'=> $params->SearchPosition(), 'params'=>$params]);
        }

        return view('worker.index',['workers'=>$modelSerch->GetWorkers(), 'params'=>$modelSerch]);
   }
   
   public function View($id)            
    {
        $worker = Workers::findOrFail($id);
        return view('worker.view',['worker'=>$worker]);;
        
    }
   
   public function Create(Request $request)
    {
        $worker = new Workers();
        if ($request->isMethod('post')) 
        {
            if(!empty($request->step))
            {
                $step = $request->step; 
            }else{
                $step = 1;
            }
            switch ($step){
                case 1:
                    $this->validate($request, [
                        'surname' => 'required|max:100',
                        'name' => 'required|max:100',
                        'patronymic' => 'required|max:100',
                        'salary' => 'required|numeric',
                        'date_receipt' => 'required|date',          
                    ]);
                    $worker->surname = $request->surname;
                    $worker->name = $request->name;
                    $worker->patronymic = $request->patronymic;
                    $worker->date_receipt = date("Y-m-d",strtotime($request->date_receipt));
                    $worker->salary = $request->salary;
                    $worker->id_position = NULL;
                    $worker->id_worker = NULL;
                    $worker->save();
                    $PositionRepository = new PositionRepository();
                    $positions = $PositionRepository->GetPositions();
                    $params = $PositionRepository;
                    return view('worker.createposition',
                            [
                                'worker'=>$worker, 
                                'step' => 2,
                                'positions' => $positions,
                                'params' => $params
                            ]);
                    break;
                case 2:
                    $worker = Workers::findOrFail($request->worker);
                    $PositionRepository = new PositionRepository();
                    $params = $this->SetSerchPosition($request, $PositionRepository);
                    $positions = $params->SearchPosition();
                    return view('worker.createposition',
                            [
                                'worker'=>$worker, 
                                'step' => 2,
                                'positions' => $positions,
                                'params' => $params
                            ]);
                    break;
                case 3:
                    $worker = Workers::findOrFail($request->worker);
                    if(!empty($request->position_id)){                        
                        $worker->id_position = $request->position_id;
                        $worker->save();
                        $WorkersRepository = new WorkersRepository();
                        $workers = $WorkersRepository->GetWorkers();
                        $params = $WorkersRepository;
                        return view('worker.createchef',
                            [
                                'worker_id'=>$worker->id, 
                                'step' => 4,
                                'workers' => $workers,
                                'params' => $params
                            ]);
                    }else{
                        $WorkersRepository = new WorkersRepository();
                        $workers = $WorkersRepository->GetWorkers();
                        $params = $WorkersRepository;
                        return view('worker.createchef',
                            [
                                'worker_id'=>$worker->id, 
                                'step' => 4,
                                'workers' => $workers,
                                'params' => $params
                            ]);
                    }
                    break;
                case 4:
                    $worker = Workers::findOrFail($request->worker_id);
                    $WorkersRepository = new WorkersRepository();
                    $params = $this->SetSerchWorkers($request, $WorkersRepository);
                    $workers = $params->SearchPosition();
                    return view('worker.createchef',
                            [
                                'worker_id'=>$worker->id, 
                                'step' => 4,
                                'workers' => $workers,
                                'params' => $params
                            ]);
                    break;
                case 5:
                    if(!empty($request->worker)){
                        $worker = Workers::findOrFail($request->worker_id);
                        $chef = Workers::findOrFail($request->worker);
                        $worker->id_worker = $chef->id;
                        $worker->save();
                        return redirect('/worker/'.$worker->id);
                    }else{
                        $worker = Workers::findOrFail($request->worker_id);
                        return redirect('/worker/'.$worker->id);
                    }
                    break;
                
            }
            
        }
        return view('worker.create',['worker'=>$worker, 'step' => 1]);
    }
    
    public function Update(Request $request,$id){
        $worker = Workers::findOrFail($id);
        
        if ($request->isMethod('post')) 
        {
            if(!empty($request->step))
            {
                $step = $request->step; 
            }else{
                $step = 1;
            }
            switch ($step){
                case 1:
                    $this->validate($request, [
                        'surname' => 'required|max:100',
                        'name' => 'required|max:100',
                        'patronymic' => 'required|max:100',
                        'salary' => 'required|numeric',
                        'date_receipt' => 'required|date',          
                    ]);
                    $worker->surname = $request->surname;
                    $worker->name = $request->name;
                    $worker->patronymic = $request->patronymic;
                    $worker->date_receipt = date("Y-m-d",strtotime($request->date_receipt));
                    $worker->salary = $request->salary;
                    $worker->save();
                    $PositionRepository = new PositionRepository();
                    $positions = $PositionRepository->GetPositions();
                    $params = $PositionRepository;
                    return view('worker.updateposition',
                            [
                                'worker'=>$worker, 
                                'step' => 2,
                                'positions' => $positions,
                                'params' => $params
                            ]);
                    break;
                case 2:
                    $worker = Workers::findOrFail($request->worker);
                    $PositionRepository = new PositionRepository();
                    $params = $this->SetSerchPosition($request, $PositionRepository);
                    $positions = $params->SearchPosition();
                    return view('worker.updateposition',
                            [
                                'worker'=>$worker, 
                                'step' => 2,
                                'positions' => $positions,
                                'params' => $params
                            ]);
                    break;
                 case 3:
                    $worker = Workers::findOrFail($request->worker);
                    if(!empty($request->position_id)){                        
                        $worker->id_position = $request->position_id;
                        $worker->save();
                        $WorkersRepository = new WorkersRepository();
                        $workers = $WorkersRepository->GetWorkers();
                        $params = $WorkersRepository;
                        return view('worker.updatechef',
                            [
                                'worker_id'=>$worker->id, 
                                'step' => 4,
                                'workers' => $workers,
                                'params' => $params
                            ]);
                    }else{
                        $WorkersRepository = new WorkersRepository();
                        $workers = $WorkersRepository->GetWorkers();
                        $params = $WorkersRepository;
                        return view('worker.updatechef',
                            [
                                'worker_id'=>$worker->id, 
                                'step' => 4,
                                'workers' => $workers,
                                'params' => $params
                            ]);
                    }
                    break;
                case 4:
                    $worker = Workers::findOrFail($request->worker_id);
                    $WorkersRepository = new WorkersRepository();
                    $params = $this->SetSerchWorkers($request, $WorkersRepository);
                    $workers = $params->SearchPosition();
                    return view('worker.updatechef',
                            [
                                'worker_id'=>$worker->id, 
                                'step' => 4,
                                'workers' => $workers,
                                'params' => $params
                            ]);
                    break;
                case 5:
                    if(!empty($request->worker)){
                        $worker = Workers::findOrFail($request->worker_id);
                        $chef = Workers::findOrFail($request->worker);
                        $worker->id_worker = $chef->id;
                        $worker->save();
                        return redirect('/worker/'.$worker->id);
                    }else{
                        $worker = Workers::findOrFail($request->worker_id);
                        return redirect('/worker/'.$worker->id);
                    }
                    break;
            }    
        }
        
        return view('worker.update',['worker'=> $worker, 'step'=>1]);
    }
    
    public function UpdatePhoto(Request $request,$id){
        $worker = Workers::findOrFail($id);
        if ($request->isMethod('post')) 
        {   
            $file = $request->file('file');
            $f = Storage::disk('local');
            $exists = $f->files('public/foto/'.$worker->id);//file('/public/storage/foto/'.$this->id);
            if(!empty($exists)){
                $exists =  explode("/", $exists[0]);
                $f->delete("public/foto/".$worker->id."/".$exists[3]);
                $f->makeDirectory('public/foto/'.$worker->id);
                $f->putFile('public/foto/'.$worker->id.'/', $file);
                return redirect('/updateworkersphoto/'.$worker->id);
            }else{
                $f->makeDirectory('public/foto/'.$worker->id);
                $f->putFile('public/foto/'.$worker->id.'/', $file);
                return redirect('/updateworkersphoto/'.$worker->id);
            }
        }else{
            return view('worker.updatephoto', ['worker'=>$worker]);
        }
        
    }
    
    public function DeletePhoto($id){
        $worker = Workers::findOrFail($id);
        $f = Storage::disk('local');
        //$exists  = Storage::files('/public/storage/foto/'.$this->id);;
        $exists = $f->files('public/foto/'.$worker->id);//file('/public/storage/foto/'.$this->id);
        if(!empty($exists)){
            $exists =  explode("/", $exists[0]);
            $f->delete("public/foto/".$worker->id."/".$exists[3]);
            
            return redirect('/updateworkersphoto/'.$worker->id);
            //return view('worker.errors', ['exists'=>$exists]);
        }else{
            return redirect('/updateworkersphoto/'.$worker->id);
        }
        
    }

    public function destroy(Request $request, $id)
    {
      $worker = Workers::findOrFail($id);
      $f = Storage::disk('local');
      $exists = $f->files('public/foto/'.$worker->id);//file('/public/storage/foto/'.$this->id);
      if(!empty($exists)){
            $exists =  explode("/", $exists[0]);
            $f->delete("public/foto/".$worker->id."/".$exists[3]);
            $f->deleteDirectory("public/foto/".$worker->id);
      }
      $worker->delete();
      return redirect('/workers'); 
    }
   
    private function SetSerchWorkers(Request $request, WorkersRepository $workers){
        
        if(!empty($request->surname))
        {
           $workers->surname = $request->surname; 
        }
        if(!empty($request->name))
        {
           $workers->name = $request->name; 
        }
        if(!empty($request->patronymic))
        {
           $workers->patronymic = $request->patronymic; 
        }
        if(!empty($request->salary))
        {
           $workers->salary = $request->salary; 
        }
        if(!empty($request->date_receipt))
        {
           $workers->date_receipt = $request->date_receipt; 
        }
        if(!empty($request->name_position))
        {
           $workers->name_position = $request->name_position; 
        }
        if(!empty($request->chief))
        {
           $workers->chief = $request->chief; 
        }
        if(!empty($request->created_at)){
            $workers->created_at = $request->created_at;
        }
        if(!empty($request->updated_at)){
            $workers->updated_at = $request->updated_at;
        }
        if(!empty($request->order_surname)){
            $workers->order_surname = $request->order_surname;
        }
        if(!empty($request->order_name)){
            $workers->order_name = $request->order_name;
        }
        if(!empty($request->order_patronymic)){
            $workers->order_patronymic = $request->order_patronymic;
        }
        if(!empty($request->order_salary)){
            $workers->order_salary = $request->order_salary;
        }
        
        if(!empty($request->order_date_receipt)){
            $workers->order_date_receipt = $request->order_date_receipt;
        }
        if(!empty($request->order_name_position)){
            $workers->order_name_position = $request->order_name_position;
        }
        if(!empty($request->order_chief)){
            $workers->order_chief = $request->order_chief;
        }
        if(!empty($request->order_created_at)){
            $workers->order_created_at = $request->order_created_at;
        }
        if(!empty($request->order_updated_at)){
            $workers->order_updated_at = $request->order_updated_at;
        }
        if(!empty($request->page)){
            $workers->page = $request->page;
        }
        
        return $workers;        
    }


    private function SetSerchPosition(Request $request, PositionRepository $positions){
        
        if(!empty($request->name_position))
        {
           $positions->name_position = $request->name_position; 
        }
        if(!empty($request->created_at)){
            $positions->created_at = $request->created_at;
        }
        if(!empty($request->updated_at)){
            $positions->updated_at = $request->updated_at;
        }
        if(!empty($request->order_position_name)){
            $positions->order_position_name = $request->order_position_name;
        }
        if(!empty($request->order_created_at)){
            $positions->order_created_at = $request->order_created_at;
        }
        if(!empty($request->order_updated_at)){
            $positions->order_updated_at = $request->order_updated_at;
        }
        
        return $positions;        
    }
}