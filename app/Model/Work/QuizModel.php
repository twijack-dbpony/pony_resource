<?php

namespace App\Model\Work;

use Illuminate\Database\Eloquent\Model;

class QuizModel extends Model
{
    protected $table = 'quiz';
    protected $guarded = [];

    public function scopeType($query,$type){
        return $query->where('type',$type);
    }

    public function scopeSubject($query,$subject){
        return $query->where('subject',$subject);
    }

    public function display($type,$subject,$page = 10){
        $quiz = self::orderBy('id','desc');
        if($type != 'all'){
            $quiz->type($type);
        }

        if($subject != 'all'){
            $quiz->subject($subject);
        }
        return $quiz = $quiz->paginate($page);
    }

    public function personalQuiz($param){
        $choices = collect($param['choices'])->reject(function ($value){
            if($value == null){
                return true;
            }
        });

        self::create([
            'question' => $param['question'],
            'subject' => $param['subject'],
            'type' => $param['type'],
            'choices' => implode($choices->all(),','),
            'correct' => $param['correct'],
            'analysis' => $param['analysis']
        ]);
    }
}
