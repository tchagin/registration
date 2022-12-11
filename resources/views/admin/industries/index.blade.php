@extends('admin.layouts.layout')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Индустрии</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="{{ route('industries.create') }}" class="btn btn-primary mb-3">Добавить индустрию</a>
                    @if(count($industries))
                        @php $i = 1 @endphp
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Название</th>
                                    <th>Выставки</th>
                                    <th style="width: 40px">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($industries as $industry)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $industry->getLocaleField('title') }}</td>
                                        <td>- {!! $industry->exhibitions->pluck('title')->join('<br> - ') !!}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('industries.edit', ['industry' => $industry->id]) }}" class="btn btn-sm float-left mr-2">
{{--                                                    <i class="fas fa-pencil-alt"></i>--}}
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <form action="{{ route('industries.destroy', ['industry' => $industry->id])  }}" method="post" class="float-left">
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
                        {{ $industries->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

