@extends('admin.layouts.layout')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Рассылка</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="{{ route('distribution.create') }}" class="btn btn-primary mb-3">Добавить сообщение</a>
                </div>
            </div>
    </section>
@endsection
