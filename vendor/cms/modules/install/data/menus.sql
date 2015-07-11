INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1', '0', '_admin_menu', '后台菜单集', '', '');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('2', '0', '_user_menu', '用户自定义菜单集', '', '');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('100', '1', '_admin_main', '后台主菜单', '', '');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('110', '100', 'role', '权限', 'fa fa-gavel', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('111', '110', '', '角色列表', '', 'admin/role/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('112', '110', '', '添加角色', '', 'admin/role/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('113', '110', '', '所有权限', '', 'admin/action/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('114', '110', '', '权限分类', '', 'admin/action/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('120', '100', 'user', '用户管理', 'fa fa-users', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('121', '120', '', '所有用户', '', 'admin/user/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('122', '120', '', '添加用户', '', 'admin/user/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('123', '120', '', '所有管理员', '', 'admin/operator/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('124', '120', '', '添加管理员', '', 'admin/operator/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('130', '100', 'post', '文章', 'fa fa-edit', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('131', '130', '', '所有文章', '', 'admin/post/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('132', '130', '', '撰写文章', '', 'admin/post/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('133', '130', '', '文章分类', '', 'admin/post/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('134', '130', '', '标签', '', 'admin/tag/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('135', '130', '', '关键词', '', 'admin/keyword/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('140', '100', 'page', '页面', 'fa fa-bookmark', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('141', '140', '', '所有页面', '', 'admin/page/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('142', '140', '', '添加页面', '', 'admin/page/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('143', '140', '', '页面分类', '', 'admin/page/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('150', '100', 'message', '留言', 'fa fa-comments-o', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('151', '150', '', '文章评论', '', 'admin/comment/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('152', '150', '', '联系我们', '', 'admin/contact/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('153', '150', '', '会话', '', 'admin/chat/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('160', '100', 'menu', '导航栏', 'fa fa-map-marker', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('161', '160', '', '自定义导航', '', 'admin/menu/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('162', '160', '', '后台菜单', '', 'admin/menu/admin');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('170', '100', 'link', '友情链接', 'fa fa-unlink', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('171', '170', '', '所有友链', '', 'admin/link/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('172', '170', '', '添加友链', '', 'admin/link/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('173', '170', '', '链接分类', '', 'admin/link/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('180', '100', 'cat', '所有分类', 'fa fa-sitemap', 'admin/category/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('190', '100', 'site', '站点', 'fa fa-cog', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('191', '190', '', '站点设置', '', 'admin/site/settings');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('192', '190', '', '参数列表', '', 'admin/option/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('193', '190', '', '系统日志', '', 'admin/log/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('194', '190', '', '小工具域', '', 'admin/widgetarea/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('195', '190', '', '所有小工具', '', 'admin/widget/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('200', '100', 'analyst', '访问统计', 'fa fa-bar-chart-o', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('201', '200', '', '访客统计', '', 'admin/analyst/visitor');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('202', '200', '', '访问日志', '', 'admin/analyst/views');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('203', '200', '', '页面PV量', '', 'admin/analyst/pv');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('204', '200', '', '站点管理', '', 'admin/analyst-site/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('205', '200', '', '蜘蛛爬行记录', '', 'admin/analyst/spiderlog');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('210', '100', 'file', '文件', 'fa fa-files-o', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('211', '210', '', '所有文件', '', 'admin/file/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('212', '210', '', '上传文件', '', 'admin/file/do-upload');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('220', '100', 'notification', '系统消息', 'fa fa-comment', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('222', '220', '', '发送消息', '', 'admin/notification/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('223', '220', '', '消息分类', '', 'admin/notification/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('230', '100', 'template', '模版', 'fa fa-envelope-o', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('231', '230', '', '添加模版', '', 'admin/template/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('232', '230', '', '模版列表', '', 'admin/template/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('240', '100', 'exam', '考试系统', 'fa fa-graduation-cap', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('241', '240', 'exam-question', '试题', '', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('242', '241', '', '试题库', '', 'admin/exam-question/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('243', '241', '', '添加试题', '', 'admin/exam-question/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('244', '241', '', '试题分类', '', 'admin/exam-question/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('245', '240', 'exam-paper', '试卷', '', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('246', '245', '', '试卷列表', '', 'admin/exam-paper/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('247', '245', '', '组卷', '', 'admin/exam-paper/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('248', '245', '', '阅卷', '', 'admin/exam-exam/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('249', '245', '', '试卷分类', '', 'admin/exam-paper/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('800', '1', '_tools_main', 'Tools', '', '');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('810', '800', 'input', 'Input', 'fa fa-download', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('811', '810', '', 'SESSION', '', 'tools/input/session');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('812', '810', '', 'COOKIE', '', 'tools/input/cookie');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('813', '810', '', 'SERVER', '', 'tools/input/server');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('814', '810', '', 'GET', '', 'tools/input/get');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('815', '810', '', 'POST', '', 'tools/input/post');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('820', '800', 'css', 'CSS', 'fa fa-css3', 'tools/css/compress');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('830', '800', 'database', 'Database', 'fa fa-database', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('831', '830', '', 'Model', '', 'tools/database/model');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('832', '830', '', 'dd', '', 'tools/database/dd');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('833', '830', '', 'DDL', '', 'tools/database/ddl');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('834', '830', '', 'Export', '', 'tools/database/export');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('835', '830', '', 'Compare', '', 'tools/db-compare/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('836', '830', '', 'Sql', '', 'tools/database/sql');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('840', '800', 'function', 'Function', 'fa fa-code', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('841', '840', '', 'eval', '', 'tools/function/eval');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('842', '840', '', 'date', '', 'tools/function/date');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('843', '840', '', 'unserialize', '', 'tools/function/unserialize');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('844', '840', '', 'json', '', 'tools/function/json');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('845', '840', '', 'urldecode', '', 'tools/function/urldecode');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('846', '840', '', 'string', '', 'tools/function/string');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('847', '840', '', 'ip', '', 'tools/function/ip');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('850', '800', 'memcache', 'Memcache', 'fa fa-inbox', 'tools/memcache/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('860', '800', 'application', 'Application', 'fa fa-codepen', 'javascript:;');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('861', '860', '', 'List', '', 'tools/application/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('862', '860', '', 'Create', '', 'tools/application/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('870', '800', 'qrcode', 'Qrcode', 'fa fa-qrcode', 'tools/qrcode/index');