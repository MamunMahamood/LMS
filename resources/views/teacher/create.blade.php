@extends('layouts.master')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Teacher Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->



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
            <form method="POST" action="{{ route('teacher-store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation">
                        </div>
                        <div class="form-group col-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Select status</option>
                                @foreach (\App\Teacherstatus::cases() as $status)
                                <option value="{{ $status->value }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="">Select gender</option>
                                @foreach (\App\gender::cases() as $gender)
                                <option value="{{ $gender->value }}">{{ $gender->name }}</option>
                                @endforeach
                            </select>
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
                            <label for="education">Education</label>
                            <textarea type="text" class="form-control" id="education" name="education" placeholder="Enter education"></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="skill">Skills</label>
                            <input type="text" class="form-control" id="skill" name="skill" placeholder="Enter Skills">
                        </div>
                        <div class="form-group col-6">
                            <label for="location">Research Interests</label>
                            <input type="text" class="form-control" id="research_interest" name="research_interest" placeholder="Enter Fields">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="mobile_number">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number">
                        </div>
                        <div class="form-group col-6">
                            <label for="tphoto">Profile Photo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="tphoto" id="tphoto">
                                    <label class="custom-file-label" for="tphoto">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- <div class="form-group">
                        <label for="exampleInputFile">Profile Photo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div><!-- /.container-fluid -->
</div>


@endsection