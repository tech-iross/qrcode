@csrf
<div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">E-mail</label>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Senha {{ isset($user) ? '(deixe em branco para manter)' : '' }}</label>
    <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
</div>
<div class="mb-3">
    <label class="form-label">Confirmar Senha</label>
    <input type="password" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
</div>
<button class="btn btn-success">Salvar</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
