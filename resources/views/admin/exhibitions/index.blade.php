@extends('admin.layouts.layout')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Выставки</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="{{ route('exhibitions.create') }}" class="btn btn-primary mb-3">Добавить выставку</a>
                    @if(count($exhibitions))
                        @php $i = 1 @endphp
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Название</th>
                                    <th>Дата начала</th>
                                    <th>Дата завершения</th>
                                    <th>Поля для регистрации</th>
                                    <th>Ссылка</th>
                                    <th>Статус</th>
                                    <th>Участники</th>
                                    <th style="width: 40px">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($exhibitions as $exhibition)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $exhibition->title }}</td>
                                        <td>{{ $exhibition->dateStart() }}</td>
                                        <td>{{ $exhibition->dateFinish() }}</td>
                                        <td>- {!! $exhibition->form->pluck('translation.title')->join('<br> - ') !!}</td>
                                        <td><a href="{{ url($exhibition->link) }}" target="_blank">{{ $exhibition->link }}</a></td>
                                        <td>{{ $exhibition->getStatus() }}</td>
                                        <td>{{ $exhibition->members->count() }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('exhibitions.edit', ['exhibition' => $exhibition->id]) }}" class="btn btn-sm float-left mr-2">
{{--                                                    <i class="fas fa-pencil-alt"></i>--}}
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <form action="{{ route('exhibitions.destroy', ['exhibition' => $exhibition->id])  }}" method="post" class="float-left">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm" onclick="return confirm('Подтвердите удаление')">
{{--                                                        <i class="fas fa-trash-alt"></i>--}}
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
                        {{ $exhibitions->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

