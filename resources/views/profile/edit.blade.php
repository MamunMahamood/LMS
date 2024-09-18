
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
              <h1 class="m-0">Profile</h1>
            </div><!-- /.col -->
            
          </div>
          <!-- <hr> Horizontal line added below Dashboard and breadcrumb -->
        </div>

        <section class="content">
          <div class="container-fluid">
          <x-app-layout>
    <!--  -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
            
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








