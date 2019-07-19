<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PositionRepository;
use App\Positions;

class PositionController extends Controller
{
    protected $positions;
    protected $serchPosition;

    public function __construct(PositionRepository $positions)
    {
        $this->middleware('auth');
        $this->positions = $positions;
        $this->serchPosition = new PositionRepository();
    }
    
    public function index(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            $params = $this->SetSerchPosition($request, $this->serchPosition);
            return view('position.index',['positions'=> $params->SearchPosition(), 'params'=>$params]);
        }

        return view('position.index',['positions'=> $this->positions->GetPositions(),'params'=>$this->serchPosition]);
    }
    
    public function View($id)            
    {
        $position = Positions::findOrFail($id);
        return view('position.view',['position'=>$position]);;
        
    }
    
    public function Create(Request $request)
    {
        $position = new Positions();
        if ($request->isMethod('post')) 
        {
            $this->validate($request, [
                'name_position' => 'required|max:100',
            ]);
            $position->name_position = $request->name_position;
            $position->description_position = $request->description_position;
            $position->save();
            return redirect('/positions');
        }
        return view('position.create',['position'=>$position]);
    }
    
    public function Update(Request $request,$id){
        $position = Positions::findOrFail($id);
        
        if ($request->isMethod('post')) 
        {
            $this->validate($request, [
                'name_position' => 'required|max:100',
            ]);
            $position->name_position = $request->name_position;
            $position->description_position = $request->description_position;
            $position->save();
            return redirect('/positions');
        }
        
        return view('position.update',['position'=>$position]);
    }
    
    public function destroy(Request $request, $id)
    {
      $position = Positions::findOrFail($id);
      $position->delete();
      return redirect('/positions'); 
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
