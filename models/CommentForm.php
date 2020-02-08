<?php 

namespace app\models;

use yii\base\Model;

class CommentForm extends Model{

    public $comment;
    public function rules(){
        return[
           [ ['comment'],'required'],
           [['comment'], 'string', 'length'=>[3,250]],

        ];
    }
    public function saveComment($task_id)
    {
        $comment = new Comment;
        $comment->text = $this->comment;
        $comment->task_id = $task_id;
        return $comment->save();

    }
}