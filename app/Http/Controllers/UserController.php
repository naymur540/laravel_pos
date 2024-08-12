<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::paginate(5);
        return view('users.index',["users"=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $users=new User();
        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=md5($request->name);
        $users->is_admin=$request->is_admin;
        $users->save();
        if($users){
            return redirect()->back()->with('massage','User Create Successfully');
        }else{
            return redirect()->back()->with('massage','User fill to create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=User::find($id);
        if(!$user){
            return back()->with('message','User not found');
        }
        $user->update($request->all());
        return back()->with('message','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find($id);
        if(!$user){
            return back()->with('message','User not found');
        }
        $user->delete();
        return back()->with('message','User delete successfully');
    }
}
