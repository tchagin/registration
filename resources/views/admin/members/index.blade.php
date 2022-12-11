@extends('admin.layouts.layout')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Зарегистрированные</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form class="custom-form">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Выставка</label>
                            <div class="col-sm-10">
                                <select class="form-control fwb" name="ex_id">
                                    <option value="">-</option>
                                    @foreach($exhibitions as $key => $label)
                                        <option value="{{ $key }}" @if(isset($key) && $key == Request::input('ex_id')) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary mb-2 mr-1">Найти</button>
                            <button type="button" class="btn btn-secondary mb-2" onclick="location.href='{{ route('members.index') }}'">Сбросить</button>
                        </div>
                    </form>

{{--                    <button class="btn btn-primary mb-3" id="downloadexcel">Скачать таблицу</button>--}}

                    @if(count($members))

                        <form action="{{ route('selectedAddVisitor') }}">
                            @method('PUT')
                            <div id="action-with-selected" style="display: none">
                                <div class="form-group row">
                                    <label for="entrance" class="col-sm-2 col-form-label">Выбрать вход</label>
                                    <div class="col-sm-10">
                                        <select name="entrance" class="form-control fwb">
                                            <option value="">-</option>
                                            @foreach($entrances as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary mb-2">Изменить статус на "Посетитель"</button>
                                </div>
                            </div>

                            @php $i = 1 @endphp

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="data-table" data-cols-width="4,40,20,30,40,20,30,20,30">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px"></th>
                                        <th style="width: 10px">#</th>
                                        <th data-f-bold="true">Ф.И.О</th>
                                        <th data-f-bold="true">E-mail</th>
                                        <th data-f-bold="true">Название компании</th>
                                        <th data-f-bold="true">Индустрия</th>
                                        <th data-f-bold="true">Номер телефона</th>
                                        <th data-f-bold="true">Должность участника</th>
                                        <th data-f-bold="true">Страна</th>
                                        <th data-f-bold="true">Выставка</th>
    {{--                                    <th data-f-bold="true">Откуда узнали</th>--}}
                                        <th data-exclude="true">Доп поля</th>
                                        <th data-exclude="true">Статус</th>
                                        <th data-exclude="true" style="width: 40px">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td><input type="checkbox" class="checkMembers" name="changeStatus[]" value="{{ $member->id }}"></td>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $member->fullName }}</td>
                                            <td>{{ $member->email }}</td>
                                            <td>{{ $member->title }}</td>
                                            <td>
                                                @if($member->userIndustry)
                                                    {{ $member->userIndustry->getLocaleField('title') }}</td>
                                                @endif
                                            <td>{{ $member->phone }}</td>
                                            <td>{{ $member->position }}</td>
                                            <td>{{ $member->userCountry->countryname }}</td>
                                            <td>
                                                @if($member->exhibition)
                                                    {{ $member->exhibition->title }}
                                                @endif
                                            </td>
                                            <td data-exclude="true">
                                                @if(isset($member->exhibition->form))
                                                    @foreach($member->exhibition->form as $key => $input)
                                                    <b>{{ $input->getLocaleField('title') }}: </b>
                                                        @if($key == 0)
                                                            {{ $member->input_1 }}<br>
                                                        @elseif($key == 1)
                                                            {{ $member->input_2 }}<br>
                                                        @elseif($key == 2)
                                                            {{ $member->input_3 }}<br>
                                                        @elseif($key == 3)
                                                            {{ $member->input_4 }}<br>
                                                        @else
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td data-exclude="true">
                                                @if($member->visitor == 1)
                                                    Посетитель
                                                @else
                                                    @if(auth()->user()->position != 'client')
                                                    <form action="{{ route('addVisitor', ['member' => $member->id]) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm change-status">Изменить статус</button>
                                                    </form>
                                                    @endif
                                                @endif
                                            </td>
                                            <td data-exclude="true">
                                                <div class="d-flex">
                                                    <a href="{{ route('members.show', ['member' => $member->slug]) }}" target="_blank" class="btn btn-sm float-left mr-2"><i class="far fa-eye"></i></a>
                                                    @if(auth()->user()->position != 'client')
                                                        <a href="{{ route('members.edit', ['member' => $member->id]) }}" class="btn btn-sm float-left mr-2">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
{{--                                                        <form action="{{ route('members.destroy', ['member' => $member->id])  }}" method="post" class="float-left">--}}
{{--                                                            @csrf--}}
{{--                                                            @method('DELETE')--}}
{{--                                                            <button type="submit" class="btn btn-sm" onclick="return confirm('Подтвердите удаление')">--}}
{{--                                                                <i class="fa-regular fa-trash-can"></i>--}}
{{--                                                            </button>--}}
{{--                                                        </form>--}}

                                                        <a href="{{ route('customDelete', ['member' => $member->id]) }}" class="btn btn-sm float-left mr-2" rel="nofollow" onclick="return confirm('Подтвердите удаление')">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    @else
                        <p>Пусто</p>
                    @endif
                    <div class="section-paginate">
                        {{ $members->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

