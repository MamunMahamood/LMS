<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\Course;
use App\Models\Student;

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
    $courses = Course::where('teacher_id', $teacher->id)->get();
    $sessions = Course::select('session')->distinct()->get();
    return view('quiz.set_course_for_quiz', compact('teacher','courses', 'sessions'));
}


public function quiz_create_pre_store(Request $request){

    $course = Course::where('cid', $request->course_id)
                      ->where('session', $request->session)
                      ->first();
    
   return redirect()->route('quiz-create', $course)->with('message', 'State saved correctly!!!');
    
}


public function teacher_quiz_index($id){
    $course = Course::findorfail($id);
    $quizzes = $course->quizzes()->get();
    $teacher = Teacher::where('user_id', Auth::user()->id)->first();
    return view('quiz.index', compact('quizzes', 'teacher', 'course'));
}



public function teacher_quiz_index_pre(){
   $teacher = Teacher::where('user_id', Auth::user()->id)->first();
   $courses = Course::where('teacher_id', $teacher->id)->get();
   $sessions = Course::select('session')->distinct()->get();
   return view('quiz.quiz_index_pre', compact('teacher', 'courses', 'sessions'));


}

public function quiz_index_pre_store(Request $request){
    $course = Course::where('cid', $request->course_id)
                      ->where('session', $request->session)
                      ->first();
    
   return redirect()->route('teacher-quiz-index', $course)->with('message', 'State saved correctly!!!');
         
   



}



public function student_ans_store($id, Request $request){
    $student = Student::where('user_id', Auth::user()->id)->first();

    $questions_ans = $request->input('answers');

    foreach($questions_ans as $index => $ans){
        Answer::create([
            'quiz_id'=>$id,
            'question_id'=> $index,
            'student_id'=> $student->id,
            'ans'=> $ans,

        ]);

    }


        $quiz = Quiz::findorfail($id);

        $mcq_questions = $quiz->questions()->where('type', 'mcq')->get();

        // dd($mcq_questions->count());

        foreach($mcq_questions as $index => $mcq) {
            // Retrieve the answer for this particular question
            $answer = Answer::where('question_id', $mcq->id)->first();

            // dd($mcq->mcq_answer);

            // dd($answer->ans);
        
            // Check if the answer exists and compare it with the ans field
            if ($answer && $mcq->mcq_answer == $answer->ans) {
                $answer->update(['mark'=> 1.0]);
            }
            
        }

        $quiz->students()->attach($student);


        return redirect()->route('student.dashboard')->with('message', 'State saved correctly!!!');





        
    



    
}



public function teacher_see_quizzes($course_id, $id){

    $quiz = Quiz::findorfail($id);

    $teacher = Teacher::where('user_id', Auth::user()->id)->first();

    $students = $quiz->students()->get();

    $course = Course::findorfail($course_id);

    $quiz_checked = $quiz->teachers()->where('teacher_id', $teacher->id)->first();

    

    return view('teacher.see_quiz_student_list', compact('teacher', 'quiz', 'students', 'course', 'quiz_checked'));

}



public function teacher_see_quiz_ans($id, $student_id){

    $teacher = Teacher::where('user_id', Auth::user()->id)->first();

    $quiz = Quiz::findorfail($id);

    $student = Student::findorfail($student_id);

    $answers = $quiz->answers()->where('student_id', $student->id)->get();

    $questions = $quiz->questions()->get();

    $quiz->teachers()->attach($teacher, ['student_id' => $student->id]);


    


    return view('teacher.ans_student', compact('quiz', 'student', 'answers', 'questions', 'teacher'));


    
}


public function student_quiz_ans_marks($id, $student_id, Request $request){

    $quiz = Quiz::findorfail($id);
    $student = Student::findorfail($student_id);

    $questions = $quiz->questions()->where('type', 'short')->get();

    

    $answers = $quiz->answers()->where('student_id', $student->id)->get();

    
    foreach($questions as $index => $question){
        $answer = $answers->where('question_id', $question->id)->first();

        $answer->update(['mark'=> $request->input("marks.$index")]);
    }

    $total = $answers->sum('mark');
    


    $quiz_for_student = $quiz->students()->where('student_id', $student->id)->first();
    
    

    $quiz_for_student->pivot->update([
        'marks_obtain'=> $total,
    ]);



    return redirect()->route('teacher.dashboard')->with('message', 'State saved correctly!!!');






}

    
    
}




