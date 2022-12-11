@extends('layouts.layout')

@section('content')
    <div class="container">
        <div id="choose_language">
            <div class="section-title">
                {{ __('customlang.Выберите язык') }}
            </div>
            <div class="languages">
                <a href="{{ route('choose.lang', ['lang' => 'ru']) }}">Русский <img src="{{ asset('assets/front/img/ru.svg') }}" alt=""></a>
                <a href="{{ route('choose.lang', ['lang' => 'uz']) }}">O'zbekcha <img src="{{ asset('assets/front/img/uz.svg') }}" alt=""></a>
                <a href="{{ route('choose.lang', ['lang' => 'en']) }}">English <img src="{{ asset('assets/front/img/en.svg') }}" alt=""></a>
            </div>
        </div>
    </div>
@endsection
