@if (isset($project->id))
<form action="{{ route('users.update', ["user" => $user]) }}" method="post">
    @csrf
    @method("PUT")
@else
<form action="{{ route('users.store') }}" method="post">
    @csrf
@endif
    <div class="card-body">
        <div class="card-title">
            @if (isset($user->id))
                <h5>Alterar Usuário</h5>
            @else
                <h5>Novo Usuário</h5>
            @endif
        </div>
        @if (isset($errors))

        @endif
        <div class="row">
            <div class="col-lg-3">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $user->name ?? old('name') }}">
            </div>
            <div class="col-lg-3">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" required value="{{ $user->email ?? old('email') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-lg-3">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="col-lg-3">
            <input type="submit" value="Salvar" name="btn_submit" class="btn btn-success">
        </div>
    </div>
</form>
