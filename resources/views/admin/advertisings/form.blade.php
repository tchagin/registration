<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ !isset($advertising) ? 'Добавить рекламу' : 'Редактировать рекламу' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ !isset($advertising) ? route('advertising.store') : route('advertising.update', ['advertising' => $advertising->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($advertising))  @method('PUT') @endif

                    <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                        @foreach(\App\Http\Middleware\Localization::LOCALS as $locale)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  @if($locale=='ru') active @endif" id="{{$locale}}-tab" data-toggle="tab" href="#{{$locale}}" role="tab" aria-controls="{{$locale}}">{{$locale}}</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach(\App\Http\Middleware\Localization::LOCALS as $locale)
                            <div class="tab-pane @if($locale=='ru') active @endif" id="{{$locale}}" role="tabpanel" aria-labelledby="{{$locale}}-tab">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="data[{{$locale}}][title]" class="form-control @error("data.{$locale}.title") is-invalid @enderror" value="{{ isset($advertising) ? $advertising->getLocaleField('title', $locale) : old("data.{$locale}.title") }}">
                                </div>
                            </div>
                        @endforeach
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
