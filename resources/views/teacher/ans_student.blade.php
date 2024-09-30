@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h1 class="m-0">Answer Sheet</h1>
                    <span><strong>Student's Name: </strong>{{$student->user->name}}</span> |
                    <span><strong>Student's Id: </strong>{{$student->sid}}</span> |
                    <span><strong>Student's Session: </strong>{{$student->session}}</span> |
                    <span><strong>Quiz's Title: </strong>{{$quiz->title}}</span> |
                    <span><strong>Date: </strong>{{$quiz->created_at->format('F j, Y, g:i a')}}</span>
                    <hr>
                </div>

                <section class="content mx-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            
                                <h3 class="card-title">Quiz Questions</h3>
                                <h3 class="card-title float-right">Marks</h3>
                            
                        </div>

                        <form method="POST" action="{{route('student-quiz-ans-marks',['id'=>$quiz->id, 'student_id'=>$student->id])}}">
                            @csrf
                            <div class="card-body">

                                @foreach ($questions as $question)
                                    @php
                                        // Find the student's answer for this question
                                        $answer = $answers->where('question_id', $question->id)->first();
                                    @endphp

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <h5>{{ $loop->iteration }}. {{ $question->question }}</h5>

                                            @if ($question->type === 'short')
                                                <div class="row">
                                                    <p class="col-10"><strong>Ans: </strong>{{$answer->ans}}</p>
                                                    <input class="col-2 form-control" type="text" name="marks[]" value="{{$answer->mark}}">
                                                </div>

                                            @elseif ($question->type === 'mcq')
                                                <!-- MCQ Options with radio buttons -->
                                                <div class="row">
                                                    <div class="form-group col-10">
                                                        @foreach ($question->options as $option)
                                                            @php
                                                                // Determine if the current option is the correct or selected answer
                                                                $isCorrectAnswer = ($option->option === $question->mcq_answer);
                                                                $isStudentAnswer = ($option->option === $answer->ans);
                                                            @endphp

                                                            <div class="form-check">
                                                                <input 
                                                                    class="form-check-input" 
                                                                    type="radio" 
                                                                    name="answers[{{ $question->id }}]" 
                                                                    value="{{ $option->option }}" 
                                                                    id="option{{ $option->id }}"
                                                                    disabled {{-- Disabling radio button since it's already answered --}}
                                                                    {{ $isStudentAnswer ? 'checked' : '' }}>

                                                                <label 
                                                                    class="form-check-label
                                                                    @if($isCorrectAnswer) text-success
                                                                    @elseif($isStudentAnswer && !$isCorrectAnswer) text-danger
                                                                    @endif" 
                                                                    for="option{{ $option->id }}">
                                                                    {{ $option->option }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <input class="col-2 form-control" type="text" name="mark" value="{{$answer->mark}}">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit Marks</button>
                            </div>
                        </form>

                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection
