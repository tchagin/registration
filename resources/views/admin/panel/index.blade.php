@extends('admin.layouts.layout')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">QR-панель</h3> }}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="alerts" style="height: 30px">
                        <div class="alert alert-success" id="alert-success" style="display: none;"></div>
                        <div class="alert alert-danger" id="alert-danger" style="display: none;"></div>
                    </div>

                    <div class="scaner">
                        <div class="image">
                            <img src="{{ asset('assets/admin/img/custom/scaner.png') }}" alt="">
                        </div>

                        <div class="wrap">
                            <form action="{{ route('scaner.status') }}" method="post" id="scanerForm">
                                @csrf
                                <button type="submit" class="header" id="button-click">Сканировать</button>
                                <div id="reader"></div>
                                <div class="input-wrap">
                                    <input type="text" name="scaner" class="form-control" id="scaner-code" placeholder="Нажмите для введения" autocomplete="off" autofocus required>
                                </div>
                            </form>
                        </div>

{{--                        <div class="wrap">--}}
{{--                            <form action="{{ route('scaner.status') }}" method="post" id="scanerForm">--}}
{{--                                @csrf--}}
{{--                                <button type="submit" class="header">Сканировать</button>--}}
{{--                                <div class="input-wrap">--}}
{{--                                    <input type="text" name="scaner" class="form-control" id="scaner-code" placeholder="Нажмите для введения" autocomplete="off" autofocus required>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                    </div>

                    <div class="row" id="mobile-scaner">
                        <div class="col mb-5">
                            <div style="width:100%;" id="reader"></div>
                        </div>
                    </div>

                    @if(count($exhibitions))
                    <div class="exhibitions row">
                        @foreach($exhibitions as $exhibition)
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="exhibition-block">
                                    <div class="exhibition-thumbnail">
                                        <img src="{{ $exhibition->getImage() }}" alt="" aria-hidden="true">
                                    </div>
                                    <div class="date">
                                        <p>Дата выставки</p>
                                        <p>{{ $exhibition->dateStart() }} - {{ $exhibition->dateFinish() }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="members">
                                            <div class="title">Посетители</div>
                                            <div class="d-flex align-items-center">
                                                <div class="count">{{ $exhibition->members->where('visitor', 1)->count() }}</div>
                                                <div class="ico"><img src="{{ asset('assets/admin/img/custom/panel-ico-1.png') }}" alt=""></div>
                                            </div>
                                        </div>
                                        <div class="members">
                                            <div class="title">Зарегистрированные</div>
                                            <div class="d-flex align-items-center">
                                                <div class="count">{{ $exhibition->members->count() }}</div>
                                                <div class="ico"><img src="{{ asset('assets/admin/img/custom/panel-ico-2.png') }}" alt=""></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
