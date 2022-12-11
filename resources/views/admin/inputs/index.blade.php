@extends('admin.layouts.layout')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Формы</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row inputs">
                        <div class="col-sm-12">
                            <div class="row justify-content-center">
                                <div class="col-sm-6">
                                    <div class="input-block-wrap system pl-0">
                                        <div class="info">
                                            <div class="label">Страна</div>
                                            <div class="status ">Системный</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="input-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-block-wrap system">
                                        <div class="info">
                                            <div class="label">Ф.И.О</div>
                                            <div class="status ">Системный</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="input-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block-wrap system">
                                        <div class="info">
                                            <div class="label">Компания</div>
                                            <div class="status ">Системный</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="input-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block-wrap system">
                                        <div class="info">
                                            <div class="label">Телефон</div>
                                            <div class="status ">Системный</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="input-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block-wrap system">
                                        <div class="info">
                                            <div class="label">Должность</div>
                                            <div class="status ">Системный</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="input-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block-wrap system">
                                        <div class="info">
                                            <div class="label">E-mail</div>
                                            <div class="status ">Системный</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="input-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block-wrap system">
                                        <div class="info">
                                            <div class="label">Индустрия</div>
                                            <div class="status ">Системный</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="input-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($inputs))
                            @foreach($inputs as $input)
                            <div class="col-sm-6">
                                <div class="input-block-wrap">
                                    <div class="info">
                                        <div class="label">{{ $input->getLocaleField('title') }}</div>
                                        <div class="status {{ $input->status }}">{{ $input->getStatus() }}</div>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <div class="input-block"></div>
                                        <table>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('inputs.edit', ['input' => $input->id]) }}" class="btn btn-sm float-left mr-2">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                    <form action="{{ route('inputs.destroy', ['input' => $input->id])  }}" method="post" class="float-left">
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
                                    @if(count($input->exhibition))
                                    <div class="ex-list">
                                        @foreach($input->exhibition as $exhibition)
                                            {{ $exhibition->title }},
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @endif
                        <div class="col-sm-6">
                            <a href="{{ route('inputs.create') }}" class="create-block">
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

