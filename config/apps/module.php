<?php

return [
    'module' => [
        [
            'title' => 'QL Thành Viên',
            'icon' => 'fa fa-th-large',
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
            'title' => 'QL Bài Viết',
            'icon' => 'fa fa-file',
            'subModule' => [
                [
                    'title' => 'QL Nhóm Bài Viết',
                    'route' => 'post.catalogue.index',
                ],
                [
                    'title' => 'QL Bài Viết',
                    'route' => 'post.index',
                ]
            ]
        ]
    ],
];