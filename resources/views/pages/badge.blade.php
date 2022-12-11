@extends('layouts.layout')

@section('content')
    <div class="container">
        <div id="badge">
            <div class="section-title">
                {{ __('customlang.Ваш бeйдж') }}
            </div>
            <div class="row badge-wrap">
                <div class="col-md-6 actions-block">
                    <div class="actions">
                        <button onclick="printBadge();">{{ __('customlang.Печать') }}</button>
                        <form action="{{ route('badge.send', ['id' => $member->id]) }}" method="post" id="callForm">
                            @csrf
                            <button type="submit">{{ __('customlang.Отправить на e-mail') }}</button>
                        </form>
                        <button onclick="generatePDF()">{{ __('customlang.Сохранить в PDF') }}</button>
                        <a href="{{ url($member->exhibition->link) }}" target="_blank">{{ __('customlang.Сайт выставки') }}</a>
                        <a href="{{ route('home') }}">{{ __('customlang.На главную') }}</a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 col-md-6">
                    @include('pages.inc.badge-section')
                </div>
            </div>
        </div>
    </div>

{{--    @include('pages.inc.badge-print')--}}

@endsection
