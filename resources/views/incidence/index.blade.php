@extends('layouts.app')

@section('template_title')
    Incidence
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Incidence') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('incidences.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>User Id</th>
										<th>Area Id</th>
										<th>Category Id</th>
										<th>Location Id</th>
										<th>State Id</th>
										<th>Title</th>
										<th>Description</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($incidences as $incidence)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $incidence->user->name }}</td>
											<td>{{ $incidence->area->name }}</td>
											<td>{{ $incidence->category->name }}</td>
											<td>{{ $incidence->location->name }}</td>
											<td>{{ $incidence->state->name }}</td>
											<td>{{ $incidence->title }}</td>
											<td>{{ $incidence->description }}</td>

                                            <td>
                                                <form action="{{ route('incidences.destroy',$incidence->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('incidences.show',$incidence->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('incidences.edit',$incidence->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $incidences->links() !!}
            </div>
        </div>
    </div>
@endsection
