<?php

namespace app\controllers;

use Yii;
use  yii\helpers\ArrayHelper;
use app\models\Task;
use app\models\TaskSearch;
use app\models\Category;
use app\models\CategorySearch;
use app\models\CommentForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $categories = Category::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $task=Task::findOne($id);
        $comments = $task->comments;
        $commentForm = new CommentForm();
     /*   return $this->render('single',
      [ 
          'task'=>$task,
      ]  
    );*/

        return $this->render('view', [
           'model' => $this->findModel($id),
           'task'=>$task,
           'comments'=>$comments,
           'commentForm'=>$commentForm,
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetCategory($id)
    {
        $task = $this->findModel($id);
        $selectedCategory = $task->category->id;
        //$result = ArrayHelper::map(Category::find()->all(), 'id', 'name');
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');;

        if (true) {

            $category = Yii::$app->request->post('category');
            if ($task->saveCategory($category)) {
                return $this->redirect(['view', 'id' => $task->id]);
            }
            //  $task->saveCategory($category);
        }

        return $this->render('category', [
            'task' => $task,
            'selectedCateory' => $selectedCategory,
            'categories' => $categories
        ]);
    

    }

    public function actionComment($id){
        $model = new CommentForm();
        
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
                return $this->redirect(['task/view','id'=>$id]);
            }
        }
    }


}
