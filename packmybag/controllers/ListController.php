<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;


class ListController extends BaseController
{

    public function actionCreate_list(){

        $listname=Yii::$app->request->post('listname');
        $description=Yii::$app->request->post('description');
        $items = Yii::$app->request->post('selectedItems');
        $filters = Yii::$app->request->post('selectedFilters');

        $query= new Query();
        if($listInfo = $query->from('user_list')->where(['list_name'=>$listname,'userId'=>Yii::$app->user->id])->exists())
        {
            echo json_encode('bad');
        }
        else{

            Yii::$app->db->createCommand()
                ->insert('user_list',
                    ['list_name'=>$listname,'list_data'=>json_encode($items),'list_filter'=>json_encode($filters), 'list_description'=> $description, 'userId'=> Yii::$app->user->id])
                ->execute();
            echo json_encode('ok');
        }
    }

    public function actionUpdate_list(){
        $items = Yii::$app->request->post('selectedItems');
        $list_id = Yii::$app->request->post('listId');
        $listname=Yii::$app->request->post('listname');
        $description=Yii::$app->request->post('description');
        $filters = Yii::$app->request->post('selectedFilters');

        $query= new Query();
        if($listInfo = $query->from('user_list')->where(['list_id'=>$list_id,'userId'=>Yii::$app->user->id])->exists())
        {
            Yii::$app->db->createCommand()
                ->update('user_list',
                    ['list_name'=>$listname,'list_data'=>json_encode($items),'list_filter'=>json_encode($filters), 'list_description'=> $description], ['list_id'=>$list_id])
                ->execute();
            echo json_encode('ok');

        }
        else{

            echo json_encode('bad');
        }
    }

    public function actionAll_lists(){

        $query= new Query();
        $listInfo = $query->from('user_list')->select(['list_name','list_description','list_id'])->where(['userId'=>Yii::$app->user->id])->all();

        echo json_encode($listInfo);
    }

    public function actionUser_name(){

        $query= new Query();
        $listInfo = $query->from('user')->select(['email'])->where(['userId'=>Yii::$app->user->id])->all();

        echo json_encode($listInfo);
    }

    public function actionDelete_list(){

        $list_id = Yii::$app->request->post('listId');

        $query= new Query();
        if($listInfo = $query->from('user_list')->where(['userId'=>Yii::$app->user->id])->exists())
        {
            Yii::$app->db->createCommand()
                ->delete('user_list',
                    ['list_id'=>$list_id])
                ->execute();
            echo json_encode('ok');
        }
        else{

            echo json_encode('bad');
        }

    }

    public function actionCurrent_list(){

        $query= new Query();
        $list_id = Yii::$app->request->post('listID');
        $listInfo = $query->from('user_list')->select('*')->where(['userId'=>Yii::$app->user->id, 'list_id'=>$list_id])->all();

        echo json_encode($listInfo);
    }

    public function actionSection()
    {

        $query = new Query();

        $records=$query->select(['section.section_id','section_name','stuff_id','stuff_name'])->from('section')
            ->join('JOIN ','stuff','section.section_id=stuff.section_id')->all();
        $result=[];
        foreach($records as $record) {
            $result[$record['section_id']]['section_name']=$record['section_name'];
            $result[$record['section_id']]['stuffs'][]=['stuff_id'=>$record['stuff_id'],'stuff_name'=>$record['stuff_name']];
        }

        return json_encode($result);
    }

}

