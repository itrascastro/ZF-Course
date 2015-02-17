<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'Calculator' => array(
        'zeroes' => 10,
    ),
    'router' => array(
        'routes' => array(
            'calculator\calculator\index' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/calculator/',
                    'defaults' => array(
                        'controller' => 'Calculator\Controller\Calculator',
                        'action'     => 'index',
                    ),
                ),
            ),
            'calculator\calculator\add' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/calculator/add/',
                    'defaults' => array(
                        'controller' => 'Calculator\Controller\Calculator',
                        'action'     => 'add',
                    ),
                ),
            ),
            'calculator\calculator\doAdd' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/calculator/do-add/',
                    'defaults' => array(
                        'controller' => 'Calculator\Controller\Calculator',
                        'action'     => 'doAdd',
                    ),
                ),
            ),
            'calculator\calculator\substract' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/calculator/substract/',
                    'defaults' => array(
                        'controller' => 'Calculator\Controller\Calculator',
                        'action'     => 'substract',
                    ),
                ),
            ),
            'calculator\calculator\multiply' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/calculator/multiply/',
                    'defaults' => array(
                        'controller' => 'Calculator\Controller\Calculator',
                        'action'     => 'multiply',
                    ),
                ),
            ),
            'calculator\calculator\division' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/calculator/division/',
                    'defaults' => array(
                        'controller' => 'Calculator\Controller\Calculator',
                        'action'     => 'division',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'Calculator\Model\Calculator' => 'Calculator\Model\CalculatorModel'
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            //'Calculator\Controller\Calculator' => 'Calculator\Controller\CalculatorController'
        ),
        'factories' => array(
            'Calculator\Controller\Calculator' => 'Calculator\Controller\Factory\CalculatorControllerFactory',
        ),
    ),
    'controller_plugins' => array(
        'factories' => array(
            'PrependZeros' => 'Calculator\Controller\Plugin\Factory\PrependZerosPluginFactory',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            //'layout/layout'             => __DIR__ . '/../view/layout/layout.phtml',
            'calculator/layout/header'  => __DIR__ . '/../view/layout/header.phtml',
            'calculator/layout/footer'  => __DIR__ . '/../view/layout/footer.phtml',
            'calculator/partial/menu'   => __DIR__ . '/../view/calculator/calculator/partial/menu.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'formHelper' => 'Calculator\View\Helper\FormHelper',
        ),
    ),
);
