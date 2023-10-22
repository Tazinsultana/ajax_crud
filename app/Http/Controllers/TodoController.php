<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todolist;

class TodoController extends Controller
{
    public function index()
    {
        $todo = Todolist::latest()->get();

        return view('index', compact('todo'));
    }

    // create
    public function addlist(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|unique:todolists',

            ],
            [
                'title.required' => 'Title is requried',
                'title.unique' => 'Already Exists'
            ]
        );
        //  $todo = new Todolist();
        //  $todo->title=$request->title;
        //  $todo->is_active=$request->is_active ? true:false;
        $title = $request->title;
        $active = $request->is_active == "true" ? true : false;
        // dd($active);
        Todolist::create([
            'title' => $title,
            'is_active' => $active

        ]);

        //  $todo->save();
        return response()->json([
            'status' => 'success',

        ]);

    }

    // update/edit
    public function updatelist(Request $request,Todolist $todo){
        
        $request->validate(
            [
                'up_title' => 'required|unique:todolists,title' .$request->up_id,

            ],
            [
                'up_title.required' => 'Title is requried',
                'up_title.unique' => 'Already Exists'
            ]
        );

        // $title = $request->up_title;
        // $active = $request->up_is_activec" ? true : false;
        $title=$request->up_title;
        $active=$request->up_is_active == "true"? true:false;
        
        $todo->update([
            'title'=>$title,
            'is_active'=>$active
        ]);
        
// Todolist::where('id',$request->up_id)->update([

//     // 'title' => $title,
//     // 'is_active' => $active
//     'title'=>$request->up_title,
//     'is_active'=>$request->up_is_active=="true" ? true : false,
// ]);
        return response()->json([
            'status' => 'success',

        ]);



    }
}