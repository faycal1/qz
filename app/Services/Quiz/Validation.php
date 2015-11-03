<?php

namespace App\Services\Quiz;

use App\Models\Quiz\Question\Question;
use App\Models\Quiz\Answer\Answer;

class Validation
{
    public function OnlyOneTrue($attribute, $type, $parameters, $validator)
    {
        $question_id = $validator->getData()['question_id'];
        $question_type = Question::find($question_id)->type;

        if ($type == '1' && $question_type != 'multiple') {
            if (Answer::CountTrueAnswer($question_id) == '1') {
                return false;
            }
        }

        return true;
    }
}
