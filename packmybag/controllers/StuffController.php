<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;


class StuffController extends BaseController{

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

    public function actionCategory()
    {

        $query = new Query();

        $records=$query->select(['cat_filters.cat_filter_id','cat_filter_name','filter_id','filter_name'])->from('cat_filters')
            ->join('JOIN ','filters','cat_filters.cat_filter_id=filters.cat_filter_id')->all();
        $result=[];
        foreach($records as $record) {
            $result[$record['cat_filter_id']]['cat_filter_name']=$record['cat_filter_name'];
            $result[$record['cat_filter_id']]['cat_filter_id']=$record['cat_filter_id'];
            $result[$record['cat_filter_id']]['filters'][]=['filter_id'=>$record['filter_id'],'filter_name'=>$record['filter_name']];

        }

        return json_encode($result);
    }

    public function actionStuffs()
    {
        $query = new Query();

        $records=$query->select(['filters.cat_filter_id','filters.filter_name','filter_stuff.filter_id','filter_stuff.stuff_id'])->from('filter_stuff')
            ->join('JOIN ','filters','filter_stuff.filter_id=filters.filter_id')->all();

        return json_encode($records);
    }



}