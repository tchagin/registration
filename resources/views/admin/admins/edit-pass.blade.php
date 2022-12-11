@extends('admin.layouts.layout')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Изменить пароль пользователя {{ $admin->name }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('storeAdminPass', ['admin' => $admin->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="password">Введите новый пароль</label>
                                    <input type="text" name="password" class="form-control" autocomplete="off">
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Отменить</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
@endsection
