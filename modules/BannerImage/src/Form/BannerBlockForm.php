<?php
namespace BannerImage\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class BannerBlockForm extends Form
{
	public function init()
	{
		$this->add([
			'name' => 'o:block[__blockIndex__][o:data][height]',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Banner height',
                'info' => 'Enter a number with CSS units (e.g. 250px, 50%, 50vh).',
            ],
		]);

		// $this->add([
		// 	'name' => 'o:block[__blockIndex__][o:data][duration]',
        //     'type' => Element\Number::class,
        //     'options' => [
		// 		'label' => 'Duration (milliseconds)',
		// 		'info' => 'Slide transition duration in milliseconds.'
        //     ],
		// ]);

		// $this->add([
		// 	'name' => 'o:block[__blockIndex__][o:data][perPage]',
        //     'type' => Element\Number::class,
        //     'options' => [
		// 		'label' => 'Image Per page',
		// 		'info' => 'The number of slides to be shown.'
		// 	],
		// 	'attributes' => [
		// 		'min' => 1,
        //         'max' => 10,
		// 	]
		// ]);

		// $this->add([
		// 	'name' => 'o:block[__blockIndex__][o:data][loop]',
		// 	'type' => Element\Checkbox::class,
        //     'options' => [
		// 		'label' => 'Loop',
		// 	]
		// ]);

		// $this->add([
		// 	'name' => 'o:block[__blockIndex__][o:data][draggable]',
		// 	'type' => Element\Checkbox::class,
        //     'options' => [
		// 		'label' => 'Draggable',
		// 	]
		// ]);

		$this->add([
			'name' => 'o:block[__blockIndex__][o:data][title]',
			'type' => Element\Textarea::class,
			'class' => 'block-html full wysiwyg',
            'options' => [
				'label' => 'Banner Text',
				'info' => 'Enter text to display over banner image (optional).'
			]
		]);

		$this->add([
			'name' => 'o:block[__blockIndex__][o:data][altText]',
			'type' => Element\Text::class,
            'options' => [
				'label' => 'Image Alt Text',
				'info' => 'Enter Alt text for image.'
			]
		]);

		$this->add([
			'name' => 'o:block[__blockIndex__][o:data][textStyle]',
			'type' => Element\Text::class,
            'options' => [
				'label' => 'Text Style',
				'info' => 'Enter style elements for text.'
			]
		]);

		$this->add([
			'name' => 'o:block[__blockIndex__][o:data][wrapStyle]',
			'type' => Element\Text::class,
            'options' => [
				'label' => 'Image Wrapper Style',
				'info' => 'Style elements for .banner-wrap'
			]
		]);
		$this->add([
			'name' => 'o:block[__blockIndex__][o:data][imgStyle]',
			'type' => Element\Text::class,
            'options' => [
				'label' => 'Img Tag Style',
				'info' => 'Style elements for <img>.'
			]
		]);

		$this->add([
			'name' => 'o:block[__blockIndex__][o:data][ui_background]',
			'type' => Element\Text::class,
			'options' => [
				'label' => 'Banner Overlay Styling',
				'info' => 'Enter linear-gradient() CSS.'
			]
		]);
	}
}
