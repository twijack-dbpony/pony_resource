<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/6/2018 AD
 * Time: 10:44 AM
 */
/*
|--------------------------------------------------------------------------
| Web Filter Data List
|--------------------------------------------------------------------------
|
| Those down below are strictly forbidden to appear from post requests.
| Since HTML tags were already taken care of by php function.
| This list is specifically designed for Javascript tags.
|
*/
return [
    'filter' => [
        0 => 'javascript',
        1 => 'vbscript',
        2 => 'expression',
        3 => 'applet',
        4 => 'meta',
        5 => 'xml',
        6 => 'blink',
        7 => 'link',
        8 => 'style',
        9 => 'script',
        10 => 'embed',
        11 => 'object',
        12 => 'iframe',
        13 => 'frame',
        14 => 'frameset',
        15 => 'ilayer',
        16 => 'layer',
        17 => 'bgsound',
        18 => 'title',
        19 => 'base',
        20 => 'onabort',
        21 => 'onactivate',
        22 => 'onafterprint',
        23 => 'onafterupdate',
        24 => 'onbeforeactivate',
        25 => 'onbeforecut',
        26 => 'onbeforecopy',
        27 => 'onbeforedeactivate',
        28 => 'onbeforeeditfocus',
        29 => 'onbeforepaste',
        30 => 'onbeforeprint',
        31 => 'onbeforeunload',
        32 => 'onbeforeupdate',
        33 => 'onblur',
        34 => 'onbounce',
        35 => 'oncellchange',
        36 => 'onchange',
        37 => 'onclick',
        38 => 'oncontrolselect',
        39 => 'oncopy',
        40 => 'oncut',
        41 => 'ondataavailable',
        42 => 'ondatasetchanged',
        43 => 'ondatasetcomplete',
        44 => 'ondblclick',
        45 => 'ondeactivate',
        46 => 'ondrag',
        47 => 'ondragend',
        48 => 'ondragenter',
        49 => 'ondragleave',
        50 => 'ondragover',
        51 => 'ondragstart',
        52 => 'ondrop',
        53 => 'onerror',
        54 => 'onerrorupdate',
        55 => 'onfilterchange',
        56 => 'onfinish',
        57 => 'onfocus',
        58 => 'onfocusin',
        59 => 'onfocusout',
        60 => 'onhelp',
        61 => 'onkeydown',
        62 => 'onkeypress',
        63 => 'onkeyup',
        64 => 'onlayoutcomplete',
        65 => 'onload',
        66 => 'onlosecapture',
        67 => 'onmousedown',
        68 => 'onmouseenter',
        69 => 'onmouseleave',
        70 => 'onmousemove',
        71 => 'onmouseout',
        72 => 'onmouseover',
        73 => 'onmouseup',
        74 => 'onmousewheel',
        75 => 'onmove',
        76 => 'onmoveend',
        77 => 'onmovestart',
        78 => 'onpaste',
        79 => 'onpropertychange',
        80 => 'onreadystatechange',
        81 => 'onreset',
        82 => 'onresize',
        83 => 'onresizeend',
        84 => 'onresizestart',
        85 => 'onrowenter',
        86 => 'onrowexit',
        87 => 'onrowsdelete',
        88 => 'onrowsinserted',
        89 => 'onscroll',
        90 => 'onselect',
        91 => 'onselectionchange',
        92 => 'onselectstart',
        93 => 'onstart',
        94 => 'onstop',
        95 => 'onsubmit',
        96 => 'onunload',
    ]
];