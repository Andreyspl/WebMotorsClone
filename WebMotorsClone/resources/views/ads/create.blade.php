@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Novo Anúncio</h1>
    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group mt-3">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="vehicle_type">Tipo de Veículo</label>
            <select class="form-control" id="vehicle_type" name="vehicle_type" required>
                <option value="Carro">Carro</option>
                <option value="Moto">Moto</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="price">Preço</label>
            <input type="text" class="form-control" id="price" name="price" required oninput="validatePrice(this)">
        </div>
        <div class="form-group mt-3">
            <label for="mileage">Quilometragem</label>
            <input type="text" class="form-control" id="mileage" name="mileage" required oninput="validateMileage(this)">
        </div>
        <div class="form-group mt-3">
            <label for="year">Ano</label>
            <input type="text" class="form-control" id="year" name="year" required oninput="validateYear(this)">
        </div>
        <div class="form-group mt-3">
            <label for="license_plate_start">Início da Placa</label>
            <input type="text" class="form-control" id="license_plate_start" name="license_plate_start" maxlength="3" required>
        </div>
        <div class="form-group mt-3">
            <label for="transmission">Transmissão</label>
            <select class="form-control" id="transmission" name="transmission" required>
                <option value="Automático">Automático</option>
                <option value="Manual">Manual</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="single_owner">Único Dono</label>
            <select class="form-control" id="single_owner" name="single_owner" required>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="color">Cor</label>
            <input type="text" class="form-control" id="color" name="color" required>
        </div>
        <div class="form-group mt-3">
            <label for="photos">Fotos (opcional)</label>
            <input type="file" class="form-control" id="photos" name="photos[]" multiple>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Criar Anúncio</button>
    </form>
</div>

<script>
    function validatePrice(input) {
        let value = input.value.replace(',', '.');
        value = value.replace(/[^\d.]/g, '');
        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts[1];
        }
        if (parts[1] && parts[1].length > 2) {
            value = parts[0] + '.' + parts[1].substring(0, 2);
        }
        input.value = value.replace('.', ',');
    }

    function validateMileage(input) {
        let value = input.value.replace(',', '.');
        value = value.replace(/[^\d.]/g, '');
        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts[1];
        }
        if (parts[1] && parts[1].length > 2) {
            value = parts[0] + '.' + parts[1].substring(0, 2);
        }
        input.value = value.replace('.', ',');
    }

    function validateYear(input) {
        input.value = input.value.replace(/[^0-9]/g, '').substring(0, 4);
    }
</script>
@endsection
