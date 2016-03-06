<?php
namespace fay\models;

use fay\core\Model;
use fay\models\tables\Tags;
use fay\models\tables\PostsTags;
use fay\core\Sql;
use fay\models\tables\Posts;

class Tag extends Model{
	/**
	 * @return Tag
	 */
	public static function model($class_name = __CLASS__){
		return parent::model($class_name);
	}
	
	/**
	 * 设置一篇文章的标签
	 * @param string|array $tags 逗号分割的标签文本，或由标签文本构成的一维数组。若为空，则删除指定文章的所有标签
	 * @param int $post_id
	 */
	public function set($tags, $post_id){
		if($tags){
			if(!is_array($tags)){
				$tags = explode(',', $tags);
			}
			$input_tag_ids = array();
			foreach($tags as $tag_title){
				if(!$tag_title = trim($tag_title))continue;
				$tag = Tags::model()->fetchRow(array(
					'title = ?'=>$tag_title,
				), 'id');
				if($tag){//已存在，获取id
					$input_tag_ids[] = $tag['id'];
				}else{//不存在，插入新tag
					$input_tag_ids[] = Tags::model()->insert(array(
						'title'=>$tag_title,
					));
				}
			}
			
			$old_tag_ids = PostsTags::model()->fetchCol('tag_id', array(
				'post_id = ?'=>$post_id,
			));
			
			//删除已被删除的标签
			$deleted_tag_ids = array_diff($old_tag_ids, $input_tag_ids);
			if($deleted_tag_ids){
				PostsTags::model()->delete(array(
					'post_id = ?'=>$post_id,
					'tag_id IN (?)'=>$deleted_tag_ids
				));
			}
			//插入新的标签
			$new_tag_ids = array_diff($input_tag_ids, $old_tag_ids);
			if($new_tag_ids){
				foreach($new_tag_ids as $v){
					PostsTags::model()->insert(array(
						'post_id'=>$post_id,
						'tag_id'=>$v,
					));
				}
			}
			//更新标签对应的文章数
			$update_tag_ids = array_merge($deleted_tag_ids, $new_tag_ids);
			if($update_tag_ids){
				$this->refreshCountByTagId($update_tag_ids);
			}
		}else{
			//删除全部tag
			$old_tag_ids = PostsTags::model()->fetchCol('tag_id', array(
				'post_id = ?'=>$post_id,
			));
			if($old_tag_ids){
				PostsTags::model()->delete(array(
					'post_id = ?'=>$post_id,
				));
				$this->refreshCountByTagId($old_tag_ids);
			}
		}
	}
	
	/**
	 * 根据tag_id刷新该tag的count种值
	 * @param int|array $tag_ids 可以传入单个ID或一维数组
	 */
	public function refreshCountByTagId($tag_ids){
		if(!is_array($tag_ids)){
			$tag_ids = array($tag_ids);
		}
		
		$sql = new Sql();
		foreach($tag_ids as $tag){
			//并不考虑定时发布的情况，因为没办法再定时触发这个统计
			$posts_tags = $sql->from('posts_tags', 'pt', 'COUNT(*) AS count')
				->joinLeft('posts', 'p', 'pt.post_id = p.id')
				->where(array(
					'pt.tag_id = '.$tag,
					'p.deleted = 0',
					'p.status = '.Posts::STATUS_PUBLISHED,
				))
				->fetchRow();
			Tags::model()->update(array(
				'count'=>$posts_tags['count'],
			), $tag);
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
		
		$sql = new Sql();
		$result = $sql->from('posts_tags', 'pt', 'tag_id')
			->distinct(true)
			->where(array(
				'post_id IN (?)'=>$post_id,
			))
			->fetchAll();
		
		$tag_ids = array();
		foreach($result as $r){
			$tag_ids[] = $r['tag_id'];
		}
		
		$this->refreshCountByTagId($tag_ids);
	}
}