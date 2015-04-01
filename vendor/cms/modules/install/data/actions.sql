INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1', '列表', 'admin/link/index', '101', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('2', '添加', 'admin/link/create', '101', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('3', '编辑', 'admin/link/edit', '101', '0', '1');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('4', '永久删除', 'admin/link/remove', '101', '0', '1');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('5', '分类列表', 'admin/link/cat', '101', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('6', '添加分类', 'admin/link/cat-create', '101', '0', '5');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('7', '编辑分类', 'admin/link/cat-edit', '101', '0', '5');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('8', '删除分类', 'admin/link/cat-remove', '101', '0', '5');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('301', '添加', 'admin/post/create', '103', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('302', '列表', 'admin/post/index', '103', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('303', '排序', 'admin/post/sort', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('304', '编辑', 'admin/post/edit', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('305', '标签', 'admin/tag/index', '103', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('306', '关键词', 'admin/keyword/index', '103', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('307', '删除', 'admin/post/delete', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('308', '还原', 'admin/post/undelete', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('309', '永久删除', 'admin/post/remove', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('310', '分类列表', 'admin/post/cat', '103', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('311', '添加分类', 'admin/post/cat-create', '103', '0', '310');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('312', '分类属性', 'admin/post-prop/index', '103', '0', '310');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('313', '编辑分类', 'admin/post/cat-edit', '103', '0', '310');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('314', '删除分类', 'admin/post/cat-remove', '103', '0', '310');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('315', '分类排序', 'admin/post/cat-sort', '103', '0', '310');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('316', '审核', 'admin/post/review', '103', '0', '302');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('501', '列表', 'admin/contact/index', '105', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('502', '标记为已读', 'admin/contact/set-read', '105', '0', '501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('503', '标记为未读', 'admin/contact/set-unread', '105', '0', '501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('504', '永久删除', 'admin/contact/remove', '105', '0', '501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('601', '列表', 'admin/operator/index', '106', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('602', '添加', 'admin/operator/create', '106', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('603', '编辑', 'admin/operator/edit', '106', '0', '601');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('604', '查看', 'admin/operator/item', '106', '0', '601');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('605', '设置状态', 'admin/operator/set-status', '106', '0', '604');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('701', '列表', 'admin/page/index', '107', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('702', '添加', 'admin/page/create', '107', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('703', '修改', 'admin/page/edit', '107', '0', '701');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('704', '删除', 'admin/page/delete', '107', '0', '701');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('705', '永久删除', 'admin/page/remove', '107', '0', '701');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('706', '分类列表', 'admin/page/cat', '107', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('707', '添加分类', 'admin/page/cat-create', '107', '0', '706');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('708', '修改分类', 'admin/page/cat-edit', '107', '0', '706');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('709', '删除分类', 'admin/page/cat-remove', '107', '0', '706');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('710', '排序', 'admin/page/sort', '107', '0', '701');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('901', '列表', 'admin/user/index', '109', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('902', '添加', 'admin/user/create', '109', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('903', '查看', 'admin/user/item', '109', '0', '901');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('904', '编辑', 'admin/user/edit', '109', '0', '901');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('905', '设置状态', 'admin/user/set-status', '109', '0', '903');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1001', '列表', 'admin/comment/index', '110', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1002', '批准', 'admin/comment/approve', '110', '0', '1001');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1003', '驳回', 'admin/comment/unapprove', '110', '0', '1001');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1004', '删除', 'admin/comment/delete', '110', '0', '1001');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1005', '永久删除', 'admin/comment/remove', '110', '0', '1001');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1101', '站点参数', 'admin/site/options', '111', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1102', '小工具', 'admin/widget/instances', '111', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1103', '移除小工具', 'admin/widget/remove-instance', '111', '0', '1102');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1104', '编辑小工具', 'admin/widget/edit', '111', '0', '1102');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1201', '列表', 'admin/role/index', '112', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1202', '添加', 'admin/role/create', '112', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1203', '删除', 'admin/role/delete', '112', '0', '1201');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1204', '属性', 'admin/role-prop/index', '112', '0', '1204');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1301', '蜘蛛爬行日志', 'admin/analyst/spiderlog', '113', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1302', '访客统计', 'admin/analyst/visitor', '113', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1303', '访问日志', 'admin/analyst/views', '113', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1304', '页面PV量', 'admin/analyst/pv', '113', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1305', '站点管理', 'admin/analyst-site/index', '113', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1401', '列表', 'admin/menu/index', '114', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1402', '添加', 'admin/menu/create', '114', '0', '1401');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1403', '编辑', 'admin/menu/edit', '114', '0', '1401');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1404', '删除', 'admin/menu/remove', '114', '0', '1401');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1501', '列表', 'admin/chat/index', '115', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1502', '批准', 'admin/chat/approve', '115', '0', '1501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1503', '驳回', 'admin/chat/unapprove', '115', '0', '1501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1504', '删除', 'admin/chat/delete', '115', '0', '1501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1505', '回复', 'admin/chat/reply', '115', '0', '1501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1506', '删除会话', 'admin/chat/remove-all', '115', '0', '1501');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1601', '试题库', 'admin/exam-question/index', '116', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1602', '添加试题', 'admin/exam-question/create', '116', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1603', '编辑试题', 'admin/exam-question/edit', '116', '0', '1601');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1604', '删除试题', 'admin/exam-question/delete', '116', '0', '1601');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1605', '分类列表', 'admin/exam-question/cat', '116', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1606', '添加分类', 'admin/exam-question/cat-create', '116', '0', '1605');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1607', '删除分类', 'admin/exam-question/cat-remove', '116', '0', '1605');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1608', '编辑分类', 'admin/exam-question/cat-edit', '116', '0', '1605');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1701', '列表', 'admin/exam-paper/index', '117', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1702', '组卷', 'admin/exam-paper/create', '117', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1703', '编辑', 'admin/exam-paper/edit', '117', '0', '1701');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1704', '删除', 'admin/exam-paper/delete', '117', '0', '1701');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1705', '阅卷（列表）', 'admin/exam-exam/index', '117', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1706', '阅卷（详细）', 'admin/exam-exam/item', '117', '0', '1705');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1707', '阅卷（评分）', 'admin/exam-exam/set-score', '117', '0', '1706');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1708', '阅卷（永久删除）', 'admin/exam-exam/remove', '117', '0', '1705');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1709', '分类列表', 'admin/exam-paper/cat', '117', '0', '0');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1710', '添加分类', 'admin/exam-paper/cat-create', '117', '0', '1709');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1711', '编辑分类', 'admin/exam-paper/cat-edit', '117', '0', '1709');
INSERT INTO `{{$prefix}}actions` (`id`, `title`, `router`, `cat_id`, `is_public`, `parent`) VALUES ('1712', '删除分类', 'admin/exam-paper/cat-remove', '117', '0', '1709');