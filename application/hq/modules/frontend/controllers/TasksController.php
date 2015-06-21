<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 15/6/9
 * Time: 下午9:26
 */
namespace hq\modules\frontend\controllers;

use fay\core\Sql;
use fay\helpers\Date;
use hq\library\FrontController;
use hq\models\tables\ZbiaoRecords;
use hq\models\ZbiaoRecord;

class TasksController extends FrontController
{
    public function index()
    {
        $str = '2015-6-2 00:00:00';
        $str1 =  strtotime($str) + 60*60*12;
        echo date('Y-m-d H:i:s', $str1);
    }

    public function show()
    {
        $this->layout->title = '水电详情';

        //        显示第一个电表的数据
        $condition = ['biao_id = ?' => 1001];
        $sql = new Sql();
        $chat_data = $sql->from('zbiao_records', 'records', 'day_use')
            ->where($condition)
            ->order('created desc')
            ->limit(10)
            ->fetchAll();
        $chat_date = $sql->from('zbiao_records', 'records', 'created')
            ->where($condition)
            ->order('created desc')
            ->limit(10)
            ->fetchAll();

        $this->view->data = ZbiaoRecord::getChatData($chat_data);
        $this->view->date = ZbiaoRecord::getChatData($chat_date, true);

        $this->view->render();
    }

    public function getData()
    {
        $data['code'] = 0;
        $type = $this->input->post('type', 'intval');
        $tree_id = $this->input->post('treeId', 'intval');
        $name = $this->input->post('name');
        $text = $this->input->post('text');

        $condition = ['biao_id = ?' => $tree_id];
        $sql = new Sql();
        $chat_data = $sql->from('zbiao_records', 'records', 'day_use')
            ->where($condition)
            ->order('created asc')
            ->limit(10)
            ->fetchAll();
        $chat_date = $sql->from('zbiao_records', 'records', 'created')
            ->where($condition)
            ->order('created asc')
            ->limit(10)
            ->fetchAll();
        if (!$chat_data)
        {
            $this->finish(['code' => -1, 'message' => '暂无数据']);
        }
        $data['data'] = ZbiaoRecord::getChatData($chat_data);
        $data['date'] = ZbiaoRecord::getChatData($chat_date, true);
        $data['name'] = $name;
        $data['text'] = $text;
        $data['type'] = $type;

        $this->finish($data);
    }

    public function getDataByTime()
    {
        $data['code'] = 0;

        $time = $this->input->get('time', 'intval');

        if ($time == ZbiaoRecords::TIME_DAY) {

        } elseif ($time == ZbiaoRecords::TIME_WEEK) {

        } elseif ($time == ZbiaoRecords::TIME_MONTH) {

        }


        $this->finish($data);
    }
}