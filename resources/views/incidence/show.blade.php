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
                        
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $incidence->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Area Id:</strong>
                            {{ $incidence->area_id }}
                        </div>
                        <div class="form-group">
                            <strong>Category Id:</strong>
                            {{ $incidence->category_id }}
                        </div>
                        <div class="form-group">
                            <strong>Location Id:</strong>
                            {{ $incidence->location_id }}
                        </div>
                        <div class="form-group">
                            <strong>State Id:</strong>
                            {{ $incidence->state_id }}
                        </div>
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $incidence->title }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $incidence->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
