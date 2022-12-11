<?php

namespace App\Http\Controllers\Admin\Entrances;

use App\Http\Controllers\Controller;
use App\Models\Entrance;
use Illuminate\Http\Request;

class EntranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrances = Entrance::orderBy('id', 'desc')->get();
        return view('admin.entrances.index', compact('entrances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.entrances.create');
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
            'title' => 'required'
        ]);
        $data = $request->all();

        $entrance = Entrance::create($data);
        return redirect()->route('entrances.index')->with('success', 'Вход добавлен');
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
        $entrance = Entrance::find($id);
        return view('admin.entrances.edit', compact('entrance'));
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
            'title' => 'required'
        ]);
        $data = $request->all();
        $entrance = Entrance::find($id);
        $entrance->update($data);
        return redirect()->route('entrances.index')->with('success', 'Вход отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entrance = Entrance::find($id);
        $entrance->delete();
        return redirect()->route('entrances.index')->with('success', 'Вход удалён');
    }
}
