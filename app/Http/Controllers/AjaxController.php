<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ajax;
use Validator;

class AjaxController extends Controller
{   public function store(Request $request){
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'image' => 'required'
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'),$new_name);
        $form_data = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'image' => $request->image
        );
        Ajax::create($form_data);
        return response()->json(['success' => 'Successful']);
      }
    public function index(Request $request){
        if($request->ajax()){
            return datatables()->of(Ajax::latest()->get())
            ->addColumn('action', function($data){
                $button = '<button name="edit" type="button" id="'.$data->id.'" class="btn btn-danger">Delete</button>';
                $button .= '<button name="delete" type="button" id="'.$data->id.'" class="btn btn-danger">Edit</button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }

        return view('ajax-tut');
    }
}
