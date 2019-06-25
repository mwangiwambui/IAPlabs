<?php

namespace App\Http\Controllers;

use App\Cars;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function allcars(){
        $cars = Cars::all();
        return view('allcars',['cars'=> $cars]);
    }
    public function newcar(Request $request){
        $this->validate($request,[
            'make' => 'required|unique:cars',
            'model' => 'required',
            'date' => 'required'
        ]);
        $car = new Cars();
        $car->make = $request->make;
        $car->model = $request->model;
        $car->product_on = $request->date;

        $car->save();
        return back();
    }

    public function particularcar($id){
        $car = Cars::find($id);
        return $car->reviews;

    }

}
