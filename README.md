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

### 功能测试
```shell
$ php artisan test
```
![结果](https://github.com/nilsir/laravel-graphql-skeleton/raw/master/storage/images/test-result.png)

### 启动服务
```shell
$ php artisan serve
```

### 通过docker-compose启动
```shell
$ cd docker
$ cp .env.dist .env
# 然后修改.env的配置信息(该.env为控制docker的环境变量)

# 切回项目根目录 , 编辑.env修改对应的配置信息
# 修改数据库和redis信息

# 切回docker
$ docker-compose up -d
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
