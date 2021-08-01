<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Portal;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

$lang = 'en_US';
$lang_arr = array('en_US', 'he_IL');
if ( isset( $_GET['lang'] ) && !empty( $_GET['lang'] ) ) {
	if ( in_array( $lang, $lang_arr ) ) {
		$lang = $_GET['lang'];
	}
}

return [
    'router' => [
	    'translator_text_domain' => 'portal',
	    'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'portal' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/portal[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'SetWord' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/SetWord[/:action]',
                    'defaults' => [
                        'controller' => RestController\RestController::class,
                        'action'     => 'SetWord',
                    ],
                ],
            ],
        ],
    ],
	'translator' => [
		'locale' => $lang,
		'translation_file_patterns' => [
			[
				'type'     => 'gettext',
				'base_dir' => __DIR__ . '/../language',
				'pattern'  => '%s/text.mo',
			],
		],
	],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            WordsController\WordsController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'portal/index/index' => __DIR__ . '/../view/portal/index/index.phtml',
            'portal/words/index' => __DIR__ . '/../view/portal/words/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
