/*
Navicat MySQL Data Transfer

Source Server         : XAMPP
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : tasks

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-10-25 10:52:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for developments
-- ----------------------------
DROP TABLE IF EXISTS `developments`;
CREATE TABLE `developments` (
  `id_development` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `path` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_development`),
  KEY `developments_task` (`task_id`),
  CONSTRAINT `developments_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id_task`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of developments
-- ----------------------------

-- ----------------------------
-- Table structure for enterprises
-- ----------------------------
DROP TABLE IF EXISTS `enterprises`;
CREATE TABLE `enterprises` (
  `id_enterprise` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_enterprise`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of enterprises
-- ----------------------------
INSERT INTO `enterprises` VALUES ('2', 'CINEMEX', 'universidadcinemex.com', 'cinemex_logo.jpg');

-- ----------------------------
-- Table structure for evidence
-- ----------------------------
DROP TABLE IF EXISTS `evidence`;
CREATE TABLE `evidence` (
  `id_evidence` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_evidence`),
  KEY `evidence_task` (`task_id`),
  CONSTRAINT `evidence_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id_task`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of evidence
-- ----------------------------
INSERT INTO `evidence` VALUES ('1', 'task_1_pic_4.jpg', '1', '2017-10-24 13:39:29');
INSERT INTO `evidence` VALUES ('2', 'task_1_pic_7.jpg', '1', '2017-10-24 13:51:23');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `to` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` longtext NOT NULL,
  `date_send` datetime DEFAULT NULL,
  `date_view` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_message`),
  KEY `to_user` (`to`),
  KEY `from_user` (`from`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from`) REFERENCES `users` (`id_user`),
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `id_item` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date_send` datetime DEFAULT NULL,
  `date_view` datetime DEFAULT NULL,
  `last_modify` datetime DEFAULT NULL,
  `total_send` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_notification`),
  KEY `user_notification` (`user_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('1', '4', 'project', '1', '0', '2017-10-19 14:49:20', null, null, '1');
INSERT INTO `notifications` VALUES ('2', '3', 'task', '1', '1', '2017-10-24 13:23:57', '2017-10-24 14:10:00', '2017-10-24 14:06:04', '2');

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id_permission` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_permission`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for profiles
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of profiles
-- ----------------------------
INSERT INTO `profiles` VALUES ('1', 'Administrator', 'fa fa-user');
INSERT INTO `profiles` VALUES ('2', 'Project Manager', null);
INSERT INTO `profiles` VALUES ('3', 'Developer', null);
INSERT INTO `profiles` VALUES ('4', 'Platform Manager', null);
INSERT INTO `profiles` VALUES ('5', 'User', null);

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id_project` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `enterprise_id` int(11) DEFAULT NULL,
  `description` text,
  `ranges` text,
  `limits` text,
  `specifications` text,
  `date_created` datetime DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  PRIMARY KEY (`id_project`),
  KEY `project_ent` (`enterprise_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id_enterprise`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES ('1', 'Prueba de Projectó', '2', '																																<p style=\"text-align: justify; \"><span style=\"background-color: rgb(255, 255, 0);\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</span></p>\r\n\r\n<p style=\"text-align: justify;\">Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>\r\n\r\n<p style=\"text-align: justify;\">Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>\r\n\r\n<p style=\"text-align: justify; \">Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>\r\n\r\n<p style=\"text-align: justify; \"><span style=\"background-color: rgb(8, 82, 148); color: rgb(247, 247, 247);\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span></p>																												', '																																<p style=\"text-align: center; \"><span style=\"font-weight: bold;\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</span></p>\r\n\r\n<p style=\"text-align: center; \"><span style=\"font-family: \" comic=\"\" sans=\"\" ms\";\"=\"\">Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</span></p>\r\n\r\n<p style=\"text-align: center; \"><span style=\"text-decoration-line: underline;\">Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</span></p>\r\n\r\n<ul>\r\n<li style=\"text-align: center;\">Phasellus viverra nulla ut metus varius laoreet.</li>\r\n<li style=\"text-align: center;\"> Quisque rutrum.</li>\r\n<li style=\"text-align: center;\"> Aenean imperdiet.</li>\r\n<li style=\"text-align: center;\">Etiam ultricies nisi vel augue.</li>\r\n</ul>\r\n<div style=\"text-align: center;\"><br></div>\r\n<ol>\r\n<li style=\"text-align: center;\">Curabitur ullamcorper ultricies nisi. </li>\r\n<li style=\"text-align: center;\">Nam eget dui. </li>\r\n<li style=\"text-align: center;\">Etiam rhoncus.</li>\r\n</ol>\r\n\r\n<p style=\"text-align: center;\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>																					', null, '								<p style=\"text-align: right; \">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p style=\"text-align: right; \"><span style=\"background-color: rgb(255, 255, 0);\">Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</span></p><p style=\"text-align: right;\">Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p><p style=\"text-align: right;\"><span style=\"background-color: rgb(206, 0, 0);\">Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</span></p><p style=\"text-align: right;\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n<p style=\"text-align: right;\">Y, viéndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: Sábete, Sancho, que no es un hombre más que otro si no hace más que otro.</p>\r\n\r\n<p style=\"text-align: right;\">Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquí se sigue que, habiendo durado mucho el mal, el bien está ya cerca.</p>\r\n\r\n<p style=\"text-align: right;\">Así que, no debes congojarte por las desgracias que a mí me suceden, pues a ti no te cabe parte dellas.</p>\r\n\r\n<p style=\"text-align: right;\"><span style=\"background-color: rgb(0, 255, 0);\">Y, viéndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: Sábete, Sancho, que no es un hombre más que otro si no hace más que otro.</span></p>\r\n\r\n<p style=\"text-align: right;\">Todas estas borrascas que nos suceden son señales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquí se sigue que, habiendo durado mucho el mal, el bien está ya cerca.</p>\r\n\r\n<p style=\"text-align: right;\">Así que, no debes congojarte por las desgracias que a mí me suceden, pues a ti no</p>							', '2017-10-19 14:49:20', '2017-10-19', '2017-10-31');

-- ----------------------------
-- Table structure for rel_enterprise_user
-- ----------------------------
DROP TABLE IF EXISTS `rel_enterprise_user`;
CREATE TABLE `rel_enterprise_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enterprise_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rel_enter_user` (`user_id`),
  KEY `rel_enter_enter` (`enterprise_id`),
  KEY `rel_enter_role` (`role_id`),
  CONSTRAINT `rel_enterprise_user_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id_enterprise`),
  CONSTRAINT `rel_enterprise_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id_role`),
  CONSTRAINT `rel_enterprise_user_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_enterprise_user
-- ----------------------------

-- ----------------------------
-- Table structure for rel_project_user
-- ----------------------------
DROP TABLE IF EXISTS `rel_project_user`;
CREATE TABLE `rel_project_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rel_pro_user` (`user_id`),
  KEY `rel_project` (`project_id`),
  CONSTRAINT `rel_project_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  CONSTRAINT `rel_project_user_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id_project`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_project_user
-- ----------------------------
INSERT INTO `rel_project_user` VALUES ('1', '4', '1');

-- ----------------------------
-- Table structure for rel_roles_permissions
-- ----------------------------
DROP TABLE IF EXISTS `rel_roles_permissions`;
CREATE TABLE `rel_roles_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rel_role_perm` (`role_id`),
  KEY `rel_permission` (`permission_id`),
  CONSTRAINT `rel_roles_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id_permission`),
  CONSTRAINT `rel_roles_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_roles_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for rel_tasks_project
-- ----------------------------
DROP TABLE IF EXISTS `rel_tasks_project`;
CREATE TABLE `rel_tasks_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rel_task_project` (`task_id`),
  KEY `rel_project_task` (`project_id`),
  CONSTRAINT `rel_tasks_project_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id_project`),
  CONSTRAINT `rel_tasks_project_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id_task`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_tasks_project
-- ----------------------------
INSERT INTO `rel_tasks_project` VALUES ('1', '1', '1');

-- ----------------------------
-- Table structure for rel_tasks_users
-- ----------------------------
DROP TABLE IF EXISTS `rel_tasks_users`;
CREATE TABLE `rel_tasks_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rel_task_user` (`task_id`),
  KEY `rel_user_task` (`user_id`),
  CONSTRAINT `rel_tasks_users_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id_task`),
  CONSTRAINT `rel_tasks_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rel_tasks_users
-- ----------------------------
INSERT INTO `rel_tasks_users` VALUES ('1', '1', '3');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of roles
-- ----------------------------

-- ----------------------------
-- Table structure for status_task
-- ----------------------------
DROP TABLE IF EXISTS `status_task`;
CREATE TABLE `status_task` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status_task
-- ----------------------------
INSERT INTO `status_task` VALUES ('1', 'PENDIENTE');
INSERT INTO `status_task` VALUES ('2', 'LEIDO');
INSERT INTO `status_task` VALUES ('3', 'EN PROCESO');
INSERT INTO `status_task` VALUES ('4', 'ENTREGADO');
INSERT INTO `status_task` VALUES ('5', 'NO ENTREGADO');
INSERT INTO `status_task` VALUES ('6', 'CANCELADO');

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id_task` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `date_view` datetime DEFAULT NULL,
  `date_process` datetime DEFAULT NULL,
  `date_delivered` datetime DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `enterpriser_id` int(11) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_task`),
  KEY `tasks_enterprise` (`enterpriser_id`),
  KEY `tastk_status` (`status_id`),
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`enterpriser_id`) REFERENCES `enterprises` (`id_enterprise`),
  CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status_task` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` VALUES ('1', 'Prueba', '																																													asdasdasd																																								', '2017-10-23 00:00:00', '2017-10-26 00:00:00', '2017-10-24 13:54:22', '2017-10-24 13:54:47', '2017-10-24 13:51:23', '1', '2', '#00a7dd');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `profile_user` (`profile_id`),
  KEY `color` (`color`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Administrador', 'General', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'david-tirado@cencade.com.mx', '1', null, '#05770a');
INSERT INTO `users` VALUES ('3', 'David ', 'Tirado', 'dtirado', '22c78a8fc201e858d28af3ffff76c1b6', 'david-tirado@cencade.com.mx', '3', '663097156.png', '#00a7dd');
INSERT INTO `users` VALUES ('4', 'Rafael', 'Ramírez Arrieta', 'rramirez', 'dece5561c1ed8a4ad1992c0d742447b4', 'rafael-ramirez@cencade.com.mx', '2', 'piraton.jpg', '#e00202');
