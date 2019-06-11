# 开发文档
## 后台
后台用户的是PHP的`Laravel5.8`框架，直接开发可以参考Laravel的文档。这里就做一些约定。约定Controller通过调用Service完成绝大多数的业务逻辑，不直接通过`New Model()`来查询数据库。
## 前台
Js遵守ES6的语法，Css遵守Sass的语法特性进行编写。最后都通过`webpack.mix.js`进行编译。
## 首页爬虫
首页汇率数据爬虫是通过python的`scrapy`框架去爬。通过linux的crontab每天执行。爬虫环境搭建可以通过`docker`去部署。主要用到的3个镜像是mysql、python3、scrapinghub/splash。