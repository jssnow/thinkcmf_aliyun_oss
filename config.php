<?php
// +----------------------------------------------------------------------
// | Author: jhj <jhj767658181@gmail.com>
// +----------------------------------------------------------------------
return [
    'accessKeyId'                 => [
        'title'   => 'AccessKey',
        'type'    => 'text',
        'value'   => '',
        "rule"    => [
            "require" => true
        ],
        "message" => [
            "require" => 'accessKeyId不能为空'
        ],
        'tip'     => '' //表单的帮助提示
    ],
    'accessKeySecret'                 => [// 在后台插件配置表单中的键名 ,会是config[password]
        'title'   => 'accessKeySecret',
        'type'    => 'text',
        'value'   => '',
        "rule"    => [
            "require" => true
        ],
        "message" => [
            "require" => 'accessKeySecret不能为空'
        ],
        'tip'     => ''
    ],
    'Endpoint'                    => [
        'title'   => '访问域名',
        'type'    => 'text',
        'value'   => '',
        "rule"    => [
            "require" => true
        ],
        "message" => [
            "require" => '访问域名不能为空'
        ],
        'tip'     => ''
    ],
    'bucket'                    => [
        'title'   => '空间名称',
        'type'    => 'text',
        'value'   => '',
        "rule"    => [
            "require" => true
        ],
        "message" => [
            "require" => '空间名称不能为空'
        ],
        'tip'     => ''
    ],
    'style_separator'           => [
        'title'   => '样式分隔符',
        'type'    => 'text',
        'value'   => '!',
        "rule"    => [
            "require" => true
        ],
        "message" => [
            "require" => '样式分隔符不能为空'
        ],
        'tip'     => ''
    ],
];
					