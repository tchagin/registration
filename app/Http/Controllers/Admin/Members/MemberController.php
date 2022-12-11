<?php

namespace App\Http\Controllers\Admin\Members;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Entrance;
use App\Models\Exhibition;
use App\Models\Industry;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $members = Member::with('exhibition', 'exhibition.form', 'userCountry', 'userIndustry', 'userIndustry.translation')
            ->orderBy('id', 'desc');

        $exhibitions = Exhibition::pluck('title', 'id');
        $entrances = Entrance::get()->pluck('title', 'id');
//        dd($entrances);

        if($ex_id = $request->input('ex_id')){
            $members = $members->where('ex_id', $ex_id);
        }

//        if($membersId = $request->input('changeStatus')){
//            $members = $members->whereIn('id', $membersId)->get();
//            dd($members);
//        }

        $members = $members->paginate(50);

        return view('admin.members.index', compact('members', 'exhibitions', 'entrances'));
    }

    public function addVisitor($id){
        $member = Member::find($id);
        if ($member->visitor == 0){
            $member->visitor = 1;
            $member->update();
            return redirect()->route('members.index')->with('success', 'Пользователю присвоен статус посетителя');
        }
    }

    public function selectedAddVisitor(Request $request){
//        dd($request->all());
        $entrance = $request->entrance;
        $membersId = $request->changeStatus;
        $members = Member::whereIn('id', $membersId);
        $members->update([
           'visitor' => 1,
            'entrance_id' => $entrance,
        ]);
        return redirect()->route('members.index')->with('success', 'Пользователям присвоен статус посетителя');
    }

    public function memberList(){
        $exhibitions = Exhibition::pluck('title', 'id');
        return view('admin.members.member-list', compact('exhibitions'));
    }

    public function ss_processing(){
            $model = Member::with('exhibition', 'exhibition.form', 'userCountry', 'userIndustry', 'userIndustry.translation')->orderBy('id', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('countryName', function (Member $member) {
                    return $member->userCountry->countryname;
                })
                ->toJson();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($slug)
    {
        $member = Member::where('slug', $slug)->first();
        return view('pages.badge', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::get();
        $exhibitions = Exhibition::pluck('title', 'id');
        $member = Member::find($id);
        $industries = Industry::get();
        return view('admin.members.edit', compact('member', 'exhibitions', 'countries', 'industries'));
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
            'ex_id' => 'required',
            'country' => 'required',
            'title' => 'required',
            'industry' => 'nullable',
            'email' => 'nullable',
            'phone' => 'required',
            'fullName' => 'required',
            'position' => 'required',
            'input_1' => 'nullable',
            'input_2' => 'nullable',
            'input_3' => 'nullable',
            'input_4' => 'nullable',
        ]);

        $data = $request->all();
        $member = Member::find($id);
        $member->update($data);
        return redirect()->route('members.index')->with('success', 'Участник отредактирован');
    }

    public function customDelete($id){
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Участник удалён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Участник удалён');
    }
}
