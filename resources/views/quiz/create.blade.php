@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Quiz Creation</h1>
                        </div>
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
                        </div>
                    </div>
                    <hr>
                </div>

                <section class="content mx-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Set Questions</h3>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('quiz-store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                <div class="form-group col-6">
                                <label for="title">Quiz Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                                </div>
                                <div class="form-group col-6">
                                <label for="marks">Quiz Marks</label>
                                <input type="text" class="form-control" id="marks" name="marks" placeholder="Enter Marks">
                                </div>
                                <input type="hidden" class="form-control" id="course_id" name="course_id" value="{{$course->id}}">
                                </div>
                                <div id="question-container">
                                    <!-- Dynamic questions will be added here -->
                                </div>

                                <div class="row mt-0">
                                    <div class="col-0">
                                        <button type="button" id="add-short-question" class="btn"><small class="badge badge-success">+Short</small></button>
                                    </div>
                                    <div class="col-0">
                                        <button type="button" id="add-mcq-question" class="btn"><small class="badge badge-success">+MCQ</small></button>
                                    </div>
                                    <div class="col-0">
                                        <button type="button" id="remove-last-question" class="btn"><small class="badge badge-danger">Remove</small></button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </section>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let questionCounter = 0;

        // Function to add a new question
        function addQuestion(type) {
            questionCounter++;
            let questionHtml = `
                <div class="row question-block" id="question-${questionCounter}">
                    <div class="form-group col-12">
                        <label for="${type}_question_${questionCounter}">${type === 'short' ? 'Short Answer' : 'MCQ'} Question</label>
                        <input type="text" class="form-control" id="${type}_question_${questionCounter}" name="${type}_questions[]" placeholder="Enter your question">
                    </div>
            `;

            if (type === 'mcq') {
                questionHtml += `
                    <div class="form-group col-6">
                        <input type="text" class="form-control" name="mcq_options[${questionCounter}][]" placeholder="Option 1">
                    </div>
                    <div class="form-group col-6">
                        <input type="text" class="form-control" name="mcq_options[${questionCounter}][]" placeholder="Option 2">
                    </div>
                    <div class="form-group col-6">
                        <input type="text" class="form-control" name="mcq_options[${questionCounter}][]" placeholder="Option 3">
                    </div>
                    <div class="form-group col-6">
                        <input type="text" class="form-control" name="mcq_options[${questionCounter}][]" placeholder="Option 4">
                    </div>
                    <div class="form-group col-6">
                        <input type="text" class="form-control" name="correct_ans[]" placeholder="Correct Answare">
                    </div>
                `;
            }

            questionHtml += `</div>`;
            $('#question-container').append(questionHtml);
        }

        // Add short answer question
        $('#add-short-question').on('click', function() {
            addQuestion('short');
        });

        // Add MCQ question
        $('#add-mcq-question').on('click', function() {
            addQuestion('mcq');
        });

        // Remove the last added question
        $('#remove-last-question').on('click', function() {
            const lastQuestion = $('#question-container .question-block').last();
            if (lastQuestion.length) {
                lastQuestion.remove();
            }
        });
    });
</script>

@endsection