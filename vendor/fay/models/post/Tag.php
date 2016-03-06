<?php
namespace fay\models\post;

use fay\core\Model;
use fay\core\Sql;
use fay\models\tables\Tags;
use fay\helpers\ArrayHelper;
use fay\models\tables\Posts;
use fay\models\tables\PostsTags;

class Tag extends Model{
	/**
	 * 默认返回字段
	 */
	private $default_fields = array('id', 'title');
	
	/**
	 * @return Tag
	 */
	public static function model($class_name = __CLASS__){
		return parent::model($class_name);
	}
	
	/**
	 * 获取文章对应tags
	 * @param int $post_id 文章ID
	 * @param string $fields 标签字段，tags表字段
	 * @return array 返回包含文章tag信息的二维数组
	 */
	public function get($post_id, $fields = null){
		if(empty($fields) || empty($fields[0])){
			//若传入$fields为空，则返回默认字段
			$fields = $this->default_fields;
		}
		$sql = new Sql();
		return $sql->from('posts_tags', 'pt', '')
			->joinLeft('tags', 't', 'pt.tag_id = t.id', Tags::model()->formatFields($fields))
			->where(array(
				'pt.post_id = ?'=>$post_id,
			))
			->order('t.`count`')
			->fetchAll();
	}
	
	/**
	 * 批量获取文章对应tags
	 * @param array $post_ids 文章ID构成的二维数组
	 * @param string $fields 标签字段，tags表字段
	 * @return array 返回以文章ID为key的三维数组
	 */
	public function mget($post_ids, $fields = null){
		if(empty($fields) || empty($fields[0])){
			//若传入$fields为空，则返回默认字段
			$fields = $this->default_fields;
		}
		$sql = new Sql();
		$tags = $sql->from('posts_tags', 'pt', 'post_id')
			->joinLeft('tags', 't', 'pt.tag_id = t.id', Tags::model()->formatFields($fields))
			->where(array('pt.post_id IN (?)'=>$post_ids))
			->fetchAll();
		$return = array_fill_keys($post_ids, array());
		foreach($tags as $t){
			$p = $t['post_id'];
			unset($t['post_id']);
			$return[$p][] = $t;
		}
		return $return;
	}
	
	/**
	 * 根据tag_id刷新该tag的count种值
	 * @param int|array $tag_ids 可以传入单个ID或一维数组
	 */
	public function refreshCountByTagId($tag_ids){
		if(!is_array($tag_ids)){
			$tag_ids = array($tag_ids);
		}
		
		if($tag_ids){
			$sql = new Sql();
			$posts_tags = $sql->from('posts_tags', 'pt', 'COUNT(*) AS count, tag_id')
				->joinLeft('posts', 'p', 'pt.post_id = p.id')
				->where(array(
					'pt.tag_id IN (?)'=>$tag_ids,
					'p.deleted = 0',
					'p.status = '.Posts::STATUS_PUBLISHED,
				))//这里不限制publish_time条件，因为定时发布后没逻辑来更新标签对应文章数
				->group('pt.tag_id')
				->fetchAll();
			$posts_tags = ArrayHelper::column($posts_tags, 'count', 'tag_id');
			foreach($tag_ids as $tag){
				Tags::model()->update(array(
					'post_count'=>empty($posts_tags[$tag]) ? 0 : $posts_tags[$tag],
				), $tag);
			}
		}
	}
	
	/**
	 * 根据文章ID，刷新该文章对应的tags的count值
	 * @param int|array $post_id 可以传入单个ID或一维数组
	 */
	public function refreshCountByPostId($post_id){
		if(!is_array($post_id)){
			$post_id = array($post_id);
		}
		
		$tag_ids = PostsTags::model()->fetchCol('tag_id', array(
			'post_id IN (?)'=>$post_id,
		));
		
		$this->refreshCountByTagId($tag_ids);
	}
}