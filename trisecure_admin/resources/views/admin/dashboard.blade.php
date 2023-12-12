@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Dashboard</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Users</div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">8</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('admin.users.index') }}">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Admins</div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">8</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('admin.admins.index') }}">View more...</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="tile tile-primary">
                            <div class="tile-heading">Total Ride Histories</div>
                            <div class="tile-body">
                                <i class="fa-regular fa-file"></i>
                                <h2 class="float-end">8</h2>
                            </div>
                            <div class="tile-footer"><a href="{{ route('admin.ride-histories.index') }}">View more...</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>Latest Document Tracks</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>34354</td>
                                            <td>Test Subject</td>
                                            <td>May 01, 2022 12:59 PM</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="action-button"><a href="#" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection