<?php
namespace fay\models\user;

use fay\core\Model;
use fay\core\Hook;
use fay\core\Exception;
use fay\models\tables\Users;
use fay\models\tables\Follows;
use fay\helpers\ArrayHelper;

class Follow extends Model{
	/**
	 * @return Follow
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	/**
	 * 关注一个用户
	 * @param int $user_id 要关注的人
	 * @param null|int $fans_id 粉丝，默认为当前登陆用户
	 * @param bool|int 是否真实用户（社交网站总是免不了要做个假）
	 */
	public static function follow($user_id, $fans_id = null, $is_real = true){
		$fans_id || $fans_id = \F::app()->current_user;
		if(!$fans_id){
			throw new Exception('未能获取到粉丝ID');
		}
		
		if($user_id == $fans_id){
			throw new Exception('粉丝和用户ID不能相同');
		}
		
		$user = Users::model()->find($user_id, 'id');
		if(!$user){
			throw new Exception('关注的用户ID不存在');
		}
		
		if(self::isFollow($user_id, $fans_id)){
			throw new Exception('已关注，不能重复关注');
		}
		
		$isFollow = self::isFollow($fans_id, $user_id);
		Follows::model()->insert(array(
			'fans_id'=>$fans_id,
			'user_id'=>$user_id,
			'create_time'=>\F::app()->current_time,
			'relation'=>$isFollow ? Follows::RELATION_TWO_WAY : Follows::RELATION_ONE_WAY,
			'is_real'=>$is_real ? 1 : 0,
		));
		
		if($isFollow){
			//若存在反向关注，则将反向关注记录的relation也置为双向关注
			Follows::model()->update(array(
				'relation'=>Follows::RELATION_TWO_WAY,
			), array(
				'user_id = ?'=>$fans_id,
				'fans_id = ?'=>$user_id,
			));
		}
		
		//执行钩子
		Hook::getInstance()->call('after_follow');
	}
	
	/**
	 * 取消关注
	 * @param int $user_id 取消关注的人
	 * @param null|int $fans_id 粉丝，默认为当前登录用户
	 */
	public static function unfollow($user_id, $fans_id = null){
		$fans_id || $fans_id = \F::app()->current_user;
		if(!$fans_id){
			throw new Exception('未能获取到粉丝ID');
		}
		
		//删除关注关系
		Follows::model()->delete(array(
			'fans_id = ?'=>$fans_id,
			'user_id = ?'=>$user_id,
		));
		
		//若互相关注，则更新反向关注的关注关系
		if(self::isFollow($fans_id, $user_id)){
			Follows::model()->update(array(
				'relation'=>Follows::RELATION_ONE_WAY,
			), array(
				'fans_id = ?'=>$user_id,
				'user_id = ?'=>$fans_id,
			));
		}
		
		//执行钩子
		Hook::getInstance()->call('after_unfollow');
	}
	
	/**
	 * 判断第二个用户ID是不是关注了第一个用户ID
	 * @param int $user_id 被关注的人ID
	 * @param string $fans_id 粉丝ID，默认为当前登录用户
	 * @return int 0-未关注;1-单向关注;2-双向关注
	 */
	public static function isFollow($user_id, $fans_id = null){
		$fans_id || $fans_id = \F::app()->current_user;
		if(!$fans_id){
			throw new Exception('未能获取到粉丝ID');
		}
		
		$follow = Follows::model()->find(array($fans_id, $user_id), 'relation');
		if($follow){
			return intval($follow['relation']);//为了保证返回字段类型一致，这里intval一下
		}else{
			return 0;
		}
	}
	
	/**
	 * 批量验证是否关注
	 * @param unknown $user_ids
	 * @param string $fans_id
	 * @return array 根据传入的$user_ids为数组的键，对应值为:0-未关注;1-单向关注;2-双向关注
	 */
	public static function mIsFollow($user_ids, $fans_id = null){
		$fans_id || $fans_id = \F::app()->current_user;
		if(!$fans_id){
			throw new Exception('未能获取到粉丝ID');
		}
		
		$follows = Follows::model()->fetchAll(array(
			'fans_id = ?'=>$fans_id,
			'user_id IN (?)'=>$user_ids,
		), 'user_id,relation');
		
		$follow_map = ArrayHelper::column($follows, 'relation', 'user_id');
		
		$return = array();
		foreach($user_ids as $u){
			$return[$u] = isset($follow_map[$u]) ? intval($follow_map[$u]) : 0;
		}
		return $return;
	}
	
}