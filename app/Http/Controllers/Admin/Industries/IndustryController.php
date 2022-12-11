<?php

namespace App\Http\Controllers\Admin\Industries;

use App\Http\Controllers\Controller;
use App\Models\Exhibition;
use App\Models\Industry;
use App\Models\IndustryTranslations;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industries = Industry::with('translation')->orderBy('id', 'desc')->paginate(20);
        return view('admin.industries.index', compact('industries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exhibitions = Exhibition::with('translations')->pluck('title', 'id');
        return view('admin.industries.create', compact('exhibitions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->exhibitions);
        $validators = [];
        $request->validate($validators);

        array_map( function($locale) use (&$validators) {

            $validators = array_merge($validators, [
                "data.{$locale}.title" => 'required',
            ]);
            return true;
        }, \App\Http\Middleware\Localization::LOCALS);

        $request->validate($validators);
        $data = $request->all();
        $industry = Industry::create($data);
        $industry->translations()->saveMany( array_map(function($values, $locale) {
            return new IndustryTranslations(array_merge($values, ['locale' => $locale]));
        } , $data['data'], array_keys($data['data'])));

        $industry->exhibitions()->sync($request->exhibitions);

        return redirect()->route('industries.index')->with('success', 'Индустрия добавлено');
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
        $industry = Industry::find($id);
        $exhibitions = Exhibition::with('translations')->pluck('title', 'id');
        return view('admin.industries.edit', compact('industry', 'exhibitions'));
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
        $validators = [];
        $request->validate($validators);

        array_map( function($locale) use (&$validators) {

            $validators = array_merge($validators, [
                "data.{$locale}.title" => 'required',
            ]);
            return true;
        }, \App\Http\Middleware\Localization::LOCALS);

        $request->validate($validators);

        $industry = Industry::find($id);
        $data = $request->all();
        $industry->update($data);

        $industry->translations()->delete();
        $industry->translations()->saveMany( array_map(function($values, $locale) {
            return new IndustryTranslations(array_merge($values, ['locale' => $locale]));
        } , $data['data'], array_keys($data['data'])));

        $industry->exhibitions()->sync($request->exhibitions);

        return redirect()->route('industries.index')->with('success', 'Индустрия отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $industry = Industry::find($id);
        $industry->delete();
        return redirect()->route('industries.index')->with('success', 'Индустрия удалена');
    }
}
