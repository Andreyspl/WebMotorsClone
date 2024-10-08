@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Meus Anúncios</h1>
    @foreach($ads as $ad)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">{{ $ad->title }}</h5>
                <p class="card-text">{{ $ad->description }}</p>
                <p class="card-text"><strong>Tipo:</strong> {{ $ad->vehicle_type }}</p>
                <p class="card-text"><strong>Preço:</strong> R$ {{ $ad->price }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $ad->is_approved ? 'Aprovado' : 'Aguardando Aprovação' }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection