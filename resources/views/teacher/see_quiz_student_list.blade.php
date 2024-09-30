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
                                        <th>student Title</th>
                                        <th>Course Name</th>
                                        <th>Course Id</th>
                                        <th>Session</th>
                                        <th>Date</th>
                                        <th>Marks</th>
                                        <th>Marks Obtain</th>
                                        <th>Checking</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>



                                <tbody>
                                    @foreach($students as $student)

                                    @php

                                    $quiz_for_student = $quiz->students()->where('student_id', $student->id)->first();
                                    
                                    if($quiz_checked){
                                        $quiz_checked_for_student = $quiz_checked->pivot->where('student_id', $student->id)->first();
                                    }
                                    else $quiz_checked_for_student = null;
                                    
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $course->course_name }}</td>
                                        <td>{{ $course->cid }}</td> <!-- Serial Number -->
                                        <td>{{ $course->session }}</td>
                                        <td>{{ $student->created_at->format('F j, Y, g:i a') }}</td>
                                        <td>{{ $quiz->marks }}</td>
                                        <td>{{ $quiz_for_student->pivot->marks_obtain }}</td>
                                        
                                        @if($quiz_checked_for_student)
                                        <td><span class="badge badge-success">Already Checked</span></td>
                                        @else
                                        <td><span class="badge badge-warning">Not Yet Check</span></td>
                                        @endif
                                       
                                        
                                        <td><span class="badge bg-primary"><a href="{{route('teacher-see-quiz-ans',['id'=>$quiz->id, 'student_id'=>$student->id])}}">View student</a></span></td>
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