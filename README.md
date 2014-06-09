BugTracker
======================
###项目介绍
这是一个应急的课程项目，所以代码写的不好请见谅（当然就算不急也写的不好）。  
项目整体是模仿了一些乌云的功能，做了一个很basic的版本。  
框架是基于lamp，后台php框架是laravel 4.1，ui用的flat ui（基于bootstrap）。  
大体功能除了活动（Activity）以外基本完成，页面细节需要添加。Activity还没有做edit和delete。  
安全性、性能、国际化（你可以看见中文的硬编码）等需求不在已完成进度的考虑范围内。  

======================
###项目初始化
####1.安装composer
如果没有composer，安装一下。Composer是php的包管理器。  
Windows: https://getcomposer.org/Composer-Setup.exe  
Other: curl -sS https://getcomposer.org/installer | php
####2.进行包安装
安装: composer install  
更新: composer update

======================
###数据库迁移
使用命令：php artisan migrate.  
更多有关artisan和数据迁移: http://www.golaravel.com/docs/4.1/migrations/

======================
###已知Bugs
1. 使用/bug/8abc能解析到/bug/8(参数未过滤)
2. ~~auth的问题~~
3. ~~bug的图片显示不出~~
4. 列出comment和reply时如果bug或post删除就无法列出
