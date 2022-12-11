@extends('admin.layouts.layout')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Пользователи</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="{{ route('admins.create') }}" class="btn btn-primary mb-3">Добавить пользователя</a>
                    @if(count($admins))
                        <div class="row inputs">
                            @foreach($admins as $admin)
                                <div class="col-sm-6">
                                    <div class="input-block-wrap">
                                        <div class="info">
                                            <div class="label">{{ $admin->name }}</div>
                                            <div class="status">{{ $admin->position }}</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="input-block"></div>
                                            <table>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('editAdminPass', ['admin' => $admin->id]) }}" class="btn btn-sm float-left mr-2">
                                                            <i class="fa-solid fa-lock"></i>
                                                        </a>
                                                        <a href="{{ route('admins.edit', ['admin' => $admin->id]) }}" class="btn btn-sm float-left mr-2">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                        <form action="{{ route('admins.destroy', ['admin' => $admin->id])  }}" method="post" class="float-left">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm" onclick="return confirm('Подтвердите удаление')">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </table>
                                        </div>
                                        <div class="ex-list">
{{--                                            {{ $admin->entrance_id->title }}--}}
                                            {{ isset($admin->entrance) ? $admin->entrance_id->title : 'Вход не определён' }}
                                        </div>
{{--                                            @if(count($input->exhibition))--}}
{{--                                                <div class="ex-list">--}}
{{--                                                    @foreach($input->exhibition as $exhibition)--}}
{{--                                                        {{ $exhibition->title }},--}}
{{--                                                    @endforeach--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Пусто</p>
                    @endif
                    <div class="section-paginate">
{{--                        {{ $entrances->links('vendor.pagination.bootstrap-4') }}--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

