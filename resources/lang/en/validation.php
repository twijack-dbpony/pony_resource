<?php

//return [
//
//    /*
//    |--------------------------------------------------------------------------
//    | Validation Language Lines
//    |--------------------------------------------------------------------------
//    |
//    | The following language lines contain the default error messages used by
//    | the validator class. Some of these rules have multiple versions such
//    | as the size rules. Feel free to tweak each of these messages here.
//    |
//    */
//
//    'accepted'             => 'The :attribute must be accepted.',
//    'active_url'           => 'The :attribute is not a valid URL.',
//    'after'                => 'The :attribute must be a date after :date.',
//    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
//    'alpha'                => 'The :attribute may only contain letters.',
//    'alpha_dash'           => 'The :attribute may only contain letters, numbers, dashes and underscores.',
//    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
//    'array'                => 'The :attribute must be an array.',
//    'before'               => 'The :attribute must be a date before :date.',
//    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
//    'between'              => [
//        'numeric' => 'The :attribute must be between :min and :max.',
//        'file'    => 'The :attribute must be between :min and :max kilobytes.',
//        'string'  => 'The :attribute must be between :min and :max characters.',
//        'array'   => 'The :attribute must have between :min and :max items.',
//    ],
//    'boolean'              => 'The :attribute field must be true or false.',
//    'confirmed'            => 'The :attribute confirmation does not match.',
//    'date'                 => 'The :attribute is not a valid date.',
//    'date_format'          => 'The :attribute does not match the format :format.',
//    'different'            => 'The :attribute and :other must be different.',
//    'digits'               => 'The :attribute must be :digits digits.',
//    'digits_between'       => 'The :attribute must be between :min and :max digits.',
//    'dimensions'           => 'The :attribute has invalid image dimensions.',
//    'distinct'             => 'The :attribute field has a duplicate value.',
//    'email'                => 'The :attribute must be a valid email address.',
//    'exists'               => 'The selected :attribute is invalid.',
//    'file'                 => 'The :attribute must be a file.',
//    'filled'               => 'The :attribute field must have a value.',
//    'gt'                   => [
//        'numeric' => 'The :attribute must be greater than :value.',
//        'file'    => 'The :attribute must be greater than :value kilobytes.',
//        'string'  => 'The :attribute must be greater than :value characters.',
//        'array'   => 'The :attribute must have more than :value items.',
//    ],
//    'gte'                  => [
//        'numeric' => 'The :attribute must be greater than or equal :value.',
//        'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
//        'string'  => 'The :attribute must be greater than or equal :value characters.',
//        'array'   => 'The :attribute must have :value items or more.',
//    ],
//    'image'                => 'The :attribute must be an image.',
//    'in'                   => 'The selected :attribute is invalid.',
//    'in_array'             => 'The :attribute field does not exist in :other.',
//    'integer'              => 'The :attribute must be an integer.',
//    'ip'                   => 'The :attribute must be a valid IP address.',
//    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
//    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
//    'json'                 => 'The :attribute must be a valid JSON string.',
//    'lt'                   => [
//        'numeric' => 'The :attribute must be less than :value.',
//        'file'    => 'The :attribute must be less than :value kilobytes.',
//        'string'  => 'The :attribute must be less than :value characters.',
//        'array'   => 'The :attribute must have less than :value items.',
//    ],
//    'lte'                  => [
//        'numeric' => 'The :attribute must be less than or equal :value.',
//        'file'    => 'The :attribute must be less than or equal :value kilobytes.',
//        'string'  => 'The :attribute must be less than or equal :value characters.',
//        'array'   => 'The :attribute must not have more than :value items.',
//    ],
//    'max'                  => [
//        'numeric' => 'The :attribute may not be greater than :max.',
//        'file'    => 'The :attribute may not be greater than :max kilobytes.',
//        'string'  => 'The :attribute may not be greater than :max characters.',
//        'array'   => 'The :attribute may not have more than :max items.',
//    ],
//    'mimes'                => 'The :attribute must be a file of type: :values.',
//    'mimetypes'            => 'The :attribute must be a file of type: :values.',
//    'min'                  => [
//        'numeric' => 'The :attribute must be at least :min.',
//        'file'    => 'The :attribute must be at least :min kilobytes.',
//        'string'  => 'The :attribute must be at least :min characters.',
//        'array'   => 'The :attribute must have at least :min items.',
//    ],
//    'not_in'               => 'The selected :attribute is invalid.',
//    'not_regex'            => 'The :attribute format is invalid.',
//    'numeric'              => 'The :attribute must be a number.',
//    'present'              => 'The :attribute field must be present.',
//    'regex'                => 'The :attribute format is invalid.',
//    'required'             => 'The :attribute field is required.',
//    'required_if'          => 'The :attribute field is required when :other is :value.',
//    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
//    'required_with'        => 'The :attribute field is required when :values is present.',
//    'required_with_all'    => 'The :attribute field is required when :values is present.',
//    'required_without'     => 'The :attribute field is required when :values is not present.',
//    'required_without_all' => 'The :attribute field is required when none of :values are present.',
//    'same'                 => 'The :attribute and :other must match.',
//    'size'                 => [
//        'numeric' => 'The :attribute must be :size.',
//        'file'    => 'The :attribute must be :size kilobytes.',
//        'string'  => 'The :attribute must be :size characters.',
//        'array'   => 'The :attribute must contain :size items.',
//    ],
//    'string'               => 'The :attribute must be a string.',
//    'timezone'             => 'The :attribute must be a valid zone.',
//    'unique'               => 'The :attribute has already been taken.',
//    'uploaded'             => 'The :attribute failed to upload.',
//    'url'                  => 'The :attribute format is invalid.',
//
//    /*
//    |--------------------------------------------------------------------------
//    | Custom Validation Language Lines
//    |--------------------------------------------------------------------------
//    |
//    | Here you may specify custom validation messages for attributes using the
//    | convention "attribute.rule" to name the lines. This makes it quick to
//    | specify a specific custom language line for a given attribute rule.
//    |
//    */
//
//    'custom' => [
//        'attribute-name' => [
//            'rule-name' => 'custom-message',
//        ],
//    ],
//
//    /*
//    |--------------------------------------------------------------------------
//    | Custom Validation Attributes
//    |--------------------------------------------------------------------------
//    |
//    | The following language lines are used to swap attribute place-holders
//    | with something more reader friendly such as E-Mail Address instead
//    | of "email". This simply helps us make messages a little cleaner.
//    |
//    */
//
//    'attributes' => [],
//
//];

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute必须接受',
    'active_url'           => ':attribute必须是一个合法的 URL',
    'after'                => ':attribute 必须是 :date 之后的一个日期',
    'after_or_equal'       => ':attribute 必须是 :date 之后或相同的一个日期',
    'alpha'                => ':attribute只能包含字母',
    'alpha_dash'           => ':attribute只能包含字母、数字、中划线或下划线',
    'alpha_num'            => ':attribute只能包含字母和数字',
    'array'                => ':attribute必须是一个数组',
    'before'               => ':attribute 必须是 :date 之前的一个日期',
    'before_or_equal'      => ':attribute 必须是 :date 之前或相同的一个日期',
    'between'              => [
        'numeric' => ':attribute 必须在 :min 到 :max 之间',
        'file'    => ':attribute 必须在 :min 到 :max KB 之间',
        'string'  => ':attribute 必须在 :min 到 :max 个字符之间',
        'array'   => ':attribute 必须在 :min 到 :max 项之间',
    ],
    'boolean'              => ':attribute 字符必须是 true 或 false',
    'confirmed'            => ':attribute 二次确认不匹配',
    'date'                 => ':attribute 必须是一个合法的日期',
    'date_format'          => ':attribute 与给定的格式 :format 不符合',
    'different'            => ':attribute 必须不同于 :other',
    'digits'               => ':attribute必须是 :digits 位.',
    'digits_between'       => ':attribute 必须在 :min 和 :max 位之间',
    'dimensions'           => ':attribute具有无效的图片尺寸',
    'distinct'             => ':attribute字段具有重复值',
    'email'                => ':attribute必须是一个合法的电子邮件地址',
    'exists'               => '选定的 :attribute 是无效的.',
    'file'                 => ':attribute必须是一个文件',
    'filled'               => ':attribute的字段是必填的',
    'image'                => ':attribute必须是 jpeg, png, bmp 或者 gif 格式的图片',
    'in'                   => '选定的 :attribute 是无效的',
    'in_array'             => ':attribute 字段不存在于 :other',
    'integer'              => ':attribute 必须是个整数',
    'ip'                   => ':attribute必须是一个合法的 IP 地址。',
    'json'                 => ':attribute必须是一个合法的 JSON 字符串',
    'max'                  => [
        'numeric' => ':attribute 的最大长度为 :max 位',
        'file'    => ':attribute 的最大为 :max',
        'string'  => ':attribute 的最大长度为 :max 字符',
        'array'   => ':attribute 的最大个数为 :max 个.',
    ],
    'mimes'                => ':attribute 的文件类型必须是 :values',
    'min'                  => [
        'numeric' => ':attribute 的最小长度为 :min 位',
        'file'    => ':attribute 大小至少为 :min KB',
        'string'  => ':attribute 的最小长度为 :min 字符',
        'array'   => ':attribute 至少有 :min 项',
    ],
    'not_in'               => '选定的 :attribute 是无效的',
    'numeric'              => ':attribute 必须是数字',
    'present'              => ':attribute 字段必须存在',
    'regex'                => ':attribute 格式是无效的',
    'required'             => ':attribute 不可以为空白啊',
    'required_if'          => ':attribute 字段是必须的当 :other 是 :value',
    'required_unless'      => ':attribute 字段是必须的，除非 :other 是在 :values 中',
    'required_with'        => ':attribute 字段是必须的当 :values 是存在的',
    'required_with_all'    => ':attribute 字段是必须的当 :values 是存在的',
    'required_without'     => ':attribute 字段是必须的当 :values 是不存在的',
    'required_without_all' => ':attribute 字段是必须的当 没有一个 :values 是存在的',
    'same'                 => ':attribute和:other必须匹配',
    'size'                 => [
        'numeric' => ':attribute 必须是 :size 位',
        'file'    => ':attribute 必须是 :size KB',
        'string'  => ':attribute 必须是 :size 个字符',
        'array'   => ':attribute 必须包括 :size 项',
    ],
    'string'               => ':attribute 必须是一个字符串',
    'timezone'             => ':attribute 必须是个有效的时区.',
    'unique'               => ':attribute 已存在',
    'url'                  => ':attribute 无效的格式',
    'captcha'                  => '验证码错误',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'url'         => '文章缩略图',
        'content'     => '文章内容',
        'title'       => '文章标题',
        'ponyname'    => '用户名称',
        'nickname'    => '用户昵称',
        'password'    => '密码',
        'confirm'     => '再次输入的密码',
        'captcha'     => '验证码',
        'intro'        => '个人简介',
        'royalwatcher' => '看守马名称',
        'type' => '密码类型',
        'username' => '账号',
        'bucks' => '金额',
        'consumeText' => '文本补充',
        'correct' => '正确答案',
        'question' => '问题'
    ],

];
