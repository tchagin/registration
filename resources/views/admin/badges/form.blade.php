<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ !isset($setting) ? 'Создать настройки' : 'Изменить настройки' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ !isset($setting) ? route('badge-settings.store') : route('badge-settings.update', ['badge_setting' => $setting->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($setting))  @method('PUT') @endif

                    <div class="form-group">
                        <label for="height">Длина</label>
                        <input type="text" name="height" class="form-control" value="{{ isset($setting) ? $setting->height : old('eight') }}">
                    </div>

                    <div class="form-group">
                        <label for="width">Ширина</label>
                        <input type="text" name="width" class="form-control" value="{{ isset($setting) ? $setting->width : old('>width') }}">
                    </div>

                    <div class="form-group">
{{--                        <label for="">Отобразить QR-Код?</label>--}}
                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="status" value="off" />
                            <input type="checkbox" class="custom-control-input" id="customCheck1" value="on" name="status" @if(isset($setting) && $setting->status == 'on') checked @endif>
                            <label class="custom-control-label" for="customCheck1">Отобразить QR-Код?</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="checkbox">Книжная</label>
                        <input type="hidden" value="vertically" name="orientation">
                        <input type="checkbox" class="checkbox" id="checkbox" value="horizontally" name="orientation" @if(isset($setting) && $setting->orientation == 'horizontally') checked @endif>
                        <label for="checkbox">Альбомная</label>
                    </div>

                    <button type="submit" class="btn btn-success">Сохранить</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">Отменить</a>
                </form>
            </div>
        </div>
    </div>
</div>
