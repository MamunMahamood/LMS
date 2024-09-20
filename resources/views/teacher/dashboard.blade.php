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

                <section class="content">
                    <div class="container-fluid">
                        <div class="row mx-2">
                            <div class="col-sm-6">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Hello, Teacher {{Auth::User()->name}} !</h4>
                                    Today is <h5 class="teacher-redate"></h5>
                                   
                                </div>

                            </div>

                        </div>
                    </div><!-- /.container-fluid -->
                </section>

            </div>

            <!-- /.row -->
        </div>
    </div>

    <!-- Main content -->

    <!-- /.content -->
</div>

@endsection