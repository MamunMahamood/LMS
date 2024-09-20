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

          <div>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#tab1" data-url="{{ route('tabs.tab1') }}">Create Task</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tab2" data-url="{{ route('tabs.tab2') }}">Take Attendance</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tab3" data-url="{{ route('tabs.tab3') }}">Create Quiz</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tab4" data-url="{{ route('tabs.tab4') }}">Marks Distribution</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tab4" data-url="{{ route('tabs.tab4') }}">Course Curriculam</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tab4" data-url="{{ route('tabs.tab4') }}">Activity</a>
              </li>
            </ul>


          </div>


          <div class="tab-content">
            <div class="tab-pane fade show active" id="tab1">Loading...</div>
            <div class="tab-pane fade" id="tab2">Loading...</div>
            <div class="tab-pane fade" id="tab3">Loading...</div>
            <div class="tab-pane fade" id="tab4">Loading...</div>
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
  $(document).ready(function() {
    // Load content for the default active tab (Tab 1)
    var activeTab = $('.nav-tabs .active');
    var activeTabUrl = activeTab.data('url');
    $.get(activeTabUrl, function(data) {
      $('#tab1').html(data);
    });

    // Handle tab click events
    $('.nav-tabs a').on('click', function(event) {
      event.preventDefault();

      // Get the target tab and its content URL
      var target = $(this).attr('href');
      var url = $(this).data('url');

      // Fetch content via AJAX and update the tab content
      $.get(url, function(data) {
        $(target).html(data);
      });

      // Change active tab
      $('.nav-tabs a').removeClass('active');
      $(this).addClass('active');
      $('.tab-pane').removeClass('show active');
      $(target).addClass('show active');
    });
  });
</script>


@endsection