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
              <h1 class="m-0">{{$course->course_name}}</h1>
              <span><strong>{{$course->cid}}</strong> | <strong>{{$course->session}}</strong></strong></span>
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
            <div class="col-sm-6 align-self-stretch">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h5><strong>Quiz Section</strong></h5>

                  <p>See the pending Quiz</p>
                </div>
                <div class="icon">
                <i class="fa fa-question"></i>
              </div>
                <a href="{{route('student-course-quizzes', ['id'=>$course->id])}}" class="small-box-footer">Enter Here <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-sm-6 align-self-stretch">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h5><strong>Attendance Section</strong></h5>

                  <p>Go and See your Attendance</p>
                </div>
                <div class="icon">
                <i class="fa fa-book"></i>
              </div>
                <a href="{{route('student-course-attendance', ['id'=>$course->id])}}" class="small-box-footer">Enter Here <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 align-self-stretch">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h5><strong>Course Code</strong></h5>

                  <p>{{$course->course_code}}</p>
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
                  <h5><strong>Assignment Section</strong></h5>

                  <p>Complete Your Assignments</p>
                </div>
                <div class="icon">
                <i class="fa fa-address-book"></i>
              </div>
                <a href="{{route('student-course-assignments', ['id'=>$course->id])}}" class="small-box-footer">Enter Here <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 align-self-stretch">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h5><strong>Course Curriculam</strong></h5>

                  <p>See the Course Syllabus and mark distribution</p>
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
                  <h5><strong>Activity Section</strong></h5>

                  <p>See Course's Info, Upddates and Notices</p>
                </div>
                <div class="icon">
                <i class="fa fa-tasks"></i>
              </div>
                <a href="{{route('student-activity', ['id'=>$course->id])}}" class="small-box-footer">Enter Here <i class="fas fa-arrow-circle-right"></i></a>
              </div>
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








<script>

</script>




@endsection