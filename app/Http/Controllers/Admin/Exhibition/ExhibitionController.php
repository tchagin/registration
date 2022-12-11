<?php

namespace App\Http\Controllers\Admin\Exhibition;

use App\Http\Controllers\Controller;
use App\Models\Exhibition;
use App\Models\Form;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ExhibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exhibitions = Exhibition::with('members', 'form')->orderBy('id', 'desc')->paginate(20);
        return view('admin.exhibitions.index', compact('exhibitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forms = Form::with('translation')->get()->pluck('translation.title', 'id')->all();
        return view('admin.exhibitions.create', compact('forms'));
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
            'title' => 'required',
            'logo' => 'nullable',
            'dateStart' => 'required',
            'dateFinish' => 'required',
            'link' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        $data['logo'] = Exhibition::uploadImage($request);
        $exhibition = Exhibition::create($data);
        $exhibition->form()->sync($request->forms);

        return redirect()->route('exhibitions.index')->with('success', 'Выставка добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forms = Form::with('translation')->get()->pluck('translation.title', 'id')->all();
        $exhibition = Exhibition::find($id);
        return view('admin.exhibitions.edit', compact('exhibition', 'forms'));
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
            'title' => 'required',
            'logo' => 'nullable',
            'dateStart' => 'required',
            'dateFinish' => 'required',
            'link' => 'required',
            'status' => 'required',
        ]);
        $data = $request->all();
        $exhibition = Exhibition::find($id);
        if ($file = Exhibition::uploadImage($request, $exhibition->logo)) {
            $data['logo'] = $file;
        }
        $exhibition->update($data);
        $exhibition->form()->sync($request->forms);
        return redirect()->route('exhibitions.index')->with('success', 'Выставка отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exhibition = Exhibition::find($id);

        if ($exhibition->members->count()) {
            return redirect()->route('exhibitions.index')->with('error', 'Ошибка! У выставки есть зарегистрированные пользователи');
        }

        $exhibition->form()->sync([]);
        Storage::delete($exhibition->logo);
        $exhibition->delete();
        return redirect()->route('exhibitions.index')->with('success', 'Выставка удалена');
    }
}
