@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Teacher Profile</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">

                                        <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>

                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Log Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>

                            </ol>
                        </div><!-- /.col -->
                    </div>
                    <hr> <!-- Horizontal line added below Dashboard and breadcrumb -->
                </div>

                <section class="content mx-3">



                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Profile</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('student-store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                               

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="father_name">Father's Name</label>
                                        <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Enter father's name">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="mother_name">Mother's Name</label>
                                        <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Enter mother's name">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="hall">Hall</label>
                                        <input type="text" class="form-control" id="hall" name="hall" placeholder="Enter hall">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="session">Session</label>
                                        <input type="text" class="form-control" id="session" name="session" placeholder="Enter session">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="department">Department</label>
                                        <input type="text" class="form-control" id="department" name="department" placeholder="Enter department">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="">Select status</option>
                                            @foreach (\App\Teacherstatus::cases() as $status)
                                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="">Select gender</option>
                                            @foreach (\App\gender::cases() as $gender)
                                            <option value="{{ $gender->value }}">{{ $gender->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="sid">Student ID</label>
                                        <input type="text" class="form-control" id="sid" name="sid" placeholder="Enter student ID">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="religion">Religion</label>
                                        <select name="religion" id="religion" class="form-control" required>
                                            <option value="">Select religion</option>
                                            @foreach (\App\religion::cases() as $religion)
                                            <option value="{{ $religion->value }}">{{ $religion->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.container-fluid -->


                </section>

            </div>

            <!-- /.row -->
        </div>
    </div>

    <!-- Main content -->

    <!-- /.content -->
</div>


@endsection