<!-- <div class="container mt-4">
    <div class="row">
        @foreach($courses as $course)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    {{-- Course Image --}}
                    <img src="{{ $course->cphoto }}" class="card-img-top" alt="{{ $course->course_name }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $course->course_name }}</h5>
                        <p class="card-text">{{ $course->cid }}</p>
                        <a href="" class="btn btn-primary">View Course</a>
                    </div>
                </div>
            </div>

            {{-- Close the row and start a new one after every 4 cards --}}
            @if($loop->iteration % 4 == 0)
                </div><div class="row">
            @endif
        @endforeach
    </div>
</div> -->
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
                </div>

                <section class="content mx-3">
                    <div>
                        <form method="GET" action="{{ route('course-index') }}">
                            <div class="form-row">
                                <div class="col-3">
                                    <input type="text" name="course_name" id="course_name" class="form-control" placeholder="Course Name" value="{{ request('course_name') }}">
                                </div>
                                <div class="col-3">
                                    <input type="text" name="cid" id="cid" class="form-control" placeholder="Course ID" value="{{ request('cid') }}">
                                </div>
                                <div class="col-3">
                                    <input type="text" name="session" id="session" class="form-control" placeholder="Session" value="{{ request('session') }}">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                                <div class="col-1">
                                    <a href="{{route('course-index')}}" class="btn btn-primary">Reset</a>
                                </div>

                            </div>
                        </form>


                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">


                            <div class="row">
                                @if($courses)
                                @foreach($courses as $course)
                                <div class="col-lg-2 col-md-3 col-sm-4 mb-4">
                                    <div class="card" style="width: 100%; height: 350px;"> <!-- Fixed height for the card -->
                                        <img src="{{ $course->cphoto }}" class="card-img-top" alt="{{ $course->course_name }}" style="height: 150px; object-fit: cover;"> <!-- Fixed height for the image -->
                                        
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $course->course_name }}</h5>
                                            <p class="card-text">{{ $course->cid }}</p>
                                            <p class="card-text">Session: {{ $course->session }}</p>
                                            @if(Auth::user()->role===App\UserRole::Teacher->value)
                                            <a href="{{route('course-show',['id' => $course->id])}}" class="btn btn-primary mt-auto">View Course</a> 
                                            @elseif(Auth::user()->role===App\UserRole::Student->value)
                                            <a href="{{route('student-course-show',['id' => $course->id])}}" class="btn btn-primary mt-auto">View Course</a>
                                            @else
                                            
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                @if($loop->iteration % 6 == 0)
                            </div>
                            <div class="row">
                                @endif
                                @endforeach
                                @endif
                            </div>


                        </div>
                        <!-- <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <form id="filterForm" class="mb-3">
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="text" name="course_name" class="form-control" placeholder="Course Name">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="cid" class="form-control" placeholder="Course ID">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="session" class="form-control" placeholder="Session">
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div> -->

                    </div>
                </section>

            </div>

            <!-- /.row -->
        </div>
    </div>

    <!-- Main content -->

    <!-- /.content -->
</div>










<script>
   
</script>








@endsection