



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
                            </div>
                        </form>


                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- <div class="row">
                                @foreach($courses as $course)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 d-flex flex-column">
                                        {{-- Course Image --}}
                                        <img src="{{ $course->cphoto }}" class="card-img-top" alt="{{ $course->course_name }}">

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $course->course_name }}</h5>
                                            <p class="card-text">{{ $course->cid }}</p>
                                            <p class="card-text">Session: {{ $course->session }}</p>
                                            <a href="" class="btn btn-primary mt-auto w-100">View Course</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Close the row and start a new one after every 4 cards --}}
                                @if($loop->iteration % 4 == 0)
                            </div>
                            <div class="row">
                                @endif
                                @endforeach
                            </div> -->
                            <div id="coursesList">
                                <div class="row">
                                    @foreach($courses as $course)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                        <div class="card h-100 d-flex flex-column">
                                            <img src="{{ $course->cphoto }}" class="card-img-top" alt="{{ $course->course_name }}">

                                            <div class="card-body">
                                                <h5 class="card-title">{{ $course->course_name }}</h5>
                                                <p class="card-text">{{ $course->cid }}</p>
                                                <p class="card-text">Session: {{ $course->session }}</p>
                                                <a href="" class="btn btn-primary mt-auto w-100">View Course</a>
                                            </div>
                                        </div>
                                    </div>

                                    @if($loop->iteration % 4 == 0)
                                </div>
                                <div class="row">
                                    @endif
                                    @endforeach
                                </div>
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








<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
   $(document).ready(function() {
    $('#filterForm input').on('input', function() {
        // Auto-submit form when any input field changes
        $.ajax({
            url: "{{ route('courses.filter') }}",  // The route to filter courses
            method: 'GET',
            data: $('#filterForm').serialize(),  // Send the form data
            success: function(response) {
                $('#coursesList').html(response);  // Update the courses list with filtered results
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    });
});

</script>








@endsection