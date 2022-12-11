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
                            <h3 class="card-title">Сообщение</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('distribution.store')}}" method="post" enctype="multipart/form-data">
                                @csrf

{{--                                <div class="form-group">--}}
{{--                                    <label for="message">Сообщение</label>--}}
{{--                                    <input type="text" class="form-control" name="message" id="message">--}}
{{--                                </div>--}}
                                <div class="d-flex justify-content-between">
                                    <div id="editor1" contenteditable="true">
                                        <h1>Inline Editing in Action!</h1>
                                        <p>The "div" element that contains this text is now editable.</p>
                                    </div>
                                    <div id="editor2" contenteditable="true">
                                        <h1>Inline Editing in Action!</h1>
                                        <p>The "div" element that contains this text is now editable.</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="file">Excel файл</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file"
                                                   class="custom-file-input" multiple>
                                            <label class="custom-file-label" for="file">Выбрать файл</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary mr-2" disabled>Сохранить</button>
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
