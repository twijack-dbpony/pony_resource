<?php

namespace App\Model\Work;

use Illuminate\Database\Eloquent\Model;

class PopQuizModel extends Model
{
    protected $table = 'pop_quiz';
    protected $guarded = [];

    public function generatePopQuiz($quiz,$size){
        self::create([
            'quiz' => implode(',',$quiz),
            'size' => $size,
            'subject' => 'all',
            'type' => 'all',
        ]);
    }
}
