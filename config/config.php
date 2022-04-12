<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'sms'   => [
        'code'     => 1,
        'title'    => '短信',
        'pkg_desc' => '常用短信扩展包',
        'source'   => [
            [
                'code'      => 1,
                'pkg_title' => 'overtrue/easy-sms',
                'pkg_url'   => 'https://github.com/overtrue/easy-sms'
            ]
        ]
    ],
    'login' => [
        'code'     => 2,
        'title'    => '第三方授权',
        'pkg_desc' => '常用第三方授权扩展包',
        'source'   => []
    ]
];
