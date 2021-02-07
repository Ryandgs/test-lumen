<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use Illuminate\Http\Request;

class DroneController extends Controller
{
    public $drone;
    
    public $rules = [
        'image' => 'required',
        'name'  => 'required|max:255',
        'status'  => 'required|in:success,failed',
        'address' => 'required|max:255',
        'battery' => 'required|numeric|between:0,100',
        'max_speed' => 'required|numeric',
        'average_speed' => 'required|numeric'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        return $this->drone = new Drone;
    }

    public function List()
    {
        return $this->drone::all();
    }

    public function Insert(Request $request)
    {
        $this->validate($request, $this->rules);

        return $this->drone::create($request->all());
    }

    public function Update(Request $request, $id)
    {
        $this->validate($request, $this->rules);

        $drone = $this->drone->find($id);

        return $drone->update($request->all());
    }

    public function Delete($id)
    { 
        $drone = $this->drone::find($id);

        if ($drone) { 
            return $drone->delete();
        } else { 
            return 'Drone não encontrado';
        }
    }

    public function Paginate($limit)
    {
        return $this->drone::paginate($limit);
    }

    public function Sort($field, $order)
    { 
        return $this->drone::orderBy($field, $order)->get();
    }

    public function Filter($name, $status)
    { 
        return $this->drone::where('name', 'like', '%'.$name.'%')
            ->where('status', $status)
            ->get();
    }
}
