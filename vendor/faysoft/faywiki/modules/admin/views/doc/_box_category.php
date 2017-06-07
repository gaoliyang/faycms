<?php
use fay\helpers\HtmlHelper;
use cms\services\CategoryService;
?>
<div class="box" id="box-main-category" data-name="main_category">
    <div class="box-title">
        <a class="tools remove" title="隐藏"></a>
        <h4>分类</h4>
    </div>
    <div class="box-content">
        <?php echo F::form()->select('cat_id', array(
                CategoryService::service()->getIdByAlias('_system_wiki_doc')=>'--未分类--',
            ) + HtmlHelper::getSelectOptions($cats), array(
            'class'=>'form-control mw400',
        ))?>
        <p class="fc-grey mt5">修改文档主分类可能会影响附加属性（这取决于您是否设置有附加属性）</p>
    </div>
</div>