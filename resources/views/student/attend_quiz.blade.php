@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h1 class="m-0">Answer the Quiz</h1>
                    <hr>
                </div>

                <section class="content mx-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Quiz Questions</h3>
                        </div>

                        <form method="POST" action="{{route('student-ans-store', ['id'=>$quiz->id])}}">
                            @csrf
                            <div class="card-body">

                                @foreach ($questions as $question)
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <h5>{{ $loop->iteration }}. {{ $question->question }}</h5>
                                            
                                            @if ($question->type === 'short')
                                                <!-- Short answer input field -->
                                                <input type="text" name="answers[{{ $question->id }}]" class="form-control" placeholder="Enter your answer">
                                            @elseif ($question->type === 'mcq')
                                                <!-- MCQ Options as radio buttons -->
                                                <div class="form-group">
                                                    @foreach ($question->options as $option)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="{{ $option->option }}" id="option{{ $option->id }}">
                                                            <label class="form-check-label" for="option{{ $option->id }}">
                                                                {{ $option->option }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit Answers</button>
                            </div>
                        </form>

                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection
