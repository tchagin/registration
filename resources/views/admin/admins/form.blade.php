<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ !isset($admin) ? 'Добавить пользователя' : 'Редактировать пользователя' }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ !isset($admin) ? route('admins.store') : route('admins.update', ['admin' => $admin->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @if(isset($admin))  @method('PUT') @endif
                    <div class="form-group">
                        <label for="name">Логин</label>
                        <input type="text" name="name" class="form-control @error('title') is-invalid @enderror" value="{{ isset($admin) ? $admin->name : old('name') }}" autocomplete="off">
                    </div>

                    @if(!isset($admin))
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" class="form-control" placeholder="Пароль" autocomplete="off" required>
                    </div>
                    @else
                        <input type="hidden" name="password">
                    @endif

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" class="form-control" value="{{ isset($admin) && $admin->email ? $admin->email : old('email')  }}">
                    </div>

                    <input type="hidden" name="role" value="operator">
                    <div class="form-group">
                        <label for="role">Роль</label>
                        <select name="position" id="role" class="form-control">
                            <option value="">-</option>
                            @foreach(\App\Models\User::POSITION as $key => $label)
                                @if($key != 'administrator')
                                    <option value="{{ $key }}" @if(isset($admin) && $key == $admin->position) selected @endif>{{ $label }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="entrance">Выбрать вход</label>
                        <select class="form-control @error('ex_id') is-invalid @enderror" name="entrance">
                            @foreach($entrances as $key => $label)
                                <option value="{{ $key }}" @if(isset($admin) && $key == $admin->entrance) selected @endif>{{ $label }}</option>
                            @endforeach
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
