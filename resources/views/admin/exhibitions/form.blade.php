<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ !isset($exhibition) ? 'Добавить выставку' : 'Редактировать выставку' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ !isset($exhibition) ? route('exhibitions.store') : route('exhibitions.update', ['exhibition' => $exhibition->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($exhibition))  @method('PUT') @endif
                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ isset($exhibition) ? $exhibition->title : old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="dateStart">Дата начала</label>
                        <input type="date" name="dateStart" id="dateStart" class="form-control" value="{{ isset($exhibition) ? $exhibition->dateStart : old('dateStart') }}">
                    </div>

                    <div class="form-group">
                        <label for="dateFinish">Дата завершения</label>
                        <input type="date" name="dateFinish" id="dateFinish" class="form-control" value="{{ isset($exhibition) ? $exhibition->dateFinish : old('dateFinish') }}">
                    </div>

                    <div class="form-group">
                        <label for="forms">Дополнительные поля для регистрации</label>
                        <select name="forms[]" id="categories" class="select2" multiple="multiple"
                                data-placeholder="Выбор тегов" style="width: 100%;">
                            @foreach($forms as $key => $label)
                                <option value="{{ $key }}" @if(isset($exhibition) && in_array($key, $exhibition->form->pluck('id')->all())) selected @endif>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="logo">Логотип</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="logo"
                                       class="custom-file-input" multiple>
                                <label class="custom-file-label" for="thumbnails">Выбрать файл</label>
                            </div>
                        </div>
                        @if(isset($exhibition))
                            <div><img src="{{ $exhibition->getImage() }}" alt="" class="img-thumbnail mt-2" width="150px"></div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="link">Ссылка</label>
                        <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ isset($exhibition) ? $exhibition->link : old('link') }}">
                    </div>

                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select class="form-control @error('service') is-invalid @enderror" name="status">
                                <option value="active" @if(isset($exhibition) && $exhibition->status == 'active') selected @endif>Действующий</option>
                                <option value="disable" @if(isset($exhibition) && $exhibition->status == 'disable') selected @endif>Блокированный</option>
                        </select>
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
