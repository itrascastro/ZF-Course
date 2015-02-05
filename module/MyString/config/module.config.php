<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'myString\myString\index' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/my-string/',
                    'defaults' => array(
                        'controller' => 'MyString\Controller\MyString',
                        'action'     => 'index',
                    ),
                ),
            ),
            'myString\myString\concatenate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/my-string/concatenate/',
                    'defaults' => array(
                        'controller' => 'MyString\Controller\MyString',
                        'action'     => 'concatenate',
                    ),
                ),
            ),
            'myString\myString\doConcatenate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/my-string/do-concatenate/',
                    'defaults' => array(
                        'controller' => 'MyString\Controller\MyString',
                        'action'     => 'doConcatenate',
                    ),
                ),
            ),
            'myString\myString\find' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/my-string/find/',
                    'defaults' => array(
                        'controller' => 'MyString\Controller\MyString',
                        'action'     => 'find',
                    ),
                ),
            ),
            'myString\myString\doFind' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/my-string/do-find/',
                    'defaults' => array(
                        'controller' => 'MyString\Controller\MyString',
                        'action'     => 'doFind',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'MyString\Model\MyString' => 'MyString\Model\MyStringModel'
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'MyString\Controller\MyString' => 'MyString\Controller\Factory\MyStringControllerFactory',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            //'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
