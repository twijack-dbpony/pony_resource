<?php
/**
 *|--------------------------------------------------------------------------
 *| Claim:By the power of Twilight Sparkle and Applejack,
 *| I hereby decree this function is feasible.
 *|--------------------------------------------------------------------------
 *|
 *| Created by PhpStorm.
 *| User: AppleSparkle
 *| Date: 7/15/19
 *| Time: 4:58 PM
 */

return [
    'level_first' => [
        'all' => '全部档位',
        1 => 120,
        2 => 150,
        3 => 260,
        4 => 500,
        5 => 1000,
        6 => 2000,
        7 => 8888,
        8 => 28888
    ],

    'level_second' => [
        'all' => '全部档位',
        1 => 188,
        2 => 218,
        3 => 588,
        4 => 1288
    ],

    'type' => [
        1 => [
            'time' => '第一次',
            'level' => 'first'
        ],
        2 => [
            'time' => '第二次',
            'level' => 'second'
        ]
    ],

    'status' => [
        1 => [
            'string' => '待领取',
            'color' => 'grey'
        ],
        2 => [
            'string' => '已领取',
            'color' => 'green'
        ],
        3 => [
            'string' => '未全部领取',
            'color' => 'red'
        ]
    ],

    'search' => [
        'name' => '收件名',
        'nickname' => '摩点用户名',
        'phone' => '手机',
        'modian_order_id' => '摩点订单id',
        'uid' => '摩点用户id'
    ]
];