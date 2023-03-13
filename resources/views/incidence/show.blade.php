@extends('layouts.app')

@section('template_title')
    {{ $incidence->name ?? 'Show Incidence' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Incidence</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('incidences.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <h3>Detalles de la incidencia</h1>
                        <p>Usuario: {{ $incidence->user->name }}</p>
                        <p>Área: {{ $incidence->area->name }}</p>
                        <p>Categoría: {{ $incidence->category->name }}</p>
                        <p>Ubicación: {{ $incidence->location->name }}</p>
                        <p>Estado: {{ $incidence->state->name }}</p>
                        <p>Título: {{ $incidence->title }}</p>
                        <p>Descripción: {{ $incidence->description }}</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
