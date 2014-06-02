BugTracker
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

###已知Bugs
1. 使用/bug/8abc能解析到/bug/8
2. auth的问题
3. bug的图片显示不出
4. 列出comment和reply时如果bug或post删除就无法列出
