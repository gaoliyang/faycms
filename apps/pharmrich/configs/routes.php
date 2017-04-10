<?php
return array(
    '/^product\/(\d+)$/'=>'product/item:id=$1',
    '/^product\/([\w-]+)$/'=>'product/index:cat_alias=$1',
    
    '/^cook-recipe\/(\d+)$/'=>'cook-recipe/item:id=$1',
    '/^cook-recipe\/([\w-]+)$/'=>'cook-recipe/index:cat_alias=$1',
    
    '/^news\/(\d+)$/'=>'news/item:id=$1',
    '/^news\/([\w-]+)$/'=>'news/index:cat_alias=$1',

    '/^about$/'=>'page/item:alias=about',
    '/^shipment$/'=>'page/item:alias=shipment',
    '/^faq$/'=>'page/item:alias=faq',
    '/^order$/'=>'page/item:alias=order',
);