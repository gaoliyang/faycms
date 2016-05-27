<?php
namespace fay\models;

use fay\core\Model;
use fay\models\tables\Props;
use fay\models\tables\PropValues;
use fay\core\Sql;
use fay\helpers\StringHelper;
use fay\helpers\ArrayHelper;

class Prop extends Model{
	/**
	 * @param string $class_name
	 * @return Prop
	 */
	public static function model($class_name = __CLASS__){
		return parent::model($class_name);
	}
	
	public function create($refer, $type, $prop, $values = array()){
		$prop_id = Props::model()->insert(array(
			'refer'=>$refer,
			'type'=>$type,
			'title'=>$prop['title'],
			'alias'=>$prop['alias'],
			'element'=>$prop['element'],
			'required'=>empty($prop['required']) ? 0 : 1,
			'is_show'=>isset($prop['is_show']) ? $prop['is_show'] : 1,
			'sort'=>isset($prop['sort']) ? $prop['sort'] : 0,
			'create_time'=>\F::app()->current_time,
		));
		
		if(in_array($prop['element'], array(
			Props::ELEMENT_RADIO,
			Props::ELEMENT_SELECT,
			Props::ELEMENT_CHECKBOX,
		))){
			//设置可选属性值
			$i = 0;
			foreach($values as $pv){
				$i++;
				PropValues::model()->insert(array(
					'prop_id'=>$prop_id,
					'title'=>$pv,
					'sort'=>$i,
					'refer'=>$refer,
				));
			}
		}
		
		return $prop_id;
	}
	
	/**
	 * 更新属性
	 * @param int $refer 引用
	 * @param int $prop_id 属性ID
	 * @param array $prop 属性参数
	 * @param array $values 属性值
	 * @param array $ids 原属性ID数组，键值为空表示新增值
	 */
	public function update($refer, $prop_id, $prop, $values = array(), $ids = array()){
		$old_ids = array_filter($ids);
		$old_ids || $old_ids = array('-1');
		
		Props::model()->update($prop, $prop_id);
		
		//删除原有但现在没了的属性值
		PropValues::model()->update(array(
			'deleted'=>1,
		),array(
			'prop_id = ?'=>$prop_id,
			'id NOT IN ('.implode(',', $old_ids).')',
		));
		//设置属性值
		if(in_array($prop['element'], array(
			Props::ELEMENT_RADIO,
			Props::ELEMENT_SELECT,
			Props::ELEMENT_CHECKBOX,
		))){//手工录入属性没有属性值
			$i = 0;
			foreach($values as $k => $v){
				$i++;
				if(!empty($ids[$k])){
					PropValues::model()->update(array(
						'title'=>$v,
						'sort'=>$i,
					), array(
						'id = ?'=>$ids[$k],
					));
				}else{
					PropValues::model()->insert(array(
						'prop_id'=>$prop_id,
						'title'=>$v,
						'sort'=>$i,
						'refer'=>$refer,
					));
				}
			}
		}
	}
	
	public function delete($id){
		Props::model()->update(array(
			'deleted'=>1,
		), $id);
	}
	
	/**
	 * 获取一个属性，若其为可选属性，则同时获取所有可选项
	 * @param int $id
	 * @return array|bool
	 */
	public function get($id){
		$prop = Props::model()->fetchRow(array(
			'id = ?'=>$id,
			'deleted = 0',
		));
		
		if(!$prop) return array();
		
		if(in_array($prop['element'], array(
			Props::ELEMENT_RADIO,
			Props::ELEMENT_SELECT,
			Props::ELEMENT_CHECKBOX,
		))){
			$prop['values'] = PropValues::model()->fetchAll(array(
				'prop_id = ?'=>$prop['id'],
				'deleted = 0',
			), '*', 'sort');
		}
		
		return $prop;
	}
	
	/**
	 * 获取一个或多个引用ID对应的属性
	 * 若fields字段包含values，则同时获取可选属性值
	 * @param int|array $refer 引用
	 * @param int $type
	 * @param bool $with_values
	 * @return array
	 */
	public function mget($refer, $type, $with_values = true){
		if(is_array($refer)){
			$refer = implode(',', $refer);
		}
		if(StringHelper::isInt($refer)){
			//获取单个属性
			$props = Props::model()->fetchAll(array(
				'refer = ?'=>$refer,
				'type = ?'=>$type,
				'deleted = 0',
			), 'id,title,type,required,element', 'sort, id');
		}else if(!empty($refer)){
			//一次获取多个属性
			$props = Props::model()->fetchAll(array(
				"refer IN ({$refer})",
				'type = ?'=>$type,
				'deleted = 0',
			), 'id,title,type,required,element', 'sort, id');
		}else{
			return array();
		}
		
		//附加属性可选值
		if($with_values && $props){
			$props = $this->addValues($props);
		}
		
		return $props;
	}
	
	/**
	 * 获取一个或多个别名对应的属性
	 * 若fields字段包含values，则同时获取可选属性值
	 * @param array|string $aliases 属性别名
	 * @param int $type
	 * @param bool $with_values
	 * @return array
	 */
	public function mgetByAlias($aliases, $type, $with_values = true){
		if(!is_array($aliases)){
			$aliases = explode(',', $aliases);
		}
		if(isset($aliases[1])){
			//如果有多项，搜索条件用IN
			$props = Props::model()->fetchAll(array(
				'alias IN (?)'=>$aliases,
				'type = ?'=>$type,
				'deleted = 0',
			), 'id,title,type,required,element', 'sort,id');
		}else{
			//如果只有一项，搜索条件直接用等于
			$props = Props::model()->fetchAll(array(
				'alias = ?'=>$aliases,
				'type = ?'=>$type,
				'deleted = 0',
			), 'id,title,type,required,element', 'sort,id');
		}
		
		if($with_values && $props){
			//附加属性可选值
			$props = $this->addValues($props);
		}
		
		return $props;
	}
	
	/**
	 * 为props附加可选值
	 * @param array $props
	 * @return array
	 */
	private function addValues($props){
		//获取属性对应的可选属性值
		$prop_ids = ArrayHelper::column($props, 'id');
		if(isset($prop_ids[1])){
			$prop_values = PropValues::model()->fetchAll(array(
				'prop_id IN (?)'=>$prop_ids,
				'deleted = 0',
			), 'id,title,prop_id', 'prop_id,sort');
		}else{
			$prop_values = PropValues::model()->fetchAll(array(
				'prop_id = ?'=>$prop_ids,
				'deleted = 0',
			), 'id,title,prop_id', 'prop_id,sort');
		}
		foreach($props as &$p){
			//保证各项返回数据字段一致性，没有选项的输入类型也返回空的options
			$p['options'] = array();
			if(in_array($p['element'], array(
				Props::ELEMENT_RADIO,
				Props::ELEMENT_SELECT,
				Props::ELEMENT_CHECKBOX,
			))){
				$start = false;
				foreach($prop_values as $k => $v){
					if($v['prop_id'] == $p['id']){
						$p['options'][] = array(
							'id'=>$v['id'],
							'title'=>$v['title'],
						);
						$start = true;
						unset($prop_values[$k]);
					}else if($start){
						break;
					}
				}
			}
		}
		
		return $props;
	}
	
	/**
	 * 创建一个属性集
	 * @param string $field 字段名，$refer对应的字段
	 * @param int $refer $models中对应的字段值
	 * @param array $props 属性集合
	 * @param array $data 属性值，以属性集合的id为键的数组
	 * @param array $models varchar, int, text等字段类型对应的表模型
	 */
	public function createPropertySet($field, $refer, $props, $data, $models){
		foreach($props as $p){
			switch($p['element']){
				case Props::ELEMENT_TEXT:
					\F::model($models['varchar'])->insert(array(
						$field=>$refer,
						'prop_id'=>$p['id'],
						'content'=>$data[$p['id']],
					));
					break;
				case Props::ELEMENT_RADIO:
					if(isset($data[$p['id']])){
						\F::model($models['int'])->insert(array(
							$field=>$refer,
							'prop_id'=>$p['id'],
							'content'=>intval($data[$p['id']]),
						));
					}
					break;
				case Props::ELEMENT_SELECT:
					if(!empty($data[$p['id']])){
						\F::model($models['int'])->insert(array(
							$field=>$refer,
							'prop_id'=>$p['id'],
							'content'=>intval($data[$p['id']]),
						));
					}
					break;
				case Props::ELEMENT_CHECKBOX:
					if(isset($data[$p['id']])){
						foreach($data[$p['id']] as $v){
							\F::model($models['int'])->insert(array(
								$field=>$refer,
								'prop_id'=>$p['id'],
								'content'=>intval($v),
							));
						}
					}
					break;
				case Props::ELEMENT_TEXTAREA:
					if(!empty($data[$p['id']])){
						\F::model($models['text'])->insert(array(
							$field=>$refer,
							'prop_id'=>$p['id'],
							'content'=>$data[$p['id']],
						));
					}
					break;
			}
		}
	}
	
	/**
	 * 获取一个属性集
	 * @param $field
	 * @param $refer
	 * @param $props
	 * @param $models
	 * @return array
	 */
	public function getPropertySet($field, $refer, $props, $models){
		$property_set = array();
		$sql = new Sql();
		foreach($props as $p){
			switch($p['element']){
				case Props::ELEMENT_TEXT:
					$value = \F::model($models['varchar'])->fetchRow(array(
						"{$field} = ?"=>$refer,
						'prop_id = ?'=>$p['id'],
					), 'content');
					if($value){
						$p['value'] = $value['content'];
					}else{
						$p['value'] = '';
					}
					break;
				case Props::ELEMENT_RADIO:
					$value = $sql->from(array('pi'=>\F::model($models['int'])->getTableName()), '')
						->joinLeft(array('v'=>'prop_values'), 'pi.content = v.id', 'id')
						->where(array(
							"pi.{$field} = ?"=>$refer,
							'pi.prop_id = ?'=>$p['id'],
						))
						->fetchRow()
					;
					$p['value'] = $value['id'];
					break;
				case Props::ELEMENT_SELECT:
					$value = $sql->from(array('pi'=>\F::model($models['int'])->getTableName()), '')
						->joinLeft(array('v'=>'prop_values'), 'pi.content = v.id', 'id')
						->where(array(
							"pi.{$field} = ?"=>$refer,
							'pi.prop_id = ?'=>$p['id'],
						))
						->fetchRow()
					;
					$p['value'] = $value['id'];
					break;
				case Props::ELEMENT_CHECKBOX:
					$value = $sql->from(array('pi'=>\F::model($models['int'])->getTableName()), '')
						->joinLeft(array('v'=>'prop_values'), 'pi.content = v.id', 'id')
						->where(array(
							"pi.{$field} = ?"=>$refer,
							'pi.prop_id = ?'=>$p['id'],
						))
						->fetchAll()
					;
					$p['value'] = implode(',', ArrayHelper::column($value, 'id'));
					break;
				case Props::ELEMENT_TEXTAREA:
					$value = \F::model($models['text'])->fetchRow(array(
						"{$field} = ?"=>$refer,
						'prop_id = ?'=>$p['id'],
					), 'content');
					if($value){
						$p['value'] = $value['content'];
					}else{
						$p['value'] = '';
					}
					break;
			}
			$property_set[] = $p;
		}
		return $property_set;
	}
	
	/**
	 * 更新一个属性集
	 * @param string $field 字段名，$refer对应的字段
	 * @param int $refer 字段值
	 * @param array $props 属性集合
	 * @param array $data 属性值
	 * @param array $models varchar, int, text等字段类型对应的表模型
	 */
	public function updatePropertySet($field, $refer, $props, $data, $models){
		foreach($props as $p){
			switch($p['element']){
				case Props::ELEMENT_TEXT:
					//如果存在，且值有变化，则更新；不存在，则插入
					$record = \F::model($models['varchar'])->fetchRow(array(
						"{$field} = ?"=>$refer,
						'prop_id = ?'=>$p['id'],
					), 'content');
					if($record){
						if($record['content'] != $data[$p['id']]){
							\F::model($models['varchar'])->update(array(
								'content'=>$data[$p['id']],
							), array(
								"{$field} = ?"=>$refer,
								'prop_id = ?'=>$p['id'],
							));
						}
					}else{
						\F::model($models['varchar'])->insert(array(
							$field=>$refer,
							'prop_id'=>$p['id'],
							'content'=>$data[$p['id']],
						));
					}
					break;
				case Props::ELEMENT_RADIO:
					$record = \F::model($models['int'])->fetchRow(array(
						"{$field} = ?"=>$refer,
						'prop_id = ?'=>$p['id'],
					), 'content');
					if(empty($data[$p['id']])){
						//若无提交值，且原先有值，则删除以前的值
						if($record){
							\F::model($models['int'])->delete(array(
								"{$field} = ?"=>$refer,
								'prop_id = ?'=>$p['id'],
							));
						}
					}else{
						//如果存在，且值有变化，则更新；不存在，则插入
						if($record){
							if($record['content'] != $data[$p['id']]){
								\F::model($models['int'])->update(array(
									'content'=>intval($data[$p['id']]),
								), array(
									"{$field} = ?"=>$refer,
									'prop_id = ?'=>$p['id'],
								));
							}
						}else{
							\F::model($models['int'])->insert(array(
								$field=>$refer,
								'prop_id'=>$p['id'],
								'content'=>intval($data[$p['id']]),
							));
						}
					}
					break;
				case Props::ELEMENT_SELECT:
					$record = \F::model($models['int'])->fetchRow(array(
						"{$field} = ?"=>$refer,
						'prop_id = ?'=>$p['id'],
					), 'content');
					if(empty($data[$p['id']])){
						//若无提交值，且原先有值，则删除以前的值
						if($record){
							\F::model($models['int'])->delete(array(
								"{$field} = ?"=>$refer,
								'prop_id = ?'=>$p['id'],
							));
						}
					}else{
						//如果存在，且值有变化，则更新；不存在，则插入
						if($record){
							if($record['content'] != $data[$p['id']]){
								\F::model($models['int'])->update(array(
									'content'=>intval($data[$p['id']]),
								), array(
									"{$field} = ?"=>$refer,
									'prop_id = ?'=>$p['id'],
								));
							}
						}else{
							\F::model($models['int'])->insert(array(
								$field=>$refer,
								'prop_id'=>$p['id'],
								'content'=>intval($data[$p['id']]),
							));
						}
					}
					break;
				case Props::ELEMENT_CHECKBOX:
					//获取已存在的项
					$old_options = \F::model($models['int'])->fetchCol('content', array(
						"{$field} = ?"=>$refer,
						'prop_id = ?'=>$p['id'],
					));
					if(isset($data[$p['id']])){
						//删除已经不存在的项
						$delete_options = array_diff($old_options, $data[$p['id']]);
						if($delete_options){
							\F::model($models['int'])->delete(array(
								"{$field} = ?"=>$refer,
								'prop_id = ?'=>$p['id'],
								'content IN (?)'=>$delete_options,
							));
						}
						
						//插入新增项
						$new_options = array_diff($data[$p['id']], $old_options);
						if($new_options){
							foreach($new_options as $p_value){
								\F::model($models['int'])->insert(array(
									$field=>$refer,
									'prop_id'=>$p['id'],
									'content'=>intval($p_value),
								));
							}
						}
					}else{
						//若无提交值，且原先有值，则删除以前的值
						if($old_options){
							\F::model($models['int'])->delete(array(
								"{$field} = ?"=>$refer,
								'prop_id = ?'=>$p['id'],
							));
						}
					}
					break;
				case Props::ELEMENT_TEXTAREA:
					$record = \F::model($models['text'])->fetchRow(array(
						"{$field} = ?"=>$refer,
						'prop_id = ?'=>$p['id'],
					), 'content');
					//如果存在，且值有变化，则更新；不存在，则插入
					if($record){
						if($record['content'] != $data[$p['id']]){
							\F::model($models['text'])->update(array(
								'content'=>$data[$p['id']],
							), array(
								"{$field} = ?"=>$refer,
								'prop_id = ?'=>$p['id'],
							));
						}
					}else{
						\F::model($models['text'])->insert(array(
							$field=>$refer,
							'prop_id'=>$p['id'],
							'content'=>$data[$p['id']],
						));
					}
					break;
			}
		}
	}
	
	/**
	 * 根据属性别名，单一更新一个属性的属性值
	 * @param string $field 字段名，$refer对应的字段
	 * @param int $refer 字段值
	 * @param string $alias 属性别名
	 * @param mixed $value 属性值<br>
	 * 若属性元素对应的是输入框，文本域或单选框，则直接更新属性值<br>
	 * 若属性元素对应的是多选框：<br>
	 *     当$value是数字的时候，仅做插入（已存在则无操作）操作，<br>
	 *     当$value是数组的时候，将影响原有的属性值（不存在则删除，已存在则无操作）。
	 * @param array $models varchar, int, text等字段类型对应的表模型
	 * @return bool
	 */
	public function setPropValueByAlias($field, $refer, $alias, $value, $models){
		$prop = Props::model()->fetchRow(array(
			'alias = ?'=>$alias,
		), 'id,element');
		if(!$prop) return false;
	
		if(in_array($prop['element'], array(
			Props::ELEMENT_RADIO,
			Props::ELEMENT_SELECT,
		))){
			if(\F::model($models['int'])->fetchRow(array(
				"{$field} = ?"=>$refer,
				'prop_id = ?'=>$prop['id'],
			))){
				\F::model($models['int'])->update(array(
					'content'=>intval($value),
				), array(
					"{$field} = ?"=>$refer,
					'prop_id = ?'=>$prop['id'],
				));
			}else{
				\F::model($models['int'])->insert(array(
					$field=>$refer,
					'prop_id'=>$prop['id'],
					'content'=>intval($value),
				));
			}
		}else if($prop['element'] == Props::ELEMENT_CHECKBOX){
			if(is_array($value)){//$value是数组，完整更新
				//删除已经不存在的项
				\F::model($models['int'])->delete(array(
					"{$field} = ?"=>$refer,
					'prop_id = ?'=>$prop['id'],
					'content NOT IN ('.implode(',', \F::filter('intval', $value)).')',
				));
				//获取已存在的项
				$old_options = \F::model($models['int'])->fetchCol('content', array(
					"{$field} = ?"=>$refer,
					'prop_id = ?'=>$prop['id'],
				));
				//插入新增项
				foreach($value as $p_value){
					if(!in_array($p_value, $old_options)){
						\F::model($models['int'])->insert(array(
							$field=>$refer,
							'prop_id'=>$prop['id'],
							'content'=>intval($p_value),
						));
					}
				}
			}else{//$value不是数组，仅更新一个属性值选项
				if(\F::model($models['int'])->fetchRow(array(
					"{$field} = ?"=>$refer,
					'prop_id = ?'=>$prop['id'],
				))){
					\F::model($models['int'])->update(array(
						'content'=>intval($value),
					), array(
						"{$field} = ?"=>$refer,
						'prop_id = ?'=>$prop['id'],
					));
				}else{
					\F::model($models['int'])->insert(array(
						$field=>$refer,
						'prop_id'=>$prop['id'],
						'content'=>intval($value),
					));
				}
			}
		}else if($prop['element'] == Props::ELEMENT_TEXT){
			/*
			 * 如果存在，则更新，不存在，则插入
			 */
			if(\F::model($models['varchar'])->fetchRow(array(
				"{$field} = ?"=>$refer,
				'prop_id = ?'=>$prop['id'],
			))){
				\F::model($models['varchar'])->update(array(
					'content'=>$value,
				), array(
					"{$field} = ?"=>$refer,
					'prop_id = ?'=>$prop['id'],
				));
			}else{
				\F::model($models['varchar'])->insert(array(
					$field=>$refer,
					'prop_id'=>$prop['id'],
					'content'=>$value,
				));
			}
		}else{
			/*
			 * 如果存在，则更新，不存在，则插入
			 */
			if(\F::model($models['text'])->fetchRow(array(
				"{$field} = ?"=>$refer,
				'prop_id = ?'=>$prop['id'],
			))){
				\F::model($models['text'])->update(array(
					'content'=>$value,
				), array(
					"{$field} = ?"=>$refer,
					'prop_id = ?'=>$prop['id'],
				));
			}else{
				\F::model($models['text'])->insert(array(
					$field=>$refer,
					'prop_id'=>$prop['id'],
					'content'=>$value,
				));
			}
		}
		return true;
	}
	
	/**
	 * 获取一个用户属性值
	 * @param $field
	 * @param $refer
	 * @param string $alias
	 * @param $models
	 * @return mixed
	 */
	public function getPropValueByAlias($field, $refer, $alias, $models){
		$prop = Props::model()->fetchRow(array(
			'alias = ?'=>$alias,
		), 'id,element');
		if(!$prop) return false;
		
		$sql = new Sql();
		switch($prop['element']){
			case Props::ELEMENT_TEXT:
				$value = \F::model($models['varchar'])->fetchRow(array(
					"{$field} = ?"=>$refer,
					'prop_id = ?'=>$prop['id'],
				), 'content');
				if($value){
					return $value['content'];
				}else{
					return '';
				}
			case Props::ELEMENT_RADIO:
				return $sql->from(array('pi'=>\F::model($models['int'])->getTableName()), '')
					->joinLeft(array('v'=>'prop_values'), 'pi.content = v.id', 'id,title')
					->where(array(
						"pi.{$field} = ?"=>$refer,
						'pi.prop_id = ?'=>$prop['id'],
					))
					->fetchRow()
				;
			case Props::ELEMENT_SELECT:
			case Props::ELEMENT_CHECKBOX:
			return $sql->from(array('pi'=>\F::model($models['int'])->getTableName()), '')
				->joinLeft(array('v'=>'prop_values'), 'pi.content = v.id', 'id,title')
				->where(array(
					"pi.{$field} = ?"=>$refer,
					'pi.prop_id = ?'=>$prop['id'],
				))
				->fetchRow()
				;
			return $sql->from(array('pi'=>\F::model($models['int'])->getTableName()), '')
					->joinLeft(array('v'=>'prop_values'), 'pi.content = v.id', 'id,title')
					->where(array(
						"pi.{$field} = ?"=>$refer,
						'pi.prop_id = ?'=>$prop['id'],
					))
					->fetchAll()
				;
			case Props::ELEMENT_TEXTAREA:
				$value = \F::model($models['text'])->fetchRow(array(
					"{$field} = ?"=>$refer,
					'prop_id = ?'=>$prop['id'],
				), 'content');
				if($value){
					return $value['content'];
				}else{
					return '';
				}
		}
	}
	
	/**
	 * 根据属性别名，获取可选的属性值
	 * @param $alias
	 * @return array|bool
	 */
	public function getPropOptionsByAlias($alias){
		$prop = Props::model()->fetchRow(array(
			'alias = ?'=>$alias,
			'deleted = 0',
		), 'id');
		if($prop){
			return PropValues::model()->fetchAll(array(
				'prop_id = '.$prop['id'],
				'deleted = 0',
			), 'id,title,default', 'sort');
		}else{
			return false;
		}
	}
	
	/**
	 * 根据属性别名，获取属性ID
	 * @param string $alias
	 * @return int
	 */
	public function getIdByAlias($alias){
		$prop = Props::model()->fetchRow(array(
			'alias = ?'=>$alias,
		), 'id');
		return $prop['id'];
	}
}