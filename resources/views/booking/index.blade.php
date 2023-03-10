@extends('layouts.app')

@section('template_title')
    Booking
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Booking') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Location Id</th>
										<th>State Id</th>
										<th>Date</th>
										<th>Starttime</th>
										<th>Endtime</th>
										<th>Numpeople</th>
										<th>Room</th>
										<th>Description</th>
										<th>Comment</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $booking->user_id }}</td>
											<td>{{ $booking->area_id }}</td>
											<td>{{ $booking->location_id }}</td>
											<td>{{ $booking->state_id }}</td>
											<td>{{ $booking->date }}</td>
											<td>{{ $booking->startTime }}</td>
											<td>{{ $booking->endTime }}</td>
											<td>{{ $booking->numPeople }}</td>
											<td>{{ $booking->room }}</td>
											<td>{{ $booking->description }}</td>
											<td>{{ $booking->comment }}</td>

                                            <td>
                                                <form action="{{ route('bookings.destroy',$booking->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('bookings.show',$booking->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('bookings.edit',$booking->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $bookings->links() !!}
            </div>
        </div>
    </div>
@endsection
