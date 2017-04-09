INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1', '0', '_admin_menu', '后台菜单集', '', '');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('2', '0', '_user_menu', '用户自定义菜单集', '', '');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('100', '1', '_admin_main', '后台主菜单', '', '');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('110', '100', 'role', '权限', 'fa fa-gavel', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('111', '110', '', '角色列表', '', 'cms/admin/role/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('112', '110', '', '添加角色', '', 'cms/admin/role/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('113', '110', '', '所有权限', '', 'cms/admin/action/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('114', '110', '', '权限分类', '', 'cms/admin/action/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('120', '100', 'user', '用户管理', 'fa fa-users', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('121', '120', '', '所有用户', '', 'cms/admin/user/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('122', '120', '', '添加用户', '', 'cms/admin/user/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('123', '120', '', '所有管理员', '', 'cms/admin/operator/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('124', '120', '', '添加管理员', '', 'cms/admin/operator/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('130', '100', 'post', '文章', 'fa fa-edit', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('131', '130', '', '所有文章', '', 'cms/admin/post/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('132', '130', '', '撰写文章', '', 'cms/admin/post/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('133', '130', '', '文章分类', '', 'cms/admin/post/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('134', '130', '', '标签', '', 'cms/admin/tag/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('135', '130', '', '关键词', '', 'cms/admin/keyword/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('140', '100', 'page', '页面', 'fa fa-bookmark', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('141', '140', '', '所有页面', '', 'cms/admin/page/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('142', '140', '', '添加页面', '', 'cms/admin/page/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('143', '140', '', '页面分类', '', 'cms/admin/page/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('150', '100', 'message', '留言', 'fa fa-comments-o', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('151', '150', '', '文章评论', '', 'cms/admin/post-comment/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('152', '150', '', '联系我们', '', 'cms/admin/contact/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('153', '150', '', '会话', '', 'cms/admin/chat/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('160', '100', 'menu', '导航栏', 'fa fa-map-marker', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('161', '160', '', '自定义导航', '', 'cms/admin/menu/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('162', '160', '', '后台菜单', '', 'cms/admin/menu/admin');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('170', '100', 'link', '友情链接', 'fa fa-unlink', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('171', '170', '', '所有友链', '', 'cms/admin/link/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('172', '170', '', '添加友链', '', 'cms/admin/link/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('173', '170', '', '链接分类', '', 'cms/admin/link/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('180', '100', 'cat', '所有分类', 'fa fa-sitemap', 'cms/admin/category/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('190', '100', 'site', '站点', 'fa fa-cog', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('191', '190', '', '站点设置', '', 'cms/admin/site/settings');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('192', '190', '', '参数列表', '', 'cms/admin/option/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('193', '190', '', '系统日志', '', 'cms/admin/log/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('194', '190', '', '小工具域', '', 'cms/admin/widgetarea/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('195', '190', '', '所有小工具', '', 'cms/admin/widget/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('200', '100', 'analyst', '访问统计', 'fa fa-bar-chart-o', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('201', '200', '', '访客统计', '', 'cms/admin/analyst/visitor');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('202', '200', '', '访问日志', '', 'cms/admin/analyst/views');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('203', '200', '', '页面PV量', '', 'cms/admin/analyst/pv');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('204', '200', '', '站点管理', '', 'cms/admin/analyst-site/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('205', '200', '', '蜘蛛爬行记录', '', 'cms/admin/analyst/spiderlog');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('210', '100', 'file', '文件', 'fa fa-files-o', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('211', '210', '', '所有文件', '', 'cms/admin/file/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('212', '210', '', '上传文件', '', 'cms/admin/file/do-upload');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('213', '210', '', '文件分类', '', 'cms/admin/file/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('220', '100', 'notification', '系统消息', 'fa fa-comment', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('222', '220', '', '发送消息', '', 'cms/admin/notification/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('223', '220', '', '消息分类', '', 'cms/admin/notification/cat');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('230', '100', 'template', '模版', 'fa fa-envelope-o', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('231', '230', '', '添加模版', '', 'cms/admin/template/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('232', '230', '', '模版列表', '', 'cms/admin/template/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('260', '100', 'feed', '动态', 'fa fa-rss', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('261', '260', '', '所有动态', '', 'cms/admin/feed/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('262', '260', '', '发布动态', '', 'cms/admin/feed/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('270', '100', 'third-party', '第三方配置', 'fa fa-cloud', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('272', '270', '', '第三方登录', '', 'cms/admin/site/oauth');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('900', '100', 'reset', '系统修复', 'fa fa-refresh', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('901', '900', '', '分类表索引', '', 'cms/admin/reset/category');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('902', '900', '', '菜单表索引', '', 'cms/admin/reset/menu');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('903', '900', 'post-count', '文章数统计', '', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('904', '903', '', '分类文章数', '', 'cms/admin/reset/category-post-count');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('905', '903', '', '标签文章数', '', 'cms/admin/reset/tag-post-count');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('906', '903', '', '用户文章数', '', 'cms/admin/reset/user-post-count');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1000', '1', '_tools_main', 'Tools', '', '');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1010', '1000', 'input', 'Input', 'fa fa-download', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1011', '1010', '', 'SESSION', '', 'cms/tools/input/session');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1012', '1010', '', 'COOKIE', '', 'cms/tools/input/cookie');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1013', '1010', '', 'SERVER', '', 'cms/tools/input/server');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1014', '1010', '', 'GET', '', 'cms/tools/input/get');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1015', '1010', '', 'POST', '', 'cms/tools/input/post');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1020', '1000', 'css', 'CSS', 'fa fa-css3', 'cms/tools/css/compress');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1030', '1000', 'database', 'Database', 'fa fa-database', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1031', '1030', '', 'Model', '', 'cms/tools/database/model');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1032', '1030', '', 'dd', '', 'cms/tools/database/dd');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1033', '1030', '', 'DDL', '', 'cms/tools/database/ddl');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1034', '1030', '', 'Export', '', 'cms/tools/database/export');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1035', '1030', '', 'Compare', '', 'cms/tools/db-compare/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1036', '1030', '', 'Sql', '', 'cms/tools/database/sql');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1040', '1000', 'function', 'Function', 'fa fa-code', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1041', '1040', '', 'eval', '', 'cms/tools/function/eval');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1042', '1040', '', 'date', '', 'cms/tools/function/date');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1043', '1040', '', 'unserialize', '', 'cms/tools/function/unserialize');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1044', '1040', '', 'json', '', 'cms/tools/function/json');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1045', '1040', '', 'url', '', 'cms/tools/function/url');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1046', '1040', '', 'string', '', 'cms/tools/function/string');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1047', '1040', '', 'ip', '', 'cms/tools/function/ip');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1050', '1000', 'memcache', 'Memcache', 'fa fa-inbox', 'cms/tools/memcache/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1060', '1000', 'application', 'Application', 'fa fa-codepen', 'javascript:');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1061', '1060', '', 'List', '', 'cms/tools/application/index');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1062', '1060', '', 'Create', '', 'cms/tools/application/create');
INSERT INTO `{{$prefix}}menus` (`id`, `parent`, `alias`, `title`, `css_class`, `link`) VALUES ('1070', '1000', 'qrcode', 'Qrcode', 'fa fa-qrcode', 'cms/tools/qrcode/index');