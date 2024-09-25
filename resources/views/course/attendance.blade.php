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
                            <h1 class="m-0">Attendance</h1>
                            <span><strong>Take Course</strong></span>
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




                    <div class="row">
                        <div class="col-sm-10">
                        <form action="{{route('course-attendance-create')}}" method="POST">
                            @csrf

                            <div class="form-group col-6">
                                <label for="designation">Course Id</label>
                                <input type="text" class="form-control" id="course_id" name="course_id" placeholder="Enter Course Id">
                            </div>
                            <div class="form-group col-6">
                                <label for="designation">Session</label>
                                <input type="text" class="form-control" id="session" name="session" placeholder="Enter Session">
                            </div>
                            <div class="form-group col-6">
                                <label for="designation">Lecture Number</label>
                                <input type="text" class="form-control" id="lecture" name="lecture" placeholder="Enter Lecture">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{route('teacher-see-attendance')}}" class="btn btn-primary">See Previous Attendances</a>
                        </div>
                    </div>
                </div>



            </div>

            <!-- /.row -->
        </div>
    </div>

    <!-- Main content -->

    <!-- /.content -->
</div>





@endsection