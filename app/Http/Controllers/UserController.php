<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	public function getAllUsers(){
		$users = User::all();
		return response()->json(['users' => $users],200);
	}


    public function store(Request $request){
    	// dd($request->all());
    	$user = new User;
    	$user->name     = $request->name;
    	$user->email    = $request->email;
    	$user->password = bcrypt($request->password);
    	if($user->save()){
    		return response()->json(['user' => $user],200);
    	}
    }


    public function editUserInfo(Request $request){
    	// dd($request->all());
    	$user = User::find($request->id);
    	$user->name 	= $request->name;
    	$user->email 	= $request->email;
    	if ($request->password) {
    		$user->password = bcrypt($request->password);
    	}
    	if ($user->save()) {
    		return response()->json($user , 200);
    	}
    }


    public function index(){
    	$users = User::all();
    	return view('index',compact('users'));
    }


    public function getUserInfo(Request $request){
    	// dd($request->all());
    	$user = User::find($request->id);
    	return response()-> json($user , 200);
    }


    public function deleteUser(Request $request){
    	// dd($request->all());
    	$user = User::find($request->id);
    	$user->delete();
    	
    }


    public function search(Request $request){
    	$key  = $request->search;
    	$users = User::where("name","like",'%'.$key.'%')->get();
    	return response()->json($users,200);

    }


    
    
}

