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
            
          </div>
          <!-- <hr> Horizontal line added below Dashboard and breadcrumb -->
        </div>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                        src="{{$student->sphoto}}"
                        alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{$student->user->name}}</h3>

                    <p class="text-muted text-center">{{$student->designation}}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Followers</b> <a class="float-right">1,322</a>
                      </li>
                      <li class="list-group-item">
                        <b>Following</b> <a class="float-right">543</a>
                      </li>
                      <li class="list-group-item">
                        <b>Friends</b> <a class="float-right">13,287</a>
                      </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>

                    <p class="text-muted">
                      {{$student->education}}
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                    <p class="text-muted">{{$student->location}}</p>

                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                    <p class="text-muted">
                      {{$student->skill}}
                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <h4>Teaching Profile</h4>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="row">
                        <div class="col-sm-8">
                        <p><strong><i class="fas fa-pencil-alt mr-1"></i> Designation :</strong> {{$student->designation}}</p>
                        </div>

                        <div class="col-sm-4">
                        <p><strong><i class="fas fa-pencil-alt mr-1"></i> Status :</strong> {{$student->status}}</p>

                        </div>

                      </div>

                      <div class="row">
                        <div class="col-sm-8">
                        <p><strong><i class="fas fa-pencil-alt mr-1"></i> Department :</strong> Computer Science and Engineering</p>
                        </div>

                        <div class="col-sm-4">
                        <p><strong><i class="fas fa-pencil-alt mr-1"></i> Gender :</strong> {{$student->gender}}</p>


                        </div>

                      </div>

                      <div class="row">
                        <div class="col-sm-8">
                        <p><strong><i class="fas fa-pencil-alt mr-1"></i> Religion :</strong> {{$student->religion}}</p>
                        </div>

                        <div class="col-sm-4">
                        <p><strong><i class="fas fa-pencil-alt mr-1"></i> Mobile :</strong> {{$student->mobile_number}}</p>


                        </div>

                      </div>



                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
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