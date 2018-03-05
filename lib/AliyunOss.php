<?php
// +----------------------------------------------------------------------
// | Author: jhj <jhj767658181@gmail.com>
// +----------------------------------------------------------------------
namespace plugins\aliyun_oss\lib;

use OSS\OssClient;
use OSS\Core\OssException;
class AliyunOss
{

    private $config;

    private $storageRoot;

    private $plugin;

    /**
     * AliyunOss constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $pluginClass = cmf_get_plugin_class('AliyunOss');

        $this->plugin = new $pluginClass();
        $this->config = $this->plugin->getConfig();
        //根路径
        $this->storageRoot = $this->config['protocol'] . '://' . $this->config['Endpoint'] . '/';
    }

    /**
     * 文件上传
     * @param string $file 上传文件路径
     * @param string $filePath 文件路径相对于upload目录
     * @param string $fileType 文件类型,image,video,audio,file
     * @return mixed
     */
    public function upload($file, $filePath, $fileType = 'image')
    {
        $accessKeyId = $this->config['accessKeyId'];
        $accessKeySecret= $this->config['accessKeySecret'];
        $EndPoint= $this->config['Endpoint'];
        $bucket= $this->config['bucket'];

        $ossClient = '';
        try{
            $ossClient = new OssClient($accessKeyId,$accessKeySecret,$EndPoint,true);
        }catch (OssException $e){
            print $e->getMessage();
        }

        $ossClient->setConnectTimeout(10);
        $ossClient->setTimeout(3600);
        //判断bucket是否存在,不存在去创建
        if(!$ossClient->doesBucketExist($bucket))
        {
            $ossClient->createBucket($bucket);
        }

        try{
            $ossClient->uploadFile($bucket,$file,$filePath);
        }catch (OssException $e){
            return $e->getMessage();
        }

        $previewUrl = $fileType == 'image' ? $this->getPreviewUrl($file) : $this->getFileDownloadUrl($file);
        $url        = $fileType == 'image' ? $this->getImageUrl($file) : $this->getFileDownloadUrl($file);

        return [
            'preview_url' => $previewUrl,
            'url'         => $url,
        ];
    }

    /**
     * 获取图片预览地址
     * @param $file
     * @return string
     * @author jhj
     */
    public function getPreviewUrl($file)
    {
        return $this->getUrl($file);
    }

    /**
     * 获取图片地址
     * @param string $file
     * @return mixed
     */
    public function getImageUrl($file)
    {
        return $this->getUrl($file);
    }

    /**
     * 获取文件地址
     * @param $file
     * @return string
     * @author jhj
     */
    public function getUrl($file)
    {
        return $this->storageRoot . $file;
    }

    /**
     * 获取文件下载地址
     * @param string $file
     * @param int $expires
     * @return mixed
     */
    public function getFileDownloadUrl($file, $expires = 3600)
    {
        try{
            $ossClient = new OssClient($this->config['accessKeyId'],$this->config['accessKeySecret'],$this->config['Endpoint'],true);
            return $ossClient->signUrl($this->config['Endpoint'],$file,$expires);
        }catch (OssException $e){
            return $e->getMessage();
        }
    }

    /**
     * 获取云存储域名
     * @return mixed
     */
    public function getDomain()
    {
        return $this->config['domain'];
    }
}