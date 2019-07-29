<?php

namespace App\Http\Controllers\Work;

use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;
use App\Http\Controllers\Controller;
use App\Model\Work\QuizModel as Quiz;
use App\Model\Work\AllQuizzesModel as AllQuiz;
use App\Model\Work\PopQuizModel as PopQuiz;
use Illuminate\Support\Arr;

class QuizController extends Controller
{
    public function display(Request $request,Quiz $q){
        $type = $request->input('type','all');
        $subject = $request->input('subject','all');

        $quiz = $q->display($type,$subject);
        return view('work.quiz.display',[
            'quiz' => $quiz,
            'type' => $type,
            'subject' => $subject
        ]);
    }

    public function operation(){
        return view('work.quiz.operation');
    }

    public function postOperation(QuizRequest $request,Quiz $q){
        $request->validated();
        $q->personalQuiz($request->all());

        return redirect()->route('q_pso')->with('postscript','Good Job!');
    }

    public function quiz(AllQuiz $aq){
        $quiz = $aq->acquireQuiz(1);
        return view('work.quiz.quiz',['quiz' => $quiz]);
    }

    public function quizSpotter(Quiz $q,Request $request){
        $id = $request->input('id');
        $choice = $request->input('choice');
        $type = $request->input('type');

        $quiz = $q->find($id);

        if($type == 1){
            $criticise = ($choice == $quiz['correct']);
        }else{
            $criticise = collect(explode(',',$quiz['correct']))->diff(explode(',',$choice))->all();
        }

        if(($criticise && $type == 1) || (!$criticise && $type == 2)){
            $q->where('id',$id)->increment('rightCount');
            return 'R';
        }else{
            $q->where('id',$id)->increment('wrongCount');
            return 'W';
        }
    }

    public function allQuizzes(Quiz $q,PopQuiz $pq,AllQuiz $aq){
        $count = $q->count();
        if($count > 10){
            $count = 10;
        }

        $aq->where('id','>',0)->delete();
        $quiz = $q->get()->random($count)->toArray();
        foreach($quiz as $aj => $ts){
        //twilight & applejack
            $aq->allQuizzes($ts);
        }

        $pq->generatePopQuiz(Arr::pluck($quiz,'id'),$count);
        return redirect()->route('q_pq');
    }
}
