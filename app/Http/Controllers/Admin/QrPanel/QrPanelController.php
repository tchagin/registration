<?php

namespace App\Http\Controllers\Admin\QrPanel;

use App\Http\Controllers\Controller;
use App\Models\Exhibition;
use App\Models\Member;
use Illuminate\Http\Request;

class QrPanelController extends Controller
{
    public function index(){
        $exhibitions = Exhibition::with('members')->orderBy('id', 'desc')->get();
        return view('admin.panel.index', compact('exhibitions'));
    }

    public function editStatus(Request $request){
        $member = Member::where('slug', $request->scaner)->first();
        if ($member){
            if ($member->visitor != 1){
                $member->update([
                    'visitor' => 1,
                    'entrance_id' => auth()->user()->entrance,
                ]);
                return redirect()->back()->with('success', 'Посетитель добавлен');
            }
            else{
                return redirect()->back()->with('error', 'Посетитель уже добавлен!');
            }
        }else {
            return redirect()->back()->with('error', 'По этому QR коду посетитель не зарегистрировался!');
        }
    }
}
