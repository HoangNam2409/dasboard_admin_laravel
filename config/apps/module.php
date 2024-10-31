<?php

return [
    'module' => [
        [
            'title' => 'QL Thành Viên',
            'icon' => 'fa fa-th-large',
            'name' => ['user'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Thành Viên',
                    'route' => 'user.catalogue.index',
                ],
                [
                    'title' => 'QL Thành Viên',
                    'route' => 'user.index',
                ]
            ]
        ],
        [
            'title' => 'Cấu hình chung',
            'icon' => 'fa fa-file',
            'name' => ['language'],
            'subModule' => [
                [
                    'title' => 'QL Ngôn ngữ',
                    'route' => 'language.index',
                ],
            ]
        ]
    ],
];