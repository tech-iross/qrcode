<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','QR Setup')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f8f9fa; }
        .card-stage.done { border-left:6px solid #28a745; }
        .card-stage.pending { border-left:6px solid #ffc107; }
        .qr-container { width:100%; max-width:360px; margin:auto; }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('flow.index') }}">QR CheckPoint</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample" aria-controls="navbarsExample" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExample">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @auth
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.categorias.index') }}">Categorias</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('colaboradores.index') }}">Colaboradores</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('produtos.index') }}">Produtos</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.checkpoints.index') }}">CheckPoints</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Usuários</a></li>
        @endauth
      </ul>
      @auth
      <div class="d-flex align-items-center gap-2">
        <span class="navbar-text text-white">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" class="m-0">
          @csrf
          <button class="btn btn-outline-light btn-sm">Sair</button>
        </form>
      </div>
      @else
      <div class="d-flex">
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
      </div>
      @endauth
    </div>
  </div>
</nav>
<div class="container mb-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>