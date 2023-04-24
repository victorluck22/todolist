@if (isset($user->id))
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
            <pre>
                @php
                    //print_r($errors);
                @endphp
            </pre>
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
            <div class="col-lg-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="" {{ ($user->status ?? "") == 0  ? 'selected' : '' }}>SELECIONE</option>
                    <option value="1" {{ ($user->status ?? "") == 1  ? 'selected' : '' }}>ATIVO</option>
                    <option value="2" {{ ($user->status ?? "") == 2  ? 'selected' : '' }}>CANCELADO</option>
                </select>
            </div>
        </div>
        @if (!isset($user))
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
        @endif
    </div>
    <div class="card-footer">
        <div class="col-lg-3">
            <input type="submit" value="Salvar" name="btn_submit" class="btn btn-success">
        </div>
    </div>
</form>
