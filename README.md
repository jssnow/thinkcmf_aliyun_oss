# thinkcmf阿里云oss对象存储插件

## 安装阿里云PHP-SDK
推荐使用[Composer](https://getcomposer.org/)方式安装
``` bash
composer require aliyuncs/oss-sdk-php
```
## 使用
一.把aliyun-oss 文件夹克隆或者下载下来之后放在 public/plugins 目录下面.在插件列表中安装一下,然后设置一下阿里云oss相关的参数.  
二.在后台 设置-->文件存储-->存储类型 修改为阿里云对象存储.
## 注意
使用该插件需要把阿里云oss对象存储的Bucket权限设置为公共读.  
如果权限是私有的话需要改写插件中(aliyun_oss/lib/AliyunOss.php)中获取图片链接(getPreviewUrl(),getImageUrl)和获取文件链接(getFileDownloadUrl())的方法