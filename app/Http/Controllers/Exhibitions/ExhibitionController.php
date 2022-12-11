<?php

namespace App\Http\Controllers\Exhibitions;

use App\Http\Controllers\Controller;
use App\Models\Advertising;
use App\Models\Country;
use App\Models\Exhibition;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ExhibitionController extends Controller
{
    public function chooseLang(Request $request){
        $locale = $request->lang;
        if ($locale){
            session()->put('locale', $locale);
            App::setLocale($locale);
        }
        return redirect()->route('exhibitions');
    }

    public function index(){
        $exs = Exhibition::where('status', 'active')->get();
        return view('pages.exhibitions-step-1', compact('exs'));
    }

    public function applicationStep1(Request $request){
        $request->validate([
            'ex_id' => 'required',
        ]);
        $data = $request->all();
        $ex_id = $data['ex_id'];
        return redirect()->route('application.step2', compact('ex_id'));
    }

    public function applicationStep2(Request $ex_id){
        $ex_id = $ex_id->ex_id;
        $ex = Exhibition::where('id', $ex_id)->firstOrFail();
        $countries = Country::get();
        return view('pages.exhibitions-step-2', compact( 'ex', 'countries'));
    }
//    public function applicationStep3(Request $request){
//        $rules = [
//            'ex_id' => 'required',
//            'country' => 'required|max:3',
//            'title' => 'required',
//            'industry' => 'nullable',
//            'email' => 'nullable',
//            'phone' => 'required|numeric',
//            'fullName' => 'required',
//            'position' => 'required',
//            'input_1' => 'nullable',
//            'input_2' => 'nullable',
//            'input_3' => 'nullable',
//            'input_4' => 'nullable',
//        ];
//
//        $messages = [
//            'country.max' => 'Выберите страну'
//        ];
//
//        $validator = Validator::make($request->all(), $rules, $messages)->validate();
//
//        $data = $request->all();
////        $data['slug'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 15);
//        $data['slug'] = substr(str_shuffle("0123456789"), 0, 6);
//        session(['member' => [
//            ['country' => $request->country, 'ex_id' => $data['ex_id'], 'fullName' => $data['fullName'], 'phone' => $data['phone'], 'email' => $data['email'], 'title' => $data['title'], 'position' => $data['position'], 'industry' => $data['industry'], 'slug'=>$data['slug']]
//        ]]);
//        $advertisings = Advertising::with('translations')->get();
//        return view('pages.exhibitions-step-3', compact('advertisings'));
//    }

    public function applicationStore(Request $request){
        $rules = [
            'ex_id' => 'required',
            'country' => 'required|max:3',
            'title' => 'required',
            'industry' => 'nullable',
            'email' => 'nullable',
            'phone' => 'required|numeric',
            'fullName' => 'required',
            'position' => 'required',
            'input_1' => 'nullable',
            'input_2' => 'nullable',
            'input_3' => 'nullable',
            'input_4' => 'nullable',
        ];

        $messages = [
            'country.max' => 'Выберите страну'
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $data = $request->all();
//        $data['slug'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 15);
        $data['slug'] = substr(str_shuffle("0123456789"), 0, 6);
        session(['member' => [
            ['country' => $request->country, 'ex_id' => $data['ex_id'], 'fullName' => $data['fullName'], 'phone' => $data['phone'], 'email' => $data['email'], 'title' => $data['title'], 'position' => $data['position'], 'industry' => $data['industry'], 'slug'=>$data['slug']]
        ]]);

        $member = Member::create([
            'country' => session('member')[0]['country'],
            'ex_id' => session('member')[0]['ex_id'],
            'fullName' => session('member')[0]['fullName'],
            'phone' => session('member')[0]['phone'],
            'email' => session('member')[0]['email'],
            'title' => session('member')[0]['title'],
            'position' => session('member')[0]['position'],
            'industry' => session('member')[0]['industry'],
            'slug' => session('member')[0]['slug'],
        ]);
        $member->advertising()->sync($request->advertising);

        $image = \QrCode::format('png')
            ->size(250)
//            ->merge('/public/assets/admin/img/custom/qr-logo.png', .3)
            ->style('round', 0.9)
            ->generate($member->slug);
        $output_file = '/qr-code/img-' . $member->id . '.png';
        Storage::disk('public')->put($output_file, $image);
        session()->pull('member');

        return redirect()->route('badge', ['slug' => $member->slug]);
    }
}
