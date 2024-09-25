@extends('Layouts.master')
@section('content')





<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{$course->course_name}}</h1>
                            <span><strong>{{$course->cid}}</strong> | <strong>{{$course->session}}</strong></strong></span>
                            <h3>Lecture Number - {{$lecture}}</h3>
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



                    <div>
                        <form action="{{ route('student-attendance', ['id'=>$course->id]) }}" method="POST">
                            @csrf
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Course Id</th>
                                        
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <th>{{$student->user->name}}<input type="hidden" name="student_id[]" value="{{$student->id}}"></th>
                                        <td>{{$course->cid}}</td>
                                        
                                        <td><!-- Hidden input for unchecked state (0) -->
                                            <input type="hidden" name="attendance[{{$loop->index}}]" value="0">
                                            <input type="hidden" name="lecture" value="{{$lecture}}">
                                            <!-- Checkbox for checked state (1) -->
                                            <input type="checkbox" name="attendance[{{$loop->index}}]" value="1" {{ old('attendance.'.$loop->index) ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary">Submit Attendance</button>
                        </form>
                    </div>
                </div>

                <!-- <section class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                This is some text within a card body.
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                <!-- </section> -->

            </div>

            <!-- /.row -->
        </div>
    </div>

    <!-- Main content -->

    <!-- /.content -->
</div>






@endsection