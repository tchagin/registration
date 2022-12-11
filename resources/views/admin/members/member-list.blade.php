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
                    <div class="table-responsive">
                        <table class="display dataTable" id="member-list" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Ф.И.О</th>
                                    <th>E-mail</th>
                                    <th>Название компании</th>
                                    <th>Номер телефона</th>
                                    <th>Должность участника</th>
                                    <th>Страна</th>
                                    <th>Выставка</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

