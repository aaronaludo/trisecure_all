@extends('layouts.driver')
@section('title', 'Ride History View')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert" style="background: #b3ccf5;">
                    <h4 class="alert-heading color-kabarkadogs">Passenger name: <span class="fw-bold ms-2">{{ $history->passenger->first_name }} {{ $history->passenger->last_name }}</span></h4>
                    <h4 class="alert-heading color-kabarkadogs">Driver name: <span class="fw-bold ms-2">{{ $history->driver->first_name }} {{ $history->driver->last_name }}</span></h4>
                    <h4 class="alert-heading color-kabarkadogs">Status: <span class="fw-bold ms-2">{{ $history->status->name }}</span></h4>
                    <h4 class="alert-heading color-kabarkadogs">Ride Date: <span class="fw-bold ms-2">{{ $history->created_at }}</span></h4>
                    <h4 class="alert-heading color-kabarkadogs">Dropoff Date: <span class="fw-bold ms-2">{{ $history->updated_at }}</span></h4>
                </div>
            </div>                    
        </div>
    </div>
@endsection