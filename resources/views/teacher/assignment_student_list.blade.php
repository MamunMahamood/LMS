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
                            <h1 class="m-0">Dashboard</h1>
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
                        <div class="col-12 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Student Id</th>
                                        <th>Course Name</th>
                                        <th>Course Id</th>
                                        <th>Assignment Title</th>
                                        <th>Session</th>
                                        <th>Date</th>
                                        <!-- <th>Marks</th>
                                        <th>Marks Obtain</th> -->
                                        <!-- <th>Checking</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>



                                <tbody>
                                    @foreach($students as $student)

                                   

                                    
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $student->sid }}</td>
                                        <td>{{ $course->course_name }}</td>
                                        <td>{{ $course->cid }}</td> <!-- Serial Number -->
                                        <td>{{ $assignment->title }}</td>
                                        <td>{{ $course->session }}</td>
                                        <td>{{ $student->created_at->format('F j, Y, g:i a') }}</td>
                                        
                                        <!-- <td><span class="badge badge-success">Already Checked</span></td> -->
                                        
                                        
                                        <td><span class="badge bg-success"><a href="{{ $student->pivot->assignment_file }}" target="_blank">View File</a></span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

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