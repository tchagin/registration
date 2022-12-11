<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ !isset($member) ? 'Добавить участника' : 'Редактировать участника' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ !isset($member) ? route('members.store') : route('members.update', ['member' => $member->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($member))  @method('PUT') @endif

                    <div class="form-group">
                        <label for="" class="country">Страна участника</label>
                        <select name="country" id="select" class="form-control js-example-basic-single">
                            @foreach($countries as $country)
                            <option value="{{ $country->code }}" @if(isset($member) && $country->code == $member->country) selected @endif>{{ $country->countryname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Название компании</label>
                        <input type="text" name="title" placeholder="Введите название" class="form-control" value="{{ isset($member) ? $member->title : old('title') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="industry">Индустрия</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="industry">
                            <option value="" selected>-</option>
                            @foreach($industries as $industry)
                                <option value="{{ $industry->id }}" @if(isset($member) && $industry->id == $member->industry) selected @endif>{{ $industry->getLocaleField('title') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" placeholder="Введите E-mail" class="form-control" value="{{ isset($member) ? $member->email : old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Номер телефона</label>
                        <input type="text" name="phone" placeholder="Введите номер" class="form-control" value="{{ isset($member) ? $member->phone : old('phone') }}" required pattern="+[0-9]{6,12}">
                    </div>
                    <div class="form-group">
                        <label for="fullName">Ф.И.О</label>
                        <input type="text" name="fullName" placeholder="Введите Ф.И.О" class="form-control" value="{{ isset($member) ? $member->fullName : old('fullName') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Должность участника</label>
                        <input type="text" name="position" placeholder="Введите должность" class="form-control" value="{{ isset($member) ? $member->position : old('position') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="ex_id">Выставка</label>
                        <select class="form-control @error('ex_id') is-invalid @enderror" name="ex_id">
                            @foreach($exhibitions as $key => $label)
                                <option value="{{ $key }}" @if(isset($member) && $key == $member->ex_id) selected @endif>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if(isset($member->exhibition->form))
                        @foreach($member->exhibition->form as $key => $input)
    {{--                        <b>{{ $input->getLocaleField('title') }}: </b>--}}
                            @if($key == 0)
                                <div class="form-group">
                                    <label for="">{{ $input->getLocaleField('title') }}</label>
                                    <input type="text" name="input_{{ $key + 1}}" placeholder="{{ $input->getLocaleField('title') }}" value="{{ isset($member) ? $member->input_1 : old('input_1') }}" class="form-control">
                                </div>
                            @elseif($key == 1)
                                <div class="form-group">
                                    <label for="">{{ $input->getLocaleField('title') }}</label>
                                    <input type="text" name="input_{{ $key + 1}}" placeholder="{{ $input->getLocaleField('title') }}" value="{{ isset($member) ? $member->input_2 : old('input_2') }}" class="form-control">
                                </div>
                            @elseif($key == 2)
                                <div class="form-group">
                                    <label for="">{{ $input->getLocaleField('title') }}</label>
                                    <input type="text" name="input_{{ $key + 1}}" placeholder="{{ $input->getLocaleField('title') }}" value="{{ isset($member) ? $member->input_3 : old('input_3') }}" class="form-control">
                                </div>
                            @elseif($key == 3)
                                <div class="form-group">
                                    <label for="">{{ $input->getLocaleField('title') }}</label>
                                    <input type="text" name="input_{{ $key + 1}}" placeholder="{{ $input->getLocaleField('title') }}" value="{{ isset($member) ? $member->input_4 : old('input_4') }}" class="form-control">
                                </div>
                            @else
                                <br>
                            @endif
                        @endforeach
                    @endif

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Отменить</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
