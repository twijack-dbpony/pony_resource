<?php
/**
 *|--------------------------------------------------------------------------
 *| Claim:By the power of Twilight Sparkle and Applejack,
 *| I hereby decree this function is feasible.
 *|--------------------------------------------------------------------------
 *|
 *| Created by PhpStorm.
 *| User: AppleSparkle
 *| Date: 5/5/19
 *| Time: 11:06 AM
 */

return [
    'date' => date('Y-m-d H:i:s'),
    'day' => date('Y-m-d'),
    'upload' => date('YmdHis'),
    'page' => 10,

    'imageSize' => 500,
    'imageExtension' => 'png',

    'cache' => 2592000,

    'agentDir' => ['Agents','Eloquents','Interfaces'],
    'agentFile' => 'AgentsProvider',
    'agentPath' => 'Providers/',

    'slick' => 21,

    'textBoxIo' => [
        1 => 'ponypost_create',
        2 => 'manesix_ponypost_edit/postid/',
        3 => 'ponypost_edit/postid'
    ],

    'sidebar' => [
        ['manesix_self','主页',''],
        ['manesix_ppl','所有文章',''],
        ['twijack_pdl','小马们',''],
        ['twijack_pel','剧集列表',''],
        ['twijack_pcl','漫画列表',''],
        ['manesix_pi','个人资料','login'],
        ['manesix_ppc','发表文章','login'],
    ],

    'type' => [
        1 => [
            't' => '支出',
            'c' => 'purple'
        ],
        2 => [
            't' => '收入',
            'c' => 'orange'
        ]
    ],

    'typeSearch' => [
        'all' => '全部账单',
        1 => '支出',
        2 => '收入',
    ],

    'pay' => [
        'all' => 'all',
        1 => 'daily_life',
        2 => 'my_little_pony',
        3 => 'private',
        4 => 'breakfast',
        5 => 'lunch',
        6 => 'dinner',
        7 => 'travel',
        8 => 'utility',
        9 => 'steam',
        10 => 'game',
        11 => 'entertainment',
        12 => 'snack',
        13 => 'health',
        14 => 'other',
        15 => 'transfer',
        16 => 'redPacket',
        17 => 'lend'
    ],

    'receive' => [
        'all' => 'all',
        1 => 'salary',
        2 => 'redPacket',
        3 => 'refund',
        4 => 'transfer',
        5 => 'other'
    ],

    'quizSubject' => [
        'all' => '全部科目',
        1 => '数据库系统原理'
    ],

    'quizType' => [
        'all' => '全部类型',
        1 => '单选',
        2 => '多选'
    ],
];