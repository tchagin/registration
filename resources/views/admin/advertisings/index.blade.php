@extends('admin.layouts.layout')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Откуда узнали о выставке</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row advertisings">
                    @if(count($advertisings))
                        @foreach($advertisings as $advertising)
                        <div class="col-sm-6">
                            <div class="d-flex input-block-wrap">
                                <div class="input-block">
                                    {{ $advertising->getLocaleField('title') }}
                                    <span></span>
                                </div>
                                <table>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('advertising.edit', ['advertising' => $advertising->id]) }}" class="btn btn-sm float-left mr-2">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('advertising.destroy', ['advertising' => $advertising->id])  }}" method="post" class="float-left">
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
                        </div>
                        @endforeach
                    @endif
                        <div class="col-sm-6">
                            <a href="{{ route('advertising.create') }}" class="create-block">
                                <div class="d-flex input-block-wrap">
                                    <div class="input-block">
                                        +
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

