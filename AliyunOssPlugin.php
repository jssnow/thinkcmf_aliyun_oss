<?php
// +----------------------------------------------------------------------
// | Author: jhj <jhj767658181@gmail.com>
// +----------------------------------------------------------------------
namespace plugins\aliyun_oss;

use cmf\lib\Plugin;

class AliyunOssPlugin extends Plugin
{

    public $info = [
        'name'        => 'AliyunOss',
        'title'       => '阿里云oss',
        'description' => '阿里云oss',
        'status'      => 1,
        'author'      => 'jhj',
        'version'     => '1.0'
    ];

    public $hasAdmin = 0;//插件是否有后台管理界面

    // 插件安装
    public function install()
    {
        $storageOption = cmf_get_option('storage');
        if (empty($storageOption)) {
            $storageOption = [];
        }

        $storageOption['storages']['AliyunOss'] = ['name' => '阿里云对象存储', 'driver' => '\\plugins\\aliyun_oss\\lib\\AliyunOss'];

        cmf_set_option('storage', $storageOption);
        return true;//安装成功返回true，失败false
    }

    // 插件卸载
    public function uninstall()
    {
        $storageOption = cmf_get_option('storage');
        if (empty($storageOption)) {
            $storageOption = [];
        }

        unset($storageOption['storages']['AliyunOss']);

        cmf_set_option('storage', $storageOption);
        return true;//卸载成功返回true，失败false
    }

}