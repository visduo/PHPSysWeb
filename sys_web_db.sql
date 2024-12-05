SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sys_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_admin_user`;
CREATE TABLE `sys_admin_user` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '管理用户id',
  `account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '用户账号',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '用户密码',
  `salts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '用户盐值',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '邮箱地址',
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '手机号码',
  `qqnumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'QQ号码',
  `status` int DEFAULT NULL COMMENT '用户状态，1正常/0禁用',
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '用户备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='系统管理用户表';

-- ----------------------------
-- Records of sys_admin_user
-- ----------------------------
BEGIN;
INSERT INTO `sys_admin_user` (`id`, `account`, `password`, `salts`, `email`, `telephone`, `qqnumber`, `status`, `remarks`) VALUES (1, 'duozai', '6f95931ebf472c0fe43f769b4773e132', 'ZClW9Y', 'vis@duozai.cn', '13275077792', '123456', 1, '超级管理员');
COMMIT;

-- ----------------------------
-- Table structure for sys_admin_user_log
-- ----------------------------
DROP TABLE IF EXISTS `sys_admin_user_log`;
CREATE TABLE `sys_admin_user_log` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '日志id',
  `user_id` int DEFAULT NULL COMMENT '关联管理用户id',
  `client_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '客户端IP',
  `client_ua` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '客户端UA',
  `create_time` bigint DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='系统管理用户登录日志表';

-- ----------------------------
-- Records of sys_admin_user_log
-- ----------------------------
BEGIN;
INSERT INTO `sys_admin_user_log` (`id`, `user_id`, `client_ip`, `client_ua`, `create_time`) VALUES (2, 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1733231444);
INSERT INTO `sys_admin_user_log` (`id`, `user_id`, `client_ip`, `client_ua`, `create_time`) VALUES (3, 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1733232317);
INSERT INTO `sys_admin_user_log` (`id`, `user_id`, `client_ip`, `client_ua`, `create_time`) VALUES (4, 1, '127.0.0.2', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1733233064);
INSERT INTO `sys_admin_user_log` (`id`, `user_id`, `client_ip`, `client_ua`, `create_time`) VALUES (5, 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1733236661);
INSERT INTO `sys_admin_user_log` (`id`, `user_id`, `client_ip`, `client_ua`, `create_time`) VALUES (6, 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1733272223);
INSERT INTO `sys_admin_user_log` (`id`, `user_id`, `client_ip`, `client_ua`, `create_time`) VALUES (7, 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1733273142);
INSERT INTO `sys_admin_user_log` (`id`, `user_id`, `client_ip`, `client_ua`, `create_time`) VALUES (8, 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1733274027);
INSERT INTO `sys_admin_user_log` (`id`, `user_id`, `client_ip`, `client_ua`, `create_time`) VALUES (9, 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1733274730);
INSERT INTO `sys_admin_user_log` (`id`, `user_id`, `client_ip`, `client_ua`, `create_time`) VALUES (10, 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1733274883);
COMMIT;

-- ----------------------------
-- Table structure for sys_alipay_conf
-- ----------------------------
DROP TABLE IF EXISTS `sys_alipay_conf`;
CREATE TABLE `sys_alipay_conf` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '配置id',
  `account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '支付宝账号',
  `appid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '签约appid',
  `private_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '商户私钥',
  `public_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '支付宝公钥',
  `status` int DEFAULT NULL COMMENT '接口状态，1启用/0禁用',
  `max_money` decimal(10,2) DEFAULT NULL COMMENT '最大支付金额',
  `min_money` decimal(10,2) DEFAULT NULL COMMENT '最小支付金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='支付宝支付接口配置表';

-- ----------------------------
-- Records of sys_alipay_conf
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sys_email_sms_conf
-- ----------------------------
DROP TABLE IF EXISTS `sys_email_sms_conf`;
CREATE TABLE `sys_email_sms_conf` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '配置id',
  `smtp_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'SMTP地址',
  `smtp_port` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'SMTP端口号',
  `smtp_account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'SMTP发信账号',
  `smtp_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'SMTP发信密码',
  `status` int DEFAULT NULL COMMENT '接口状态，1启用/0禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='邮箱发信接口配置表';

-- ----------------------------
-- Records of sys_email_sms_conf
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sys_email_sms_log
-- ----------------------------
DROP TABLE IF EXISTS `sys_email_sms_log`;
CREATE TABLE `sys_email_sms_log` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '配置id',
  `receiver` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '接收对象',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '发送内容',
  `result` int DEFAULT NULL COMMENT '发送结果，1成功/0失败',
  `result_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '发送结果备注',
  `client_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '客户端IP',
  `client_ua` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '客户端UA',
  `create_time` int DEFAULT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='邮箱发信日志表';

-- ----------------------------
-- Records of sys_email_sms_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sys_mch_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_mch_user`;
CREATE TABLE `sys_mch_user` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '平台用户id',
  `account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '用户账号',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '用户密码',
  `salts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '用户盐值',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '邮箱地址',
  `email_verify` int DEFAULT NULL COMMENT '邮箱地址是否已验证，1已验证/0未验证',
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '手机号码',
  `telephone_verify` int DEFAULT NULL COMMENT '手机号码是否已验证，1已验证/0未验证',
  `qqnumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'QQ号码',
  `status` int DEFAULT NULL COMMENT '用户状态，1启用/0禁用',
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '用户备注',
  `balance` decimal(10,2) DEFAULT NULL COMMENT '用户余额',
  `create_time` int DEFAULT NULL COMMENT '用户注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='平台用户表';

-- ----------------------------
-- Records of sys_mch_user
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sys_mch_user_log
-- ----------------------------
DROP TABLE IF EXISTS `sys_mch_user_log`;
CREATE TABLE `sys_mch_user_log` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '日志id',
  `user_id` int DEFAULT NULL COMMENT '关联平台用户id',
  `client_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '客户端IP',
  `client_ua` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '客户端UA',
  `create_time` bigint DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='平台用户登录日志表';

-- ----------------------------
-- Records of sys_mch_user_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sys_order
-- ----------------------------
DROP TABLE IF EXISTS `sys_order`;
CREATE TABLE `sys_order` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '订单数据id',
  `trade_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '订单交易号',
  `mch_id` int DEFAULT NULL COMMENT '关联平台用户id',
  `amount` decimal(10,2) DEFAULT NULL COMMENT '订单金额',
  `status` int DEFAULT NULL COMMENT '订单状态，0未支付/1已支付/2已失效',
  `pay_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '支付方式，alipay/wechat',
  `create_time` bigint DEFAULT NULL COMMENT '订单创建时间',
  `plan_time` int DEFAULT NULL COMMENT '订单处理时间',
  `submit_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '客户端IP',
  `submit_ua` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '客户端UA',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='交易订单表';

-- ----------------------------
-- Records of sys_order
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sys_tencent_sms_conf
-- ----------------------------
DROP TABLE IF EXISTS `sys_tencent_sms_conf`;
CREATE TABLE `sys_tencent_sms_conf` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '配置id',
  `sdk_appid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'SdkAppId',
  `sdk_appkey` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'SdkAppKey',
  `signature` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '签名',
  `secret_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'SecretId',
  `secret_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'SecretKey',
  `status` int DEFAULT NULL COMMENT '接口状态，1启用/0禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='腾讯云短信接口配置表';

-- ----------------------------
-- Records of sys_tencent_sms_conf
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for sys_tencent_sms_log
-- ----------------------------
DROP TABLE IF EXISTS `sys_tencent_sms_log`;
CREATE TABLE `sys_tencent_sms_log` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '配置id',
  `receiver` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '接收对象',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '发送内容',
  `result` int DEFAULT NULL COMMENT '发送结果，1成功/0失败',
  `result_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '发送结果备注',
  `client_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '客户端IP',
  `client_ua` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '客户端UA',
  `create_time` int DEFAULT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='腾讯云短信发信日志表';

-- ----------------------------
-- Records of sys_tencent_sms_log
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
