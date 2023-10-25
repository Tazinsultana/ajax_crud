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

    public function Editlist(Request $request){
     $todo=Todolist::findOrFail($request->id);
     return response()->json([

        'status'=> 'success',
        'data'=>$todo,
     ]);



    }

    // update/edit
    public function updatelist(Request $request){
        // dd($request->all());
        $request->validate(
            [
                'title' => 'required|unique:todolists,title' .$request->up_id,

            ],
            [
                'title.required' => 'Title is requried',
                'title.unique' => 'Already Exists'
            ]
        );

        // $title = $request->up_title;
        // $active = $request->up_is_active ? true : false;
        $title=$request->title;
         $active=$request->is_active == "true"? true:false;
         Todolist::findOrFail($request->id)->update([

            'title'=>$title,
            'is_active'=>$active
        ]);


        return response()->json([
            'status' => 'success',

        ]);
    }

    // for delete
    public function deletelist(Request $request){

        Todolist::find($request->del_id)->delete();
        return response()->json([
            'status' => 'success',

        ]);
    }
    public function SearchList(Request $request ){
        $todo= Todolist::where('title','like','%'.$request->search.'%')
        ->orderBy('id','desc')->get();


            return response()->json([
               'data'=>$todo,
            ]);


    }

}
