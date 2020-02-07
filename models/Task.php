<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $title
 * @property int|null $category_id
 * @property string|null $date
 * @property int|null $comments_count
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {


        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['category_id'], 'default', 'value' => 1],
            [['comments_count'], 'default', 'value' => 0],

            [['user_id', 'category_id', 'comments_count'], 'integer'],

        ];
        /*   [['user_id', 'category_id', 'comments_count'], 'integer'],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];*/
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'category_id' => 'Category ID',
            'date' => 'Date',
            'comments_count' => 'Comments Count',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function saveCategory($category_id)
    {
      $category =Category::findOne(($category_id));
     if($category!=null){
        $this->link('category', $category );
        return true;
     }
     

    }
}
