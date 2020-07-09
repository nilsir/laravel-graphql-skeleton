## 一个基于laravel7.*, 支持graphql, 并实现了jwt认证的骨架项目

### 安装
```shell
$ git clone https://github.com/nilsir/laravel-graphql-skeleton.git
$ cd laravel-graphql-skeleton
# 开发环境
$ composer install -o -vvv
# 生产环境
$ composer install --no-dev -o -vvv
$ cp .env.example .env
# 生成key
$ php artisan key:generate
# 修改数据库连接信息
...
# 生成jwt-secret
$ php artisan jwt:secret
# 生成表
$ php artisan migrate
# 运行seeder
$ php artisan db:seed
```

### 生成助手文件
```shell
$ php artisan ide-helper:meta
$ php artisan lighthouse:ide-helper
```

### 启动服务
```shell
$ php artisan serve
```

### 访问graphql-playground
[点击](http://127.0.0.1:8000/graphql-playground)

### 格式化代码
1. 安装php-cs-fixer
```shell
$ composer global require friendsofphp/php-cs-fixer
```
2. 使用.php_cs文件来格式化
```shell
$ php-cs-fixer fix --config-file .php_cs  /path/to/project/file
```
3. phpstorm配置
```text
点击: Preference->Tools->External Tools   
点击 "+" 新增一个配置

Name: php-cs-fixer
Description: php coding style fixer
Tool Settins:
    Program: /Your/.composer/vendor/php/bin/php-cs-fixer
    Arguments: fix "$FileDir$/$FileName$"
    Working Directory: $ProjectFileDir$
```
4. 配置快捷键
```text
点击: Preference->Keymap->External Tools->External Tools
右键点击: php-cs-fixer, 选择Add Key Board Shortcut, 添加顺手的快捷键
```
