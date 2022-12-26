<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class todos_Controller extends Controller
{
    public function todoIndex()
    {
        $data = Todo::all();
        return view("todosIndex", compact("data"));
    }


    public function todoInsert(Request $req)
    {
        if (Auth::check()){
            $todo = new Todo();
            $todo->name = $req->name;
            $todo->save();
            return redirect("/");
        } else {
            return redirect("/login");
        }
        
    }
}
