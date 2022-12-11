<?php

namespace App\Http\Controllers\Admin\Form;

use App\Http\Controllers\Controller;
use App\Models\Exhibition;
use App\Models\Form;
use App\Models\FormTranslations;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inputs = Form::orderBy('id', 'desc')->paginate(20);
        return view('admin.inputs.index', compact('inputs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exhibitions = Exhibition::with('translations')->pluck('title', 'id');
        return view('admin.inputs.create', compact('exhibitions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = [
            'status' => 'nullable'
        ];
        $request->validate($validators);

        array_map( function($locale) use (&$validators) {

            $validators = array_merge($validators, [
                "data.{$locale}.title" => 'required',
            ]);
            return true;
        }, \App\Http\Middleware\Localization::LOCALS);

        $request->validate($validators);
        $data = $request->all();
        $input = Form::create($data);
        $input->translations()->saveMany( array_map(function($values, $locale) {
            return new FormTranslations(array_merge($values, ['locale' => $locale]));
        } , $data['data'], array_keys($data['data'])));

        $input->exhibition()->sync($request->exhibitions);

        return redirect()->route('inputs.index')->with('success', 'Поле добавлено');
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
        $exhibitions = Exhibition::with('translations')->pluck('title', 'id');
        $input = Form::find($id);
        return view('admin.inputs.edit', compact('input', 'exhibitions'));
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
        $validators = [
            'status' => 'nullable'
        ];
        $request->validate($validators);

        array_map( function($locale) use (&$validators) {

            $validators = array_merge($validators, [
                "data.{$locale}.title" => 'required',
            ]);
            return true;
        }, \App\Http\Middleware\Localization::LOCALS);

        $request->validate($validators);

        $input = Form::find($id);
        $data = $request->all();
        $input->update($data);

        $input->translations()->delete();
        $input->translations()->saveMany( array_map(function($values, $locale) {
            return new FormTranslations(array_merge($values, ['locale' => $locale]));
        } , $data['data'], array_keys($data['data'])));

        $input->exhibition()->sync($request->exhibitions);

        return redirect()->route('inputs.index')->with('success', 'Поле отредактировано');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $input = Form::find($id);
        $input->delete();
        return redirect()->route('inputs.index')->with('success', 'Поле удалено');
    }
}
