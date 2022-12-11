@extends('admin.layouts.layout')

@section('content')
    <section class="content index">
        <div class="container-fluid">
            <div class="row">
                @if(isset($members))
                <div class="col-md-3 col-sm-6 col-12">
                    <!-- small box -->
                    <div class="small-box">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="inner">
                                {{ $members }}
                            </div>
                            <div class="ico">
                                <img src="{{ asset('assets/admin/img/custom/small-box-1.svg') }}" alt="">
                            </div>
                        </div>
                        <span>Количество посетителей</span>
                    </div>
                </div>
                @endif
                <!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <!-- small box -->
                        <div class="small-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="inner">
                                    {{ $membersToday }}
                                </div>
                                <div class="ico">
                                    <img src="{{ asset('assets/admin/img/custom/small-box-2.png') }}" alt="">
                                </div>
                            </div>
                            <span>Посетителей за день</span>
                        </div>
                    </div>
                    <!-- ./col -->
                @if(isset($membersByCountry))
                <div class="col-md-3 col-sm-6 col-12">
                    <!-- small box -->
                    <div class="small-box">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="inner">
                                {{ $membersByCountry }}
                            </div>
                            <div class="ico">
                                <img src="{{ asset('assets/admin/img/custom/small-box-3.svg') }}" alt="">
                            </div>
                        </div>
                        <span>Количество стран</span>
                    </div>
                </div>
                @endif
                    @if(isset($exhibitions))
                        <div class="col-md-3 col-sm-6 col-12">
                            <!-- small box -->
                            <div class="small-box">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="inner">
                                        {{ $exhibitions->count() }}
                                    </div>
                                    <div class="ico">
{{--                                        <i class="ion ion-person-add"></i>--}}
                                        <img src="{{ asset('assets/admin/img/custom/small-box-4.svg') }}" alt="">
                                    </div>
                                </div>
                                <span>Количество выставок</span>
                            </div>
                        </div>
                @endif
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="statistics">
                        <div class="row statistic-block">
                            <div class="col-xl-3 col-lg-12">
                                <div class="wrapper">
                                    <div class="title">Зарегистрированных</div>
                                    <div class="image"><img src="{{ asset('assets/admin/img/custom/statistics-1.png') }}" alt=""></div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-12">
                                <div class="card-header p-0 border-bottom-0" id="#today">
                                    <ul class="nav nav-tabs" id="custom-tabs-first-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-first-week-tab" data-toggle="pill" href="#custom-tabs-first-week" role="tab" aria-controls="custom-tabs-first-week" aria-selected="true">За неделю</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-first-profile-tab" data-toggle="pill" href="#custom-tabs-first-month" role="tab" aria-controls="custom-tabs-first-month" aria-selected="false">За месяц</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-first-messages-tab" data-toggle="pill" href="#custom-tabs-first-year" role="tab" aria-controls="custom-tabs-first-year" aria-selected="false">За год</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-first-week" role="tabpanel" aria-labelledby="custom-tabs-first-week-tab">
                                            <div class="progress-block">
                                                @foreach ( $membersWeek as $date => $count )
                                                    <div class="wrap">
                                                        <div class="span">{{ $count }}</div>
                                                        <div class="progress vertical active">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="100" style="max-height: 100%; height: {{ $count }}%;
                                                                opacity: @if($count <= 20) 0.2
                                                                        @elseif($count > 20 && $count <= 40) 0.4
                                                                        @elseif($count > 40 && $count <= 60) 0.6
                                                                        @elseif($count > 60 && $count <= 80) 0.8
                                                                        @elseif($count > 80) 1 @endif
                                                                ">
                                                                <span class="sr-only">{{ $count }}%</span>
                                                            </div>
                                                        </div>
                                                        <p> {{ $date }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-first-month" role="tabpanel" aria-labelledby="custom-tabs-first-month-tab">
                                            <div class="progress-block progress-week">
                                                @foreach ( $membersMonth as $date => $count )
                                                    <div class="wrap week">
                                                        <div class="span">{{ $count }}</div>
                                                        <div class="progress vertical progress-xs">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="100" style="max-height: 100%; height: {{ $count }}%;
                                                                opacity: @if($count <= 20) 0.2
                                                                    @elseif($count > 20 && $count <= 40) 0.4
                                                                    @elseif($count > 40 && $count <= 60) 0.6
                                                                    @elseif($count > 60 && $count <= 80) 0.8
                                                                    @elseif($count > 80) 1 @endif
                                                                ">
                                                                <span class="sr-only">{{ $count }}%</span>
                                                            </div>
                                                        </div>
                                                        <p> {{ $date }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-first-year" role="tabpanel" aria-labelledby="custom-tabs-first-year-tab">
                                            <div class="progress-block">
                                                @foreach ( $membersYear as $month => $count )
                                                    <div class="wrap year">
                                                        <div class="span">{{ $count }}</div>
                                                        <div class="progress vertical active">
                                                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="100" style="max-height: 100%; height: {{ $count }}%;
                                                                opacity: @if($count <= 20) 0.2
                                                                @elseif($count > 20 && $count <= 40) 0.4
                                                                @elseif($count > 40 && $count <= 60) 0.6
                                                                @elseif($count > 60 && $count <= 80) 0.8
                                                                @elseif($count > 80) 1 @endif
                                                                    ">
                                                                <span class="sr-only">{{ $count }}%</span>
                                                            </div>
                                                        </div>
                                                        <p>{{ date("F",mktime(0,0,0,$month,1,2011)) }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="statistics">
                        <div class="row statistic-block">
                            <div class="col-xl-3 col-lg-12">
                                <div class="wrapper">
                                    <div class="title">QR-SCANNER</div>
                                    <div class="image"><img src="{{ asset('assets/admin/img/custom/statistics-2.png') }}" alt=""></div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-12">
                                <div class="card-header p-0 border-bottom-0" id="#today">
                                    <ul class="nav nav-tabs" id="custom-tabs-second-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-second-home-tab" data-toggle="pill" href="#custom-tabs-second-home" role="tab" aria-controls="custom-tabs-second-home" aria-selected="true">За неделю</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-second-profile-tab" data-toggle="pill" href="#custom-tabs-second-profile" role="tab" aria-controls="custom-tabs-second-profile" aria-selected="false">За месяц</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-second-messages-tab" data-toggle="pill" href="#custom-tabs-second-messages" role="tab" aria-controls="custom-tabs-second-messages" aria-selected="false">За год</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-second-home" role="tabpanel" aria-labelledby="custom-tabs-second-home-tab">
                                            <div class="progress-block">
                                                @foreach ( $membersWeekVisitors as $date => $count )
                                                    <div class="wrap">
                                                        <div class="span">{{ $count }}</div>
                                                        <div class="progress vertical active">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="100" style="max-height: 100%; height: {{ $count }}%;
                                                                opacity: @if($count <= 20) 0.2
                                                            @elseif($count > 20 && $count <= 40) 0.4
                                                            @elseif($count > 40 && $count <= 60) 0.6
                                                            @elseif($count > 60 && $count <= 80) 0.8
                                                            @elseif($count > 80) 1 @endif
                                                                ">
                                                                <span class="sr-only">{{ $count }}%</span>
                                                            </div>
                                                        </div>
                                                        <p> {{ $date }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-second-profile" role="tabpanel" aria-labelledby="custom-tabs-second-profile-tab">
                                            <div class="progress-block progress-week">
                                                @foreach ( $membersMonthVisitors as $date => $count )
                                                    <div class="wrap week">
                                                        <div class="span">{{ $count }}</div>
                                                        <div class="progress vertical progress-xs">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="100" style="max-height: 100%; height: {{ $count }}%;
                                                                opacity: @if($count <= 20) 0.2
                                                            @elseif($count > 20 && $count <= 40) 0.4
                                                            @elseif($count > 40 && $count <= 60) 0.6
                                                            @elseif($count > 60 && $count <= 80) 0.8
                                                            @elseif($count > 80) 1 @endif
                                                                ">
                                                                <span class="sr-only">{{ $count }}%</span>
                                                            </div>
                                                        </div>
                                                        <p> {{ $date }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-second-messages" role="tabpanel" aria-labelledby="custom-tabs-second-messages-tab">
                                            <div class="progress-block">
                                                @foreach ( $membersYearVisitors as $month => $count )
                                                    <div class="wrap year">
                                                        <div class="span">{{ $count }}</div>
                                                        <div class="progress vertical active">
                                                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="100" style="max-height: 100%; height: {{ $count }}%;
                                                                opacity: @if($count <= 20) 0.2
                                                            @elseif($count > 20 && $count <= 40) 0.4
                                                            @elseif($count > 40 && $count <= 60) 0.6
                                                            @elseif($count > 60 && $count <= 80) 0.8
                                                            @elseif($count > 80) 1 @endif
                                                                ">
                                                                <span class="sr-only">{{ $count }}%</span>
                                                            </div>
                                                        </div>
                                                        <p>{{ date("F",mktime(0,0,0,$month,1,2011)) }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $dt = \Carbon\Carbon::now();
                @endphp

                <div class="col-md-6 col-sm-12">
                    <div class="statistics">
                        <div class="row statistic-block">
                            <div class="col-xl-3 col-lg-12">
                                <div class="wrapper">
                                    <div class="title">Посетителей по выставкам</div>
                                    <div class="image"><img src="{{ asset('assets/admin/img/custom/statistics-3.png') }}" alt=""></div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-12">
                                <div class="card-header p-0 border-bottom-0" id="#today">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-three-week-tab" data-toggle="pill" href="#custom-tabs-three-week" role="tab" aria-controls="custom-tabs-fourth-week" aria-selected="true">За неделю</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-month-tab" data-toggle="pill" href="#custom-tabs-three-month" role="tab" aria-controls="custom-tabs-fourth-month" aria-selected="false">За месяц</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-year-tab" data-toggle="pill" href="#custom-tabs-three-year" role="tab" aria-controls="custom-tabs-three-year" aria-selected="false">За год</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-full-tab" data-toggle="pill" href="#custom-tabs-three-full" role="tab" aria-controls="custom-tabs-fourth-full" aria-selected="false">Общее</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-fourth-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-three-week" role="tabpanel" aria-labelledby="custom-tabs-three-week-tab">
                                        <div class="row statistic-circle-wrap">
                                            <div class="col-xl-8 col-lg-12">
                                                <div id="week-chart-exhibitions"></div>
                                            </div>


                                            <div class="col-xl-4 col-lg-12">
                                                <ul class="statistic-list">
                                                    @foreach($exhibitions as $exhibition)
                                                        <li>
                                                            <span>{{ $exhibition->title }}</span> -
                                                            <span class="pr-2">{{ $exhibition->members->where('visitor', 1)->where('created_at', '>', $dt->startOfWeek())->count() }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var chart1 = new Highcharts.Chart({
                                                    chart: {
                                                        type: 'pie',
                                                        renderTo: 'week-chart-exhibitions'
                                                    },
                                                    title: {
                                                        verticalAlign: 'middle',
                                                        floating: true,
                                                        text: ''
                                                    },
                                                    plotOptions: {
                                                        pie: {
                                                            innerSize: '90%'
                                                        }
                                                    },

                                                    series: [{
                                                        data: [
                                                            @foreach($exhibitions as $exhibition)
                                                            ['{{ $exhibition->title }}', {{ $exhibition->members->where('visitor', 1)->where('created_at' ,'>', $dt->startOfWeek())->count() }}],
                                                            @endforeach
                                                        ]
                                                    }]
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-month" role="tabpanel" aria-labelledby="custom-tabs-three-month-tab">
                                        <div class="row statistic-circle-wrap">
                                            <div class="col-xl-8 col-lg-12">
                                                <div id="month-chart-exhibitions"></div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12">
                                                <ul class="statistic-list">
                                                    @foreach($exhibitions as $exhibition)
                                                        <li>
                                                            <span>{{ $exhibition->title }}</span> -
                                                            <span class="pr-2">{{ $exhibition->members->where('visitor', 1)->where('created_at', '>', $dt->startOfMonth())->count() }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var chart1 = new Highcharts.Chart({
                                                    chart: {
                                                        type: 'pie',
                                                        renderTo: 'month-chart-exhibitions'
                                                    },
                                                    title: {
                                                        verticalAlign: 'middle',
                                                        floating: true,
                                                        text: ''
                                                    },
                                                    plotOptions: {
                                                        pie: {
                                                            innerSize: '90%'
                                                        }
                                                    },

                                                    series: [{
                                                        data: [
                                                                @foreach($exhibitions as $exhibition)
                                                            ['{{ $exhibition->title }}', {{ $exhibition->members->where('visitor', 1)->where('created_at', '>', $dt->startOfMonth())->count() }}],
                                                            @endforeach
                                                        ]
                                                    }]
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-year" role="tabpanel" aria-labelledby="custom-tabs-three-year-tab">
                                        <div class="row statistic-circle-wrap">
                                            <div class="col-xl-8 col-lg-12">
                                                <div id="year-chart-exhibitions"></div>
                                            </div>


                                            <div class="col-xl-4 col-lg-12">
                                                <ul class="statistic-list">
                                                    @foreach($exhibitions as $exhibition)
                                                        <li>
                                                            <span>{{ $exhibition->title }}</span> -
                                                            <span class="pr-2">{{ $exhibition->members->where('visitor', 1)->where('created_at', '>', $dt->startOfYear())->count() }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var chart1 = new Highcharts.Chart({
                                                    chart: {
                                                        type: 'pie',
                                                        renderTo: 'year-chart-exhibitions'
                                                    },
                                                    title: {
                                                        verticalAlign: 'middle',
                                                        floating: true,
                                                        text: ''
                                                    },
                                                    plotOptions: {
                                                        pie: {
                                                            innerSize: '90%'
                                                        }
                                                    },

                                                    series: [{
                                                        data: [
                                                            @foreach($exhibitions as $exhibition)
                                                            ['{{ $exhibition->title }}', {{ $exhibition->members->where('visitor', 1)->where('created_at', '>', $dt->startOfYear())->count() }}],
                                                            @endforeach
                                                        ]
                                                    }]
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-full" role="tabpanel" aria-labelledby="custom-tabs-three-full-tab">
                                        <div class="row statistic-circle-wrap">
                                            <div class="col-xl-8 col-lg-12">
                                                <div id="full-chart-exhibitions"></div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12">
                                                <ul class="statistic-list">
                                                    @foreach($exhibitions as $exhibition)
                                                        <li>
                                                            <span>{{ $exhibition->title }}</span> -
                                                            <span class="pr-2">{{ $exhibition->members->where('visitor', 1)->count() }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var chart1 = new Highcharts.Chart({
                                                    chart: {
                                                        type: 'pie',
                                                        renderTo: 'full-chart-exhibitions'
                                                    },
                                                    title: {
                                                        verticalAlign: 'middle',
                                                        floating: true,
                                                        text: ''
                                                    },
                                                    plotOptions: {
                                                        pie: {
                                                            innerSize: '90%'
                                                        }
                                                    },

                                                    series: [{
                                                        data: [
                                                            @foreach($exhibitions as $exhibition)
                                                            ['{{ $exhibition->title }}', {{ $exhibition->members->where('visitor', 1)->count() }}],
                                                            @endforeach
                                                        ]
                                                    }]
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $dt = \Carbon\Carbon::now();
                @endphp

                <div class="col-md-6 col-sm-12">
                    <div class="statistics">
                        <div class="row statistic-block">
                            <div class="col-xl-3 col-lg-12">
                                <div class="wrapper">
                                    <div class="title">Посетителей по странам</div>
                                    <div class="image"><img src="{{ asset('assets/admin/img/custom/statistics-4.png') }}" alt=""></div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-12">
                                <div class="card-header p-0 border-bottom-0" id="#today">
                                    <ul class="nav nav-tabs" id="custom-tabs-fourth-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-fourth-week-tab" data-toggle="pill" href="#custom-tabs-fourth-week" role="tab" aria-controls="custom-tabs-fourth-week" aria-selected="true">За неделю</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-fourth-month-tab" data-toggle="pill" href="#custom-tabs-fourth-month" role="tab" aria-controls="custom-tabs-fourth-month" aria-selected="false">За месяц</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-fourth-year-tab" data-toggle="pill" href="#custom-tabs-fourth-year" role="tab" aria-controls="custom-tabs-three-year" aria-selected="false">За год</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-fourth-full-tab" data-toggle="pill" href="#custom-tabs-fourth-full" role="tab" aria-controls="custom-tabs-fourth-full" aria-selected="false">Общее</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-fourth-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-fourth-week" role="tabpanel" aria-labelledby="custom-tabs-fourth-week-tab">
                                        <div class="row statistic-circle-wrap">
                                            <div class="col-xl-8 col-lg-12">
                                                <div id="week-chart-countries"></div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12">
                                                <ul class="statistic-list">
                                                    @foreach($countries as $country)
                                                        <li>
                                                            <span>{{ $country->countryname }}</span> -
                                                            <span class="pr-2">{{ $country->members->where('visitor', 1)->where('created_at', '>', $dt->startOfWeek())->count() }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var chart1 = new Highcharts.Chart({
                                                    chart: {
                                                        type: 'pie',
                                                        renderTo: 'week-chart-countries'
                                                    },
                                                    title: {
                                                        verticalAlign: 'middle',
                                                        floating: true,
                                                        text: ''
                                                    },
                                                    plotOptions: {
                                                        pie: {
                                                            innerSize: '90%'
                                                        }
                                                    },

                                                    series: [{
                                                        data: [
                                                            @foreach($countries as $country)
                                                            ['{{ $country->countryname }}', {{ $country->members->where('visitor', 1)->where('created_at', '>', $dt->startOfWeek())->count() }}],
                                                            @endforeach
                                                        ]
                                                    }]
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-fourth-month" role="tabpanel" aria-labelledby="custom-tabs-fourth-month-tab">
                                        <div class="row statistic-circle-wrap">
                                            <div class="col-xl-8 col-lg-12">
                                                <div id="month-chart-countries"></div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12">
                                                <ul class="statistic-list">
                                                    @foreach($countries as $country)
                                                        <li>
                                                            <span>{{ $country->countryname }}</span> -
                                                            <span class="pr-2">{{ $country->members->where('visitor', 1)->where('created_at', '>', $dt->startOfMonth())->count() }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var chart1 = new Highcharts.Chart({
                                                    chart: {
                                                        type: 'pie',
                                                        renderTo: 'month-chart-countries'
                                                    },
                                                    title: {
                                                        verticalAlign: 'middle',
                                                        floating: true,
                                                        text: ''
                                                    },
                                                    plotOptions: {
                                                        pie: {
                                                            innerSize: '90%'
                                                        }
                                                    },

                                                    series: [{
                                                        data: [
                                                                @foreach($countries as $country)
                                                            ['{{ $country->countryname }}', {{ $country->members->where('visitor', 1)->where('created_at', '>', $dt->startOfMonth())->count() }}],
                                                            @endforeach
                                                        ]
                                                    }]
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-fourth-year" role="tabpanel" aria-labelledby="custom-tabs-fourth-year-tab">
                                        <div class="row statistic-circle-wrap">
                                            <div class="col-xl-8 col-lg-12">
                                                <div id="year-chart-countries"></div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12">
                                                <ul class="statistic-list">
                                                    @foreach($countries as $country)
                                                        <li>
                                                            <span>{{ $country->countryname }}</span> -
                                                            <span class="pr-2">{{ $country->members->where('visitor', 1)->where('created_at', '>', $dt->startOfYear())->count() }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var chart1 = new Highcharts.Chart({
                                                    chart: {
                                                        type: 'pie',
                                                        renderTo: 'year-chart-countries'
                                                    },
                                                    title: {
                                                        verticalAlign: 'middle',
                                                        floating: true,
                                                        text: ''
                                                    },
                                                    plotOptions: {
                                                        pie: {
                                                            innerSize: '90%'
                                                        }
                                                    },

                                                    series: [{
                                                        data: [
                                                                @foreach($countries as $country)
                                                            ['{{ $country->countryname }}', {{ $country->members->where('visitor', 1)->where('created_at', '>', $dt->startOfYear())->count() }}],
                                                            @endforeach
                                                        ]
                                                    }]
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-fourth-full" role="tabpanel" aria-labelledby="custom-tabs-fourth-full-tab">
                                        <div class="row statistic-circle-wrap">
                                            <div class="col-xl-8 col-lg-12">
                                                <div id="full-chart-countries"></div>
                                            </div>

                                            <div class="col-xl-4 col-lg-12">
                                                <ul class="statistic-list">
                                                    @foreach($countries as $country)
                                                        <li>
                                                            <span>{{ $country->countryname }}</span> -
                                                            <span class="pr-2">{{ $country->members->where('visitor', 1)->count() }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var chart1 = new Highcharts.Chart({
                                                    chart: {
                                                        type: 'pie',
                                                        renderTo: 'full-chart-countries'
                                                    },
                                                    title: {
                                                        verticalAlign: 'middle',
                                                        floating: true,
                                                        text: ''
                                                    },
                                                    plotOptions: {
                                                        pie: {
                                                            innerSize: '90%'
                                                        }
                                                    },

                                                    series: [{
                                                        data: [
                                                                @foreach($countries as $country)
                                                            ['{{ $country->countryname }}', {{ $country->members->where('visitor', 1)->count() }}],
                                                            @endforeach
                                                        ]
                                                    }]
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
