@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Filtros</h5>
                    <button class="btn btn-sm btn-outline-secondary" type="button" onclick="toggleFilterVisibility()"><i class="fas fa-minus"></i></button>
                </div>
                <div class="card-body" id="filterBody">
                    <form action="{{ route('ads.index') }}" method="GET">
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
        </div>
        <div class="col-lg-9">
            <div class="d-flex justify-content-between mb-3">
                <h1 class="h3">Anúncios</h1>
                <button class="btn btn-secondary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">
                    <i class="fas fa-filter"></i> Filtros
                </button>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @if(isset($ads) && count($ads) > 0)
                @foreach($ads as $ad)
                    <div class="col">
                        <div class="card h-100">
                            @if($ad->photos)
                                <img src="{{ Storage::url(json_decode($ad->photos)[0]) }}" class="card-img-top" alt="Foto do anúncio">
                            @else
                                <img src="/images/default-car.jpg" class="card-img-top" alt="Foto não disponível">
                            @endif
                            <div class="card-body">
                                <h5 class="ad-card-title">{{ $ad->title }}</h5>
                                <p class="ad-card-price">R$ {{ number_format($ad->price, 2, ',', '.') }}</p>
                                <p class="card-text mb-1"><strong>Tipo:</strong> {{ $ad->vehicle_type }}</p>
                                <p class="card-text mb-1"><strong>Ano:</strong> {{ $ad->year }}</p>
                                <p class="card-text mb-1"><strong>Quilometragem:</strong> {{ number_format($ad->mileage, 0, ',', '.') }} km</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
            <div class="mt-4">
                @if(isset($ads) && $ads instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $ads->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection