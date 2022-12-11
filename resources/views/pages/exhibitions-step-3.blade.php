@extends('layouts.layout')

@section('content')
    <div id="content">
        <div id="exhibitions">
            <div class="container">
                <div class="exhibitions">
                    <form action="{{ route('application.store') }}" method="post">
                        @csrf
                        <div class="step-3">
                            <div class="section-title">
                                Откуда вы узнали о выставке?
                            </div>
                            <div class="row checkboxes">
                                @if(isset($advertisings))
                                    @foreach($advertisings as $advertising)
                                        <div class="col-sm-6">
                                            <div class="form-group checkbox-wrap">
                                                <input type="checkbox" id="check{{$advertising->id}}" name="advertising[]" value="{{ $advertising->id }}">
                                                <label for="check{{$advertising->id}}">{{ $advertising->getLocaleField('title') }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="button-steps">
                                <a href="{{ url()->previous() }}" class="prew-step">{{ __('customlang.Назад') }}</a>
                                <button type="submit" class="next-step">{{ __('customlang.Далее') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
