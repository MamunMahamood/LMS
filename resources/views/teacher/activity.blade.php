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
                            <h1 class="m-0">Activities</h1>
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
                    <!-- Horizontal line added below Dashboard and breadcrumb -->








                    @foreach($posts as $post)
                    <div class="post">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{$post->photo}}" alt="user image">
                            <span class="username">
                                <a href="#">{{$post->name}}</a>

                                <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
                            </span>
                            <span class="description">Shared publicly - {{ $post->pivot->created_at->format('F j, Y, g:i a') }}</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            {{$post->pivot->post}}
                        </p>





                        @php
                        
                        $comments_for_post = $comments->where('post_id', $post->pivot->id);


                        @endphp


                        @foreach($comments_for_post as $comment)



                        @php

                        $user_of_comment = $users_for_comment->where('id', $comment->user_id)->first();

                        @endphp

                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="{{$user_of_comment->photo}}" alt="user image">
                                <span class="username">
                                    <a href="#">{{$user_of_comment->name}}</a>

                                    <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
                                </span>
                                <span class="description">Shared publicly - {{ $comment->created_at->format('F j, Y, g:i a') }}</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                {{$comment->comment}}
                            </p>



                            @endforeach

                            <!-- <p>
                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                    <span class="float-right">
                                        <a href="#" class="link-black text-sm">
                                            <i class="far fa-comments mr-1"></i> Comments (5)
                                        </a>
                                    </span>
                                </p> -->



                                <form action="{{route('teacher-post-comment')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-8">
                                    <input type="hidden" name="post_id" class="orm-control form-control-sm col-1" value="{{$post->pivot->id}}">
                                    <input type="hidden" name="user_id" class="orm-control form-control-sm col-1" value="{{Auth::user()->id}}">
                                    <input class="form-control form-control-sm col-12" type="text" name="comment" placeholder="Type a comment">
                                </div>
                                <input type="submit" name="submit" class="orm-control form-control-sm col-1">
                            </div>
                        </form>

                        </div>
                        















                        @endforeach

                        <!-- <p>
                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                            <span class="float-right">
                                <a href="#" class="link-black text-sm">
                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                </a>
                            </span>
                        </p> -->


                        <form action="{{route('teacher-post')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-11">
                                <input type="hidden" name="course_id" class="orm-control form-control-sm col-1" value="{{$course->id}}">
                                <input type="hidden" name="user_id" class="orm-control form-control-sm col-1" value="{{Auth::user()->id}}">
                                <input class="form-control form-control-sm col-12" type="text" name="post" placeholder="Type a comment">
                            </div>
                            <input type="submit" name="submit" class="orm-control form-control-sm col-1">
                        </div>
                    </form>


                    </div>
                    






                </div>








            </div>

            <!-- /.row -->
        </div>
    </div>

    <!-- Main content -->

    <!-- /.content -->
</div>



@endsection