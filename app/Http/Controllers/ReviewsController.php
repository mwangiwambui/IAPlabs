<?php

namespace App\Http\Controllers;

use App\Cars;
use App\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{


    public function review(Cars $car){

        $reviews = Reviews::all()->where('car_id',$car->id);
        return view('reviews', compact('car','reviews'));

    }
    public function store(Request $request){

        $review= new Reviews();
        $review->review = $request->review;
        $review->car_id = $request->carid;


        $review->save();

        return back();

    }
    public function allreviews(){
        $reviews = Reviews::all();

        return view('allreviews',compact('reviews'));
    }
    public function car(Reviews $review){

        $car = Cars::all()->where('car_id',$review->car_id)->first();
        return view('car', compact('car','review'));
        

    }
}
