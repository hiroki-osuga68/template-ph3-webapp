<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Schema\Table;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\User;
use App\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminadminstableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_users =  DB::table('admins')->get();
        // dd($admin_users);
        // viewの第2引数に変数を指定し、bladeで利用可能にする
        return view('admin/admin_admins_table', compact('admin_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);
    
        $admin_user = new Admin;
        // dd($admin_user);
        $admin_user->name = $request->name;
        $admin_user->email = $request->email;
        $admin_user->password = Hash::make($request->password);
        // dd($admin_user);
        $admin_user->save();
    
        return redirect()->route('admin_admins_table.index')->with('success', 'Registered successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
