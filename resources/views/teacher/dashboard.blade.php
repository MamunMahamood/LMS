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

                                        <!-- <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a> -->

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
                        <div class="col-sm-6 align-self-stretch">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h5><strong>Create Quiz</strong></h5>

                                    <p>Create Task for Students</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-question"></i>
                                </div>
                                <a href="{{route('quiz-create-pre')}}" class="small-box-footer">Enter Here <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-sm-6 align-self-stretch">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h5><strong>Take Attendance</strong></h5>

                                    <p>Create Attendance for Students</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="{{route('course-attendance')}}" class="small-box-footer">Enter Here <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 align-self-stretch">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h5><strong>Hello, Teacher {{Auth::User()->name}} !</strong></h5>
                                    <p class="teacher-redate"></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="#" class="small-box-footer">Enter Here <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-sm-6 align-self-stretch">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h5><strong>Take Assignment</strong></h5>

                                    <p>Assignments for Students</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-address-book"></i>
                                </div>
                                <a href="#" class="small-box-footer">Enter Here <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 align-self-stretch">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h5><strong>Course Curriculam</strong></h5>

                                    <p>Set the Course Syllabus and mark distribution</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-calculator"></i>
                                </div>
                                <a href="#" class="small-box-footer">Enter Here <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-sm-6 align-self-stretch">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h5><strong>Activity</strong></h5>

                                    <p>Course's Info, Upddates and Notices</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <a href="{{route('teacher-activity-pre')}}" class="small-box-footer">Enter Here <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <script>
                    // create a function to update the date and time
                    function updateDateTime() {
                        // create a new `Date` object
                        const now = new Date();

                        const options = {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                            hour12: false
                        };

                        // get the current date and time as a string
                        const currentDateTime = now.toLocaleString('en-US', options);

                        // update the `textContent` property of the `span` element with the `id` of `datetime`
                        document.querySelector('.teacher-redate').textContent = currentDateTime;
                    }

                    // call the `updateDateTime` function every second
                    setInterval(updateDateTime, 1000);
                </script>




                

            </div>

            <!-- /.row -->
        </div>
    </div>

    <!-- Main content -->

    <!-- /.content -->
</div>

@endsection