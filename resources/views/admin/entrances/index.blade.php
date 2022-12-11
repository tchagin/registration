@extends('admin.layouts.layout')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Входы на выставку</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="{{ route('entrances.create') }}" class="btn btn-primary mb-3">Добавить вход</a>
                    @if(count($entrances))
                        @php $i = 1 @endphp
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Название</th>
                                    <th>Администратор</th>
                                    <th style="width: 40px">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($entrances as $entrance)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $entrance->title }}</td>
                                        <td>{{ isset($entrance->admin) ? $entrance->admin->name : '' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('entrances.edit', ['entrance' => $entrance->id]) }}" class="btn btn-sm float-left mr-2">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <form action="{{ route('entrances.destroy', ['entrance' => $entrance->id])  }}" method="post" class="float-left">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm" onclick="return confirm('Подтвердите удаление')">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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

