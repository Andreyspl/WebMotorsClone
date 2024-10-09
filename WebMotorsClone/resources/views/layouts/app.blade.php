<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Webmotors Clone')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Webmotors Clone" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ads.user_ads') }}">Meus Anúncios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ads.create') }}">Criar Anúncio</a>
                    </li>
                    @if(auth()->check() && auth()->user()->email == 'admin@admin.com')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ads.admin_review') }}">Anúncios Pendentes</a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="ms-auto position-relative">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Entrar</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Criar conta</a>
                    
                </div>
            </div>
                @else
                    <a class="btn btn-secondary ms-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    @yield('content')

    <div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filterOffcanvasLabel">Filtros</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('ads.index') }}" method="GET">
                <!-- Reutiliza os mesmos filtros do filtro lateral -->
                <div class="mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Pesquisar por título" value="{{ request('search') }}">
                </div>
                <div class="mb-3">
                    <input type="number" name="min_price" class="form-control" placeholder="Preço mínimo" value="{{ request('min_price') }}">
                </div>
                <div class="mb-3">
                    <input type="number" name="max_price" class="form-control" placeholder="Preço máximo" value="{{ request('max_price') }}">
                </div>
                <div class="mb-3">
                    <input type="number" name="min_year" class="form-control" placeholder="Ano mínimo" value="{{ request('min_year') }}">
                </div>
                <div class="mb-3">
                    <input type="number" name="max_year" class="form-control" placeholder="Ano máximo" value="{{ request('max_year') }}">
                </div>
                <div class="mb-3">
                    <input type="number" name="min_mileage" class="form-control" placeholder="Quilometragem mínima" value="{{ request('min_mileage') }}">
                </div>
                <div class="mb-3">
                    <input type="number" name="max_mileage" class="form-control" placeholder="Quilometragem máxima" value="{{ request('max_mileage') }}">
                </div>
                <div class="mb-3">
                    <select class="form-select" name="transmission">
                        <option value="">Transmissão</option>
                        <option value="Automático" {{ request('transmission') == 'Automático' ? 'selected' : '' }}>Automático</option>
                        <option value="Manual" {{ request('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="single_owner">
                        <option value="">Único Dono</option>
                        <option value="1" {{ request('single_owner') == '1' ? 'selected' : '' }}>Sim</option>
                        <option value="0" {{ request('single_owner') == '0' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" name="color" class="form-control" placeholder="Cor" value="{{ request('color') }}">
                </div>
                <button type="submit" class="btn btn-primary w-100">Aplicar Filtros</button>
            </form>
        </div>
    </div>

    <script>
        function toggleFilterVisibility() {
            const filterBody = document.getElementById('filterBody');
            if (filterBody.style.display === 'none') {
                filterBody.style.display = 'block';
            } else {
                filterBody.style.display = 'none';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>