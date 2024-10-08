@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Revisão de Anúncios</h1>
    @foreach($ads as $ad)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">{{ $ad->title }}</h5>
                <p class="card-text">{{ $ad->description }}</p>
                <p class="card-text"><strong>Tipo:</strong> {{ $ad->vehicle_type }}</p>
                <p class="card-text"><strong>Preço:</strong> R$ {{ $ad->price }}</p>
                @if($ad->photos)
                    @foreach(json_decode($ad->photos) as $photo)
                        <img src="{{ asset('storage/' . $photo) }}" class="img-fluid mt-2" alt="Foto do anúncio">
                    @endforeach
                @endif
                <form action="{{ route('ads.approve', $ad->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Aprovar</button>
                </form>
                <form action="{{ route('ads.reject', $ad->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Rejeitar</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection