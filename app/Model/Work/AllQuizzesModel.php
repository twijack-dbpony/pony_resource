<?php

namespace App\Model\Work;

use Illuminate\Database\Eloquent\Model;

class AllQuizzesModel extends Model
{
    protected $table = 'all_quizzes';
    protected $guarded = [];

    public function quiz(){
        return $this->belongsTo(QuizModel::class,'qid','id');
    }

    public function allQuizzes($param){
        self::create([
            'qid' => $param['id'],
            'type' => $param['type'],
            'subject' => $param['subject'],
            'question' => $param['question'],
            'choices' => $param['choices'],
        ]);
    }

    public function acquireQuiz($page = false){
        return self::paginate($page ?? config('constants.page'));
    }
}
