@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Настройки бэйджа</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Настройки</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
{{--                    @php--}}
{{--                        $last = $settings->last();--}}
{{--                    @endphp--}}
                    @if(isset($settings))
                    <a href="{{ route('badge-settings.edit', ['badge_setting' => $settings->id]) }}" class="btn btn-primary mb-2">Изменить настройки</a>
                    @else
                        <a href="{{ route('badge-settings.create') }}" class="btn btn-primary mb-2">Создать настройки</a>
                    @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Высота</th>
                                    <th>Ширина</th>
                                    <th>Ориентация</th>
                                    <th>Видимость QR-кода</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $settings->height }}</td>
                                        <td>{{ $settings->width }}</td>
                                        <td>{{ $settings->orientation }}</td>
                                        <td>{{ $settings->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection

