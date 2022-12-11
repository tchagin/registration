<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Http\Controllers\Controller;
use App\Models\Entrance;
use App\Models\User;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $admins = User::where('email', '!=', 'admin@mail.com')->get();
        $admin = User::where('email', 'admin@mail.com')->get()->pluck('id');
        $admins = User::where('id', '!=', $admin)->orderBy('id', 'desc')->get();
//        dd($admins);
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entrances = Entrance::get()->pluck('title', 'id');
        return view('admin.admins.create', compact('entrances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'nullable',
            'password' => 'required',
            'position' => 'required',
            'entrance' => 'required'
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'entrance' => $request->entrance,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admins.index')->with('success', 'Администратор добавлен');
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
        $admin = User::find($id);
        $entrances = Entrance::get()->pluck('title', 'id');
        return view('admin.admins.edit', compact('admin', 'entrances'));
    }

    public function editPass($id)
    {
        $admin = User::find($id);
        return view('admin.admins.edit-pass', compact('admin'));
    }
    public function storeNewPass(Request $request, $id){
        $request->validate([
            'password' => 'required',
        ]);
        $admin = User::find($id);
        $admin->update([
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('admins.index')->with('success', 'Администратор отредактирован');
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
        $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'password' => 'nullable',
            'position' => 'required',
            'entrance' => 'required'
        ]);

        $admin = User::find($id);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'entrance' => $request->entrance,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admins.index')->with('success', 'Администратор отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = User::find($id);
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Администратор удалён');
    }
}
