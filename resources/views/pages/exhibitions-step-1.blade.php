@extends('layouts.layout')

@section('content')
    <div id="exhibitions">
        <div class="container">
            <div class="exhibitions">
                @if(count($exs))
{{--                <form action="{{ route('application.step1') }}" method="post">--}}
                    @csrf
                    <div class="step-1">
                        <div class="section-title">
                            {{ __('customlang.Выберите выставку') }}
                        </div>
                        <div class="row">
                            @foreach($exs as $ex)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <a href="{{ route('application.step1', ['ex_id' => $ex->id]) }}" class="exhibition">
                                        <img src="{{ $ex->getImage() }}" alt="" aria-hidden="true">
                                    </a>
                                </div>
                            @endforeach
{{--                                <div class="col-lg-3 col-md-4 col-sm-6">--}}
{{--                                    <input type="radio" id="radio-{{ $ex->id }}" name="ex_id" value="{{ $ex->id }}">--}}
{{--                                    <label for="radio-{{ $ex->id }}">--}}
{{--                                        <img src="{{ $ex->getImage() }}" alt="" aria-hidden="true">--}}
{{--                                    </label>--}}
{{--                                </div>--}}
                        </div>
{{--                        <div class="button-steps">--}}
{{--                            <button type="submit" class="next-step">{{ __('customlang.Далее') }}</button>--}}
{{--                        </div>--}}
                    </div>
{{--                </form>--}}
                @else
                    {{ __('customlang.Выставки отсутствуют') }}
                @endif
            </div>
        </div>
    </div>
@endsection
