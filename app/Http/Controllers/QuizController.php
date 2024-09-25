<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\Course;

class QuizController extends Controller
{
    public function quiz_create($id){
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $course = Course::findorfail($id);
        return view('quiz.create', compact('teacher', 'course'));
    }



    public function quiz_store(Request $request)
{
    // Validate the request
    $request->validate([
        'short_questions.*' => 'nullable|string|max:255',
        'mcq_questions.*' => 'nullable|string|max:255',
        'mcq_options.*.*' => 'nullable|string|max:255', // validate the options
    ]);

    // Create the quiz record
    $quiz = Quiz::create([
        'title' => $request->title,
        'marks' => $request->marks,
        'course_id'=> $request->course_id,
    ]);

    // Handle short answer questions
    if ($request->has('short_questions')) {
        foreach ($request->input('short_questions') as $shortQuestion) {
            if (!empty($shortQuestion)) {
                Question::create([
                    'question' => $shortQuestion,
                    'type' => 'short',
                    'quiz_id' => $quiz->id,
                ]);
            }
        }
    }

    // Handle MCQ questions
    if ($request->has('mcq_questions')) {
        // Use array_values to ignore any non-sequential index keys
        $mcqQuestions = array_values($request->input('mcq_questions'));
        $mcqOptions = array_values($request->input('mcq_options'));

        foreach ($mcqQuestions as $index => $mcqQuestion) {
            if (!empty($mcqQuestion)) {
                // Create the MCQ question
                $question = Question::create([
                    'question' => $mcqQuestion,
                    'type' => 'mcq',
                    'quiz_id' => $quiz->id,
                    'mcq_answer' => $request->input("correct_ans.$index"), // Set dynamic answers later
                ]);

                // Debugging the options input
                if (isset($mcqOptions[$index])) {
                    foreach ($mcqOptions[$index] as $option) {
                        if (!empty($option)) {
                            Option::create([
                                'question_id' => $question->id,
                                'option' => $option
                            ]);
                        }
                    }
                }
            }
        }
    }

    // Redirect with a success message
    return redirect()->route('teacher.dashboard')->with('success', 'Quiz created successfully.');


    // $index = 0;
    // dd($request->input("correct_ans.$index"));
}





public function quiz_create_pre(Request $request){
    $teacher = Teacher::where('user_id', Auth::user()->id)->first();
    return view('quiz.set_course_for_quiz', compact('teacher'));
}


public function quiz_create_pre_store(Request $request){

    $course = Course::where('cid', $request->course_id)
                      ->where('session', $request->session)
                      ->first();
    
   return redirect()->route('quiz-create', $course)->with('message', 'State saved correctly!!!');
    
}


public function quiz_index(){
   $course = Course::findorfail(3);
    $quizzes = $course->quizzes()->get();
    $teacher = Teacher::where('user_id', Auth::user()->id)->first();
    return view('quiz.index', compact('quizzes', 'teacher'));
}

    
    
}




