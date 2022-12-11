@extends('layouts.layout')

@section('content')
    <div id="exhibitions">
        <div class="container">
            <div class="exhibitions">

                @if(isset($ex))
                <form action="{{ route('application.store') }}" method="post">
                    @csrf
                    <div class="step-2">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row justify-content-center">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-5">
                                            <label for="" class="country">{{ __('customlang.Страна') }}</label>

                                            <select class="js-example-basic-single js-example-templating" name="country" autocomplete="off">
                                                <option value="">-</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->code }}">{{ $country->countryname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
{{--                            <input type="hidden" value="UZ" name="country">--}}
                            <input type="hidden" name="ex_id" value="{{ $ex->id }}">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="fullName">{{ __('customlang.Ф.И.О') }}</label>
                                    <input type="text" name="fullName" placeholder="{{ __('customlang.Введите Ф.И.О') }}" class="form-control" value="{{ old('fullName') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">{{ __('customlang.Номер телефона') }}</label>
                                    <input type="text" name="phone" placeholder="{{ __('customlang.Введите номер') }}" class="form-control" value="{{ old('phone') }}" required pattern="+[0-9]{6,12}">
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" placeholder="Введите E-mail" class="form-control" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="title">{{ __('customlang.Название компании') }}</label>
                                    <input type="text" name="title" placeholder="{{ __('customlang.Введите название') }}" class="form-control" value="{{ old('title') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="position">{{ __('customlang.Должность') }}</label>
                                    <input type="text" name="position" placeholder="{{ __('customlang.Введите должность') }}" class="form-control" value="{{ old('position') }}" required>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="industry">Индустрия</label>--}}
{{--                                    <select class="form-control" id="exampleFormControlSelect1" name="industry">--}}
{{--                                        <option value="" selected>-</option>--}}
{{--                                        @foreach($ex->industry as $industry)--}}
{{--                                            <option value="{{ $industry->id }}">{{ $industry->getLocaleField('title') }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
                                <input type="hidden" value="0" name="industry">
                            </div>
                            @foreach($ex->form->where('status', 'active') as $key => $input)
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">{{ $input->getLocaleField('title') }}</label>
                                    <input type="text" name="input_{{ $key + 1}}" placeholder="{{ $input->getLocaleField('title') }}" class="form-control">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="button-steps">
                            <a href="{{ url()->previous() }}" class="prew-step">{{ __('customlang.Назад') }}</a>
                            <button type="submit" class="next-step">{{ __('customlang.Далее') }}</button>
                        </div>
                    </div>
                </form>
                @else
                @endif
            </div>
        </div>
    </div>
@endsection
