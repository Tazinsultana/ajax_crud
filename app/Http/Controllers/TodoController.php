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
}