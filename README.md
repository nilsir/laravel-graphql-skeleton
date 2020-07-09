## 一个基于laravel7.*的支持graphql并实现了jwt认证的骨架项目

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
