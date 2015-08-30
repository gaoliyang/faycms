-- 小工具
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('55e0607f06b41', '{\"title\":\"\",\"number\":8,\"cat_id\":0,\"template\":\"frontend\\/widgets\\/friendlinks\"}', 'fay/friendlinks', '底部友情链接', 'index-friendlinks', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('55e0642bec8b5', '{\"elementId\":\"slide\",\"animSpeed\":500,\"pauseTime\":5000,\"effect\":\"random\",\"directionNav\":0,\"width\":333,\"height\":278,\"files\":[{\"file_id\":1005,\"link\":\"\",\"title\":\"20130730123509544.jpg\"},{\"file_id\":1006,\"link\":\"\",\"title\":\"20130730123524994.jpg\"},{\"file_id\":1007,\"link\":\"\",\"title\":\"m_1375319105324.jpg\"}]}', 'fay/jq_nivo_slider', '首页左上角轮播图', 'index-section-1', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('news', '{\"title\":\"\",\"top\":10001,\"subclassification\":1,\"number\":7,\"show_empty\":1,\"thumbnail\":0,\"order\":\"hand\",\"last_view_time\":0,\"date_format\":\"(Y-m-d)\",\"uri\":\"post\\/{$id}\",\"other_uri\":\"\",\"template\":\"frontend\\/widgets\\/box_news_list\"}', 'fay/category_post', '首页新闻中心', 'index-section-1', '2');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('noticeboard', '{\"title\":\"\",\"top\":10007,\"subclassification\":1,\"number\":9,\"show_empty\":0,\"thumbnail\":0,\"order\":\"hand\",\"last_view_time\":0,\"date_format\":\"(Y-m-d)\",\"uri\":\"post\\/{$id}\",\"other_uri\":\"\",\"template\":\"frontend\\/widgets\\/box_post_list\"}', 'fay/category_post', '公告栏', 'index-section-1', '3');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('55e07a3000417', '{\"title\":\"\",\"top\":10002,\"subclassification\":1,\"number\":6,\"show_empty\":0,\"thumbnail\":0,\"order\":\"hand\",\"last_view_time\":0,\"date_format\":\"(Y-m-d)\",\"uri\":\"post\\/{$id}\",\"other_uri\":\"\",\"template\":\"frontend\\/widgets\\/box_post_list\"}', 'fay/category_post', '教育活动', 'index-main-left', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('55e07a4633b8a', '{\"title\":\"\",\"top\":10003,\"subclassification\":1,\"number\":6,\"show_empty\":0,\"thumbnail\":0,\"order\":\"hand\",\"last_view_time\":0,\"date_format\":\"(Y-m-d)\",\"uri\":\"post\\/{$id}\",\"other_uri\":\"\",\"template\":\"frontend\\/widgets\\/box_post_list\"}', 'fay/category_post', '科研信息', 'index-main-left', '2');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('quick-link', '{\"template\":\"frontend\\/widgets\\/quick_link\",\"files\":[{\"file_id\":1008,\"link\":\"http:\\/\\/www.fayfox.com\",\"title\":\"quick-link-1.jpg\"},{\"file_id\":1009,\"link\":\"http:\\/\\/www.fayfox.com\",\"title\":\"quick-link-2.jpg\"},{\"file_id\":1010,\"link\":\"http:\\/\\/www.fayfox.com\",\"title\":\"quick-link-3.jpg\"}]}', 'fay/images', '专项入口', 'index-section-2', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('sidebar-ad', '{\"template\":\"<?php\\r\\nuse fay\\\\helpers\\\\Html;\\r\\nuse fay\\\\models\\\\File;\\r\\n?>\\r\\n<div class=\\\"widget widget-images\\\" id=\\\"widget-<?php echo Html::encode($alias)?>\\\">\\r\\n\\t<ul>\\r\\n\\t<?php foreach($files as $f){\\r\\n\\t\\tif(empty($f[\'link\'])){\\r\\n\\t\\t\\t$f[\'link\'] = \'javascript:;\';\\r\\n\\t\\t}\\r\\n\\t\\techo Html::link(Html::img($f[\'file_id\'], File::PIC_ORIGINAL, array(\\r\\n\\t\\t\\t\'width\'=>false,\\r\\n\\t\\t\\t\'height\'=>false,\\r\\n\\t\\t\\t\'alt\'=>Html::encode($f[\'title\']),\\r\\n\\t\\t)), str_replace(\'{$base_url}\', \\\\F::config()->get(\'base_url\'), $f[\'link\']), array(\\r\\n\\t\\t\\t\'encode\'=>false,\\r\\n\\t\\t\\t\'title\'=>Html::encode($f[\'title\']),\\r\\n\\t\\t\\t\'wrapper\'=>\'li\',\\r\\n\\t\\t\\t\'target\'=>\'_blank\',\\r\\n\\t\\t));\\r\\n\\t}?>\\r\\n\\t<\\/ul>\\r\\n<\\/div>\",\"files\":[{\"file_id\":1011,\"link\":\"\",\"title\":\"ad-img-1.jpg\"},{\"file_id\":1012,\"link\":\"\",\"title\":\"ad-img-2.jpg\"},{\"file_id\":1013,\"link\":\"\",\"title\":\"ad-img-3.jpg\"}]}', 'fay/images', '首页右侧广告位', 'index-main-right', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('55e119c0de4a2', '{\"title\":\"\",\"top\":10004,\"subclassification\":1,\"number\":6,\"show_empty\":0,\"thumbnail\":0,\"order\":\"hand\",\"last_view_time\":0,\"date_format\":\"(Y-m-d)\",\"uri\":\"post\\/{$id}\",\"other_uri\":\"\",\"template\":\"frontend\\/widgets\\/box_post_list\"}', 'fay/category_post', '成都改革', 'index-main-left', '3');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('55e11a4a12b0b', '{\"title\":\"\",\"top\":10005,\"subclassification\":1,\"number\":6,\"show_empty\":1,\"thumbnail\":0,\"order\":\"hand\",\"last_view_time\":0,\"date_format\":\"(Y-m-d)\",\"uri\":\"post\\/{$id}\",\"other_uri\":\"\",\"template\":\"frontend\\/widgets\\/box_post_list\"}', 'fay/category_post', '教学研究', 'index-main-left', '4');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('download', '{\"title\":\"\",\"top\":10008,\"subclassification\":1,\"number\":6,\"show_empty\":0,\"thumbnail\":0,\"order\":\"hand\",\"last_view_time\":0,\"date_format\":\"\",\"uri\":\"post\\/{$id}\",\"other_uri\":\"\",\"template\":\"frontend\\/widgets\\/download\"}', 'fay/category_post', '常用软件下载', 'index-main-right', '3');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('hot', '{\"title\":\"\",\"top\":10009,\"subclassification\":1,\"number\":5,\"show_empty\":0,\"thumbnail\":0,\"order\":\"hand\",\"last_view_time\":0,\"date_format\":\"\",\"uri\":\"post\\/{$id}\",\"other_uri\":\"\",\"template\":\"frontend\\/widgets\\/hot\"}', 'fay/category_post', '重点热点研究', 'index-main-right', '2');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `widgetarea`, `sort`) VALUES ('consolidation', '{\"title\":\"\",\"top\":10006,\"subclassification\":1,\"number\":12,\"show_empty\":1,\"thumbnail\":0,\"order\":\"hand\",\"last_view_time\":0,\"date_format\":\"\",\"uri\":\"post\\/{$id}\",\"other_uri\":\"\",\"template\":\"frontend\\/widgets\\/consolidation\"}', 'fay/category_post', '机关党建', 'index-main-left', '255');

-- 基础分类
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `is_nav`) VALUES ('根分类', '__root__', '1', '1');
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `is_nav`) VALUES ('新闻中心', 'News', '10000', '1');
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `is_nav`) VALUES ('教育活动', 'Educations', '10000', '1');
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `is_nav`) VALUES ('科研信息', 'Scientific_Research', '10000', '1');
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `is_nav`) VALUES ('成都改革', 'Revolution_in_Chengdu', '10000', '1');
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `is_nav`) VALUES ('教学研究', 'Education_Research', '10000', '1');
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `is_nav`) VALUES ('机关党建', 'Consolidation_Works', '10000', '1');
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `is_nav`) VALUES ('公告栏', 'Noticeboard', '10000', '0');
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `is_nav`) VALUES ('常用软件下载', 'Download', '10000', '0');
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `is_nav`) VALUES ('重点热点研究', 'hot', '10000', '0');

-- 站点参数
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('system:post_review', '0', '是否启用文章审核功能', '{{$time}}', '{{$time}}', '1');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('system:role_cats', '0', '是否启用角色分类权限控制', '{{$time}}', '{{$time}}', '1');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:sitename', '党校内网', '', '{{$time}}', '{{$time}}', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:copyright', '四川·成都 先进网', '', '{{$time}}', '{{$time}}', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:beian', '', '', '{{$time}}', '0', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:phone', '', '', '{{$time}}', '0', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:fax', '610110', '', '{{$time}}', '{{$time}}', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:email', '', '', '{{$time}}', '{{$time}}', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:address', '成都市龙泉驿区大面驿都西路{{$time}}号', '', '{{$time}}', '{{$time}}', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:seo_index_title', '', '', '{{$time}}', '{{$time}}', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:seo_index_keywords', '', '', '{{$time}}', '{{$time}}', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:seo_index_description', '', '', '{{$time}}', '{{$time}}', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:copyright_en', 'Copyright © 2003-2004 cddx.gov.cn all right reserved', '', '{{$time}}', '{{$time}}', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:postcode', '610110', '', '{{$time}}', '{{$time}}', '0');
INSERT INTO `{{$prefix}}options` (`option_name`, `option_value`, `description`, `create_time`, `last_modified_time`, `is_system`) VALUES ('site:oganizer', '中共成都市委党校 成都行政学院 成都市社会主义学院', '', '{{$time}}', '0', '0');
