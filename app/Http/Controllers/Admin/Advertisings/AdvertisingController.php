<?php

namespace App\Http\Controllers\Admin\Advertisings;

use App\Http\Controllers\Controller;
use App\Models\Advertising;
use App\Models\AdvertisingTranslations;
use Illuminate\Http\Request;

class AdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisings = Advertising::with('translation')->paginate(20);
        return view('admin.advertisings.index', compact('advertisings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertisings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $data = $request->all();
        $advertising = Advertising::create($data);
        $advertising->translations()->saveMany( array_map(function($values, $locale) {
            return new AdvertisingTranslations(array_merge($values, ['locale' => $locale]));
        } , $data['data'], array_keys($data['data'])));

        return redirect()->route('advertising.index')->with('success', 'Реклама добавлена');
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
        $advertising = Advertising::find($id);
        return view('admin.advertisings.edit', compact('advertising'));
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

        $advertising = Advertising::find($id);
        $data = $request->all();
        $advertising->update($data);

        $advertising->translations()->delete();
        $advertising->translations()->saveMany( array_map(function($values, $locale) {
            return new AdvertisingTranslations(array_merge($values, ['locale' => $locale]));
        } , $data['data'], array_keys($data['data'])));

        return redirect()->route('advertising.index')->with('success', 'Реклама отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advertising = Advertising::find($id);
        $advertising->delete();
        return redirect()->route('advertising.index')->with('success', 'Реклама удалена');
    }
}
