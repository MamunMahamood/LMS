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

                    <button onclick="setTimeout(function(){ window.print(); }, 500)">Print this page</button>




                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Student Id</th>
                                    <th>Session</th>
                                    <th>Date</th>
                                    <th>Attendance</th>
                                    <th>Action</th>



                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lecture_attendances as $attendance)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->sid }}</td> <!-- Serial Number -->
                                    <td>{{ $attendance->session }}</td>
                                    <td>{{ $attendance->pivot->created_at->format('F j, Y, g:i a') }}</td>
                                    <td>{{ $attendance->pivot->attendance ? 'Presented' : 'Absent' }}</td>
                                    <!-- <td>{{ $attendance->pivot->attendance ? 'Presented' : 'Absent' }}</td> -->
                                    <td><span class="badge bg-danger"><a href="{{route('lecture-attendance', ['id'=>$course->id, 'lecture'=>$attendance->pivot->lecture])}}">View Students</a></span></td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>

                </div>



            </div>

            <!-- /.row -->
        </div>
    </div>

    <!-- Main content -->

    <!-- /.content -->
</div>





<!-- <script type="text/javascript">
    var myWindow = window.open('','','width=200,height=100')
    myWindow.document.write("This is 'myWindow'")
    myWindow.print();
</script> -->






@endsection