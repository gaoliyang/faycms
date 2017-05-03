INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('101', '列表', 'cms/admin/link/index', '101', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('102', '添加', 'cms/admin/link/create', '101', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('103', '编辑', 'cms/admin/link/edit', '101', '0', '101');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('104', '永久删除', 'cms/admin/link/remove', '101', '0', '101');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('105', '分类列表', 'cms/admin/link/cat', '101', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('106', '添加分类', 'cms/admin/link/cat-create', '101', '0', '105');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('107', '编辑分类', 'cms/admin/link/cat-edit', '101', '0', '105');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('108', '删除分类', 'cms/admin/link/cat-remove', '101', '0', '105');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('201', '文件管理', 'cms/admin/file/index', '102', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('202', '上传文件', 'cms/admin/file/do-upload', '102', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('203', '文件分类', 'cms/admin/file/cat', '102', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('204', '添加分类', 'cms/admin/file/cat-create', '102', '0', '203');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('205', '编辑分类', 'cms/admin/file/cat-edit', '102', '0', '203');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('206', '删除分类', 'cms/admin/file/cat-remove', '102', '0', '203');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('207', '分类排序', 'cms/admin/file/cat-sort', '102', '0', '203');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('208', '上传到七牛', 'cms/admin/qiniu/put', '102', '0', '201');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('209', '从七牛移除', 'cms/admin/qiniu/delete', '102', '0', '201');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('210', '删除', 'cms/admin/file/remove', '102', '0', '201');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('301', '添加', 'cms/admin/post/create', '103', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('302', '列表', 'cms/admin/post/index', '103', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('303', '排序', 'cms/admin/post/sort', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('304', '编辑', 'cms/admin/post/edit', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('305', '标签', 'cms/admin/tag/index', '103', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('306', '关键词', 'cms/admin/keyword/index', '103', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('307', '删除', 'cms/admin/post/delete', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('308', '还原', 'cms/admin/post/undelete', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('309', '永久删除', 'cms/admin/post/remove', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('310', '分类列表', 'cms/admin/post/cat', '103', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('311', '添加分类', 'cms/admin/post/cat-create', '103', '0', '310');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('312', '分类属性', 'cms/admin/post-prop/index', '103', '0', '310');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('313', '编辑分类', 'cms/admin/post/cat-edit', '103', '0', '310');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('314', '删除分类', 'cms/admin/post/cat-remove', '103', '0', '310');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('315', '分类排序', 'cms/admin/post/cat-sort', '103', '0', '310');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('316', '审核', 'cms/admin/post/review', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('317', '发布', 'cms/admin/post/publish', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('501', '列表', 'cms/admin/contact/index', '105', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('502', '标记为已读', 'cms/admin/contact/set-read', '105', '0', '501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('503', '标记为未读', 'cms/admin/contact/set-unread', '105', '0', '501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('504', '永久删除', 'cms/admin/contact/remove', '105', '0', '501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('505', '回复', 'cms/admin/contact/reply', '105', '0', '501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('601', '列表', 'cms/admin/operator/index', '106', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('602', '添加', 'cms/admin/operator/create', '106', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('603', '编辑', 'cms/admin/operator/edit', '106', '0', '601');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('604', '查看', 'cms/admin/operator/item', '106', '0', '601');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('701', '列表', 'cms/admin/page/index', '107', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('702', '添加', 'cms/admin/page/create', '107', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('703', '修改', 'cms/admin/page/edit', '107', '0', '701');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('704', '删除', 'cms/admin/page/delete', '107', '0', '701');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('705', '永久删除', 'cms/admin/page/remove', '107', '0', '701');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('706', '分类列表', 'cms/admin/page/cat', '107', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('707', '添加分类', 'cms/admin/page/cat-create', '107', '0', '706');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('708', '修改分类', 'cms/admin/page/cat-edit', '107', '0', '706');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('709', '删除分类', 'cms/admin/page/cat-remove', '107', '0', '706');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('710', '排序', 'cms/admin/page/sort', '107', '0', '701');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('901', '列表', 'cms/admin/user/index', '109', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('902', '添加', 'cms/admin/user/create', '109', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('903', '查看', 'cms/admin/user/item', '109', '0', '901');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('904', '编辑', 'cms/admin/user/edit', '109', '0', '901');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1001', '列表', 'cms/admin/post-comment/index', '110', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1002', '批准', 'cms/admin/comment/approve', '110', '0', '1001');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1003', '驳回', 'cms/admin/comment/unapprove', '110', '0', '1001');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1004', '删除', 'cms/admin/comment/delete', '110', '0', '1001');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1005', '永久删除', 'cms/admin/comment/remove', '110', '0', '1001');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1101', '站点设置', 'cms/admin/site/settings', '111', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1102', '小工具', 'cms/admin/widget/instances', '111', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1103', '移除小工具', 'cms/admin/widget/remove-instance', '111', '0', '1102');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1104', '编辑小工具', 'cms/admin/widget/edit', '111', '0', '1102');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1105', '小工具域', 'cms/admin/widgetarea/index', '111', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1106', '复制小工具', 'cms/admin/widget/copy', '111', '0', '1102');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1107', '第三方登录', 'cms/admin/site/oauth', '111', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1201', '列表', 'cms/admin/role/index', '112', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1202', '添加', 'cms/admin/role/create', '112', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1203', '删除', 'cms/admin/role/delete', '112', '0', '1201');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1204', '属性', 'cms/admin/role-prop/index', '112', '0', '1204');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1301', '蜘蛛爬行日志', 'cms/admin/analyst/spiderlog', '113', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1302', '访客统计', 'cms/admin/analyst/visitor', '113', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1303', '访问日志', 'cms/admin/analyst/views', '113', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1304', '页面PV量', 'cms/admin/analyst/pv', '113', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1305', '站点管理', 'cms/admin/analyst-site/index', '113', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1401', '自定义导航', 'cms/admin/menu/index', '114', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1402', '添加', 'cms/admin/menu/create', '114', '0', '1401');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1403', '编辑', 'cms/admin/menu/edit', '114', '0', '1401');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1404', '删除', 'cms/admin/menu/remove', '114', '0', '1401');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1501', '列表', 'cms/admin/chat/index', '115', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1502', '批准', 'cms/admin/chat/approve', '115', '0', '1501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1503', '驳回', 'cms/admin/chat/unapprove', '115', '0', '1501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1504', '删除', 'cms/admin/chat/delete', '115', '0', '1501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1505', '回复', 'cms/admin/chat/reply', '115', '0', '1501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1506', '删除会话', 'cms/admin/chat/remove-all', '115', '0', '1501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1601', '模版列表', 'cms/admin/template/index', '118', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1602', '添加模版', 'cms/admin/template/create', '118', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1603', '添加模版', 'cms/admin/template/edit', '118', '0', '1801');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1604', '删除模版', 'cms/admin/template/delete', '118', '0', '1801');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9801', '重置分类表索引', 'cms/admin/reset/category', '198', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9802', '重置菜单表索引', 'cms/admin/reset/menu', '198', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9803', '重置分类文章数', 'cms/admin/reset/category-post-count', '198', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9804', '重置标签文章数', 'cms/admin/reset/tag-post-count', '198', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9805', '重置用户文章数', 'cms/admin/reset/user-post-count', '198', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9901', '汇总分类管理', 'cms/admin/category/index', '199', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9902', '系统参数列表', 'cms/admin/option/index', '199', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9903', '系统日志', 'cms/admin/log/index', '199', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9904', '所有小工具', 'cms/admin/widget/index', '199', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9905', '权限分类', 'cms/admin/action/cat', '199', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9906', '所有权限', 'cms/admin/action/index', '199', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9907', '添加权限', 'cms/admin/action/create', '199', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9908', '编辑权限', 'cms/admin/action/edit', '199', '0', '9906');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9909', '删除权限', 'cms/admin/action/remove', '199', '0', '9906');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9910', '系统消息分类', 'cms/admin/notification/cat', '199', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9911', '发送系统消息', 'cms/admin/notification/create', '199', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('9914', '后台菜单', 'cms/admin/menu/admin', '199', '0', '0');