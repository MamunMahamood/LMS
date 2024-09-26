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
                        <form method="POST" action="{{ route('course-store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="course_name">Course Name</label>
                                        <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Enter course_name">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="cid">Course Id</label>
                                        <input type="text" class="form-control" id="cid" name="cid" placeholder="Enter Course Id">
                                    </div>
                                   
                                </div>

                                
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="session">Session</label>
                                        <input type="text" class="form-control" id="session" name="session" placeholder="Enter Session">
                                    </div>
                                    <div class="form-group col-6">
                                    <label for="course_code">Course Code</label>
                                        <input type="text" class="form-control" id="course_code" name="course_code" value="{{$course_code}}">
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