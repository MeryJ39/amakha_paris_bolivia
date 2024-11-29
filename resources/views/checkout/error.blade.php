<!-- resources/views/checkout/error.blade.php -->

@extends('layouts.app') <!-- O la plantilla que estés usando -->

@section('content')
    <div class="container">
        <div class="alert alert-danger">
            <h4 class="alert-heading">Error al procesar el pago</h4>
            <p>{{ $errorMessage }}</p>
            <hr>
            <p class="mb-0">Por favor, inténtalo nuevamente o contacta con soporte si el problema persiste.</p>
        </div>
    </div>
@endsection
