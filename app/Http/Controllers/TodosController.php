<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    //

    public function index(){

        //fetch all to-dos and display in page with Todo:all

        //$todos = Todo::all()->with('todos', Todo::all());
        return view('todos.index')->with('todos', Todo::all());
    }

    //---Type Hint is instead of always use Todo::find
    //---instead we pass the param Todo $todo
    public function show(Todo $todo){
        //---dd() -> die and dump
        //$todo = Todo::find($todoId);

        return view('todos.show')->with('todo', $todo);
    }

    public function create(){
        return view('todos.create');
    }

    //---Save the todo captured in forms
    public function store(){
        //dd(request());
        //---validate comes from ValidateRequest trait
        $this->validate(request(), [
            'name' => 'required|min:6|max:12',
            'description' => 'required'
        ]);

        //---We save data here
        $data = request()->all();
        $todo = new Todo();
        //---Coming from the form
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;

        $todo->save();

        //---Notification messages
        session()->flash('success', 'Todo created successfully!');

        return redirect('/todos');
    }

    public function edit(Todo $todo){
        //$todo = Todo::find($todoId);

        return view('todos.edit')->with('todo', $todo);
    }

    public function update(Todo $todo){
        //---validate comes from ValidateRequest trait
        $this->validate(request(), [
            'name' => 'required|min:6|max:12',
            'description' => 'required'
        ]);

        $data = request()->all();

        //--_Find the todo

        //$todo = Todo::find($todoId);

        $todo->name = $data['name'];
        $todo->description = $data['description'];

        $todo->save();

        //---Notification messages
        session()->flash('success', 'Todo updated successfully!');

        return redirect('/todos');


    }

    public function destroy(Todo $todo){
        //$todo = Todo::find($todoId);

        $todo->delete();

        //---Notification messages
        session()->flash('success', 'Todo deleted successfully!');

        return redirect('/todos');
    }

    public function complete(Todo $todo){
        $todo->completed = true;
        $todo->save();

        session()->flash('successs', 'Todo completed successfully!');

        return redirect('/todos');
    }
}
