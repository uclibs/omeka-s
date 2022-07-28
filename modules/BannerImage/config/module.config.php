<?php
namespace BannerImage;

return [
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ]
    ],
	'block_layouts' => [
        'factories' => [
            'banner' => Service\BlockLayout\BannerFactory::class,
        ],
    ],
    'form_elements' => [
        'invokables' => [
            Form\BannerBlockForm::class => Form\BannerBlockForm::class,
        ],
    ],
    'DefaultSettings' => [
        'BannerBlockForm' => [
            'height' => '300px',
            // 'duration' => 200,
            // 'perPage' => 1,
            // 'loop' => true,
            // 'draggable' => true,
            'title' => '',
            'altText' => '',
            'textStyle' => 'color: #FFF; font-size: 1.2rem; font-weight: 500; align-self: center; padding: 4rem; text-shadow: 0px 0px 15px #000;',
            'wrapStyle' => 'overflow-y: hidden;display: flex;flex-direction: column;justify-content: center;',
            'imgStyle' => '',
            'ui_background' => 'linear-gradient(rgba(0,47,108,0.6), rgba(0,47,108,0.8));',
        ]
    ]
];