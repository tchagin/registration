<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Exhibition;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $exhibitions = Exhibition::get();
        $members = Member::all()->count();
        $membersByCountry = Member::select('country')->distinct()->get()->count();
        $membersToday = Member::where('created_at', '>', Carbon::today())->get()->count();

//       Зарегистрированных за неделю
        $dates = collect();
        foreach( range( -6, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates->put( $date, 0);
        }
        $week = Member::where( 'created_at', '>=', $dates->keys()->first() )
            ->groupBy( 'date' )
            ->orderBy( 'date' )
            ->get( [
                DB::raw( 'DATE( created_at ) as date' ),
                DB::raw( 'COUNT( * ) as "count"' )
            ] )
            ->pluck( 'count', 'date' );
        $weekVisitors = Member::where('visitor', 1)->where( 'updated_at', '>=', $dates->keys()->first() )
            ->groupBy( 'date' )
            ->orderBy( 'date' )
            ->get( [
                DB::raw( 'DATE( updated_at ) as date' ),
                DB::raw( 'COUNT( * ) as "count"' )
            ] )
            ->pluck( 'count', 'date' );
        $membersWeek = $dates->merge( $week );
        $membersWeekVisitors = $dates->merge( $weekVisitors );

//        Зарегистрированных за месяц
        $dates = collect();
        foreach( range( -30, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            $dates->put( $date, 0);
        }
        $month = Member::where( 'created_at', '>=', $dates->keys()->first() )
            ->groupBy( 'date' )
            ->orderBy( 'date' )
            ->get( [
                DB::raw( 'DATE( created_at ) as date' ),
                DB::raw( 'COUNT( * ) as "count"' )
            ] )
            ->pluck( 'count', 'date' );

        $monthVisitors = Member::where('visitor', 1)->where( 'updated_at', '>=', $dates->keys()->first() )
            ->groupBy( 'date' )
            ->orderBy( 'date' )
            ->get( [
                DB::raw( 'DATE( updated_at ) as date' ),
                DB::raw( 'COUNT( * ) as "count"' )
            ] )
            ->pluck( 'count', 'date' );
        $membersMonth = $dates->merge( $month );
        $membersMonthVisitors = $dates->merge( $monthVisitors );

//        Зарегистрированных за год
        $start = \Carbon\Carbon::now()->startOfYear();
        $months_to_render = \Carbon\Carbon::now()->diffInMonths($start);

        $dates = collect();

        for ($i = 0; $i <= $months_to_render; $i++) {
            $date = $start->format('n');
            $start->addMonth();
            $dates->put( $date, 0);
        }
        $year = Member::whereMonth( 'created_at', '>=', $dates->keys()->first() )
            ->groupBy( 'month' )
            ->orderBy( 'month' )
            ->get( [
                DB::raw( 'extract(month from "created_at") as month' ),
//                DB::raw( 'MONTH(created_at) as month' ),
                DB::raw( 'COUNT( * ) as "count"' )
            ] )
            ->pluck( 'count', 'month' );
        $yearVisitors = Member::where('visitor', 1)->whereMonth( 'updated_at', '>=', $dates->keys()->first() )
            ->groupBy( 'month' )
            ->orderBy( 'month' )
            ->get( [
                DB::raw( 'extract(month from "updated_at") as month' ),
//                DB::raw( 'MONTH(created_at) as month' ),
                DB::raw( 'COUNT( * ) as "count"' )
            ] )
            ->pluck( 'count', 'month' );

        $membersYear = $dates->merge( $year );
        $membersYearVisitors = $dates->merge( $yearVisitors );


//        Посетителей по странам
        $countryMembers = Member::select('country')->groupBy('country')->pluck('country');
        $countries = Country::whereIn('code', $countryMembers)->get();



        return view('admin.index', compact('exhibitions', 'members', 'membersByCountry', 'membersToday', 'membersWeek', 'membersMonth', 'membersYear', 'countries', 'membersWeekVisitors', 'membersMonthVisitors', 'membersYearVisitors'));
    }
}
