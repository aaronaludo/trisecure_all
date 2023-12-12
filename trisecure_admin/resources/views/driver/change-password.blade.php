@extends('layouts.driver')
@section('title', 'Change Password')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Change Password</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="">
                                <div class="mb-3 row">
                                    <label for="old_password" class="col-sm-12 col-lg-2 col-form-label">Old Password: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="password" class="form-control" id="old_password" name="old_password"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="new_password" class="col-sm-12 col-lg-2 col-form-label">New Password: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="password" class="form-control" id="new_password" name="new_password"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="confirm_new_password" class="col-sm-12 col-lg-2 col-form-label">Confirm New Password: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-4">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection