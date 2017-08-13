<?php
namespace guangong\services;

use fay\core\Loader;
use fay\core\Service;
use cms\services\user\UserService;
use guangong\models\tables\GuangongAttendancesTable;
use guangong\models\tables\GuangongRanksTable;
use guangong\models\tables\GuangongUserExtraTable;

class RankService extends Service{
    /**
     * @return $this
     */
    public static function service(){
        return Loader::singleton(__CLASS__);
    }
    
    /**
     * 更新用户军衔
     * @param null|int $user_id 用户ID，默认为当前登录用户ID
     * @return bool
     * @throws \ErrorException
     */
    public function update($user_id = null){
        $user_id = UserService::makeUserID($user_id);
        
        //获取用户当前军衔
        $user = GuangongUserExtraTable::model()->find($user_id, 'rank_id');
        if($user['rank_id']){
            $rank = GuangongRanksTable::model()->find($user['rank_id'], 'sort');
            if(!$rank){
                throw new \ErrorException("用户{$user_id}军衔异常");
            }
        }else{
            $rank['sort'] = 0;
        }
        
        //获取用户下一级军衔
        $next_rank = GuangongRanksTable::model()->fetchRow(array(
            'sort > ' . $rank['sort']
        ), '*', 'sort');
        
        if(!$next_rank){
            //已经是最高军衔，不能继续提升了
            return false;
        }
        
        //是否提升军衔
        $raise = true;
    
        //连续出勤规则
        if($next_rank['continuous']){
            //获取最后一条出勤记录
            $last_attendance = GuangongAttendancesTable::model()->fetchRow(
                array(
                    'user_id = ?'=>$user_id,
                ),
                'continuous',
                'id DESC'
            );
            
            if($last_attendance['continuous'] < $next_rank['continuous']){
                $raise = false;
            }
        }
    
        //累计出勤规则
        if($raise && $next_rank['months'] && $next_rank['times']){
            //获取指定时间段内累计出勤天数
            $attendance_count = GuangongAttendancesTable::model()->fetchRow(array(
                'create_time > ' . mktime(0, 0, 0, date('m'), date('d') - $next_rank['months'] * 30, date('Y')),
            ), 'COUNT(*) AS count');
            
            if($attendance_count['count'] < $next_rank['times']){
                $raise = false;
            }
        }
        
        if($raise){
            //符合提升条件，提升军衔
            GuangongUserExtraTable::model()->update(array(
                'rank_id'=>$next_rank['id'],
            ), $user_id);
        }
        
        return $raise;
    }
}