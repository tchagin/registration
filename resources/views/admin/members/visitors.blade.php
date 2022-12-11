@extends('admin.layouts.layout')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Посетители</h3>
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

{{--                                <input type="text" value="{{Request::input('filters.like.fullname')}}" class="form-control" id="title" name="filters[like][title]">--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary mb-2 mr-1">Найти</button>
                            <button type="button" class="btn btn-secondary mb-2" onclick="location.href='{{ route('members.index') }}'">Сбросить</button>
                        </div>
                    </form>

                    <button class="btn btn-primary mb-3" id="downloadexcel">Скачать таблицу</button>
                    @if(count($members))
                        @php $i = 1 @endphp
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="data-table" data-cols-width="4,40,20,30,40,20,30,20,30">
{{--                            <table class="table table-striped table-bordered" id="tbl_exporttable_to_xls">--}}
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th data-f-bold="true">Ф.И.О</th>
                                    <th data-f-bold="true">E-mail</th>
                                    <th data-f-bold="true">Название компании</th>
                                    <th data-f-bold="true">Индустрия</th>
                                    <th data-f-bold="true">Номер телефона</th>
                                    <th data-f-bold="true">Должность участника</th>
                                    <th data-f-bold="true">Страна</th>
                                    <th data-f-bold="true">Выставка</th>
                                    <th data-exclude="true">Доп поля</th>
                                    <th data-f-bold="true">Вход</th>
                                    <th data-exclude="true" style="width: 40px">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $member)
                                    <tr>
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
{{--                                        <td>{{ $member->exhibition->title }}</td>--}}
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
{{--                                        <td>{{ $member }}</td>--}}
                                        <td>{{ isset($member->entrance_id) ? $member->entrance->title : '' }}</td>
                                        <td data-exclude="true">
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('members.show', ['member' => $member->slug]) }}" target="_blank" class="btn btn-sm float-left"><i class="far fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button onclick="prevPage()" id="btn_prev" class="btn btn-primary">Назад</button>
                            <button onclick="nextPage()" id="btn_next" class="btn btn-primary">Вперёд</button>
                            Страница: <span id="page"></span>
                        </div>
                    @else
                        <p>Пусто</p>
                    @endif
{{--                    {{ $members->links('vendor.pagination.bootstrap-4') }}--}}
                </div>
            </div>
        </div>
    </section>

    <script>
        // пагинация
        var current_page = 1;
        var records_per_page = 100;
        var l = document.getElementById("data-table").rows.length;

        function prevPage() {
            if (current_page > 1) {
                current_page--;
                changePage(current_page);
            }
        }

        function nextPage() {
            if (current_page < numPages()) {
                current_page++;
                changePage(current_page);
            }
        }

        function changePage(page) {
            var btn_next = document.getElementById("btn_next");
            var btn_prev = document.getElementById("btn_prev");
            var listing_table = document.getElementById("data-table");
            var page_span = document.getElementById("page");

            // Validate page
            if (page < 1) page = 1;
            if (page > numPages()) page = numPages();

            [...listing_table.getElementsByTagName("tr")].forEach((tr) => {
                tr.style.display = "none"; // reset all to not display
            });
            listing_table.rows[0].style.display = ""; // display the title row

            for (
                var i = (page - 1) * records_per_page + 1;
                i < page * records_per_page + 1;
                i++
            ) {
                if (listing_table.rows[i]) {
                    listing_table.rows[i].style.display = "";
                } else {
                    continue;
                }
            }

            page_span.innerHTML = page + "/" + numPages();

            if (page == 1) {
                btn_prev.style.visibility = "hidden";
            } else {
                btn_prev.style.visibility = "visible";
            }

            if (page == numPages()) {
                btn_next.style.visibility = "hidden";
            } else {
                btn_next.style.visibility = "visible";
            }
        }

        function numPages() {
            return Math.ceil((l - 1) / records_per_page);
        }

        window.onload = function () {
            changePage(current_page);
        };
    </script>
@endsection

