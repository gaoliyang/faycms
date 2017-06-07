<?php 
namespace apidoc\helpers;

use cms\services\OptionService;
use fay\core\ErrorException;
use fay\helpers\NumberHelper;
use fay\helpers\UrlHelper;

/**
 * 生成链接
 */
class LinkHelper{
    /**
     * 获取接口链接
     * 支持变量有{$id}
     * @param array|int $api
     * @return string
     * @throws ErrorException
     */
    public static function getApiLink($api){
        if(NumberHelper::isInt($api)){
            $api = array(
                'id'=>$api,
            );
        }
        if(!isset($api['id'])){
            throw new ErrorException('必须传入接口id或包含接口id的数组');
        }

        $uri = OptionService::get('apidoc:api_uri', 'apidoc/frontend/api/item?api_id={$id}');

        preg_match_all('/{\$([\w:]+)}/', $uri, $matches);
        if(empty($matches)){
            throw new ErrorException('系统未设置uri或uri未包含任何变量，无法生成接口链接');
        }

        foreach($matches[1] as $param){
            if($param == 'id'){
                $uri = str_replace('{$id}', $api['id'], $uri);
            }else{
                throw new ErrorException('系统设置的uri包含无法识别的变量，生成接口链接失败');
            }
        }

        return UrlHelper::createUrl($uri);
    }
    /**
     * 获取模型链接
     * 支持变量有{$id}
     * @param array|int $model
     * @return string
     * @throws ErrorException
     */
    public static function getModelLink($model){
        if(NumberHelper::isInt($model)){
            $model = array(
                'id'=>$model,
            );
        }
        if(!isset($model['id'])){
            throw new ErrorException('必须传入模型id或包含模型id的数组');
        }

        $uri = OptionService::get('apidoc:model_uri', 'apidoc/frontend/model/item?model_id={$id}');

        preg_match_all('/{\$([\w:]+)}/', $uri, $matches);
        if(empty($matches)){
            throw new ErrorException('系统未设置uri或uri未包含任何变量，无法生成模型链接');
        }

        foreach($matches[1] as $param){
            if($param == 'id'){
                $uri = str_replace('{$id}', $model['id'], $uri);
            }else{
                throw new ErrorException('系统设置的uri包含无法识别的变量，生成模型链接失败');
            }
        }

        return UrlHelper::createUrl($uri);
    }
}