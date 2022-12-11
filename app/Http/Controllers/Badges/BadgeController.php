<?php

namespace App\Http\Controllers\Badges;

use App\Http\Controllers\Controller;
use App\Mail\BadgeMail;
use App\Models\BadgeSettings;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class BadgeController extends Controller
{
    public function index($slug){
        $member = Member::where('slug', $slug)->first();
        return view('pages.badge', compact('member'));
    }


    public function send(Request $request){
        $member = Member::where('id', $request->id)->first();
        $email = $member->where('id', $request->id)->pluck('email')->first();
        Mail::to($email)->send(new BadgeMail($member));
        return redirect()->back();
    }
}
