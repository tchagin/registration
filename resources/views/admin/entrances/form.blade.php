<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ !isset($entrance) ? 'Добавить вход' : 'Редактировать вход' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ !isset($entrance) ? route('entrances.store') : route('entrances.update', ['entrance' => $entrance->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($entrance))  @method('PUT') @endif
                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ isset($entrance) ? $entrance->title : old('title') }}">
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
