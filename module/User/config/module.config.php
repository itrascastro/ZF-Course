<?php
return array(
    'router' => array(
        'routes' => array(
            'account' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/account/',
                    'defaults' => array(
                        'controller' => 'account',
                        'action'     => 'index',
                    ),
                ),
            ),
            'account_view' => array(
                'type'              => 'Segment',
                'options'           => array(
                    'route'         => '/account/view/id/[:id]/',
                    'constraints'   => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'account',
                        'action'     => 'view',
                    ),
                ),
            ),
            'account_create' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/account/create/',
                    'defaults' => array(
                        'controller' => 'account',
                        'action'     => 'create',
                    ),
                ),
            ),
            'account_doCreate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/account/do-create/',
                    'defaults' => array(
                        'controller' => 'account',
                        'action'     => 'doCreate',
                    ),
                ),
            ),
            'account_delete' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/account/delete/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'account',
                        'action'     => 'delete',
                    ),
                ),
            ),
            'account_update' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/account/update/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'account',
                        'action'     => 'update',
                    ),
                ),
            ),
            'account_doUpdate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/account/do-update/',
                    'defaults' => array(
                        'controller' => 'account',
                        'action'     => 'doUpdate',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'userDao'   => 'User\Model\Factory\UserDaoFactory',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'account' => 'User\Controller\Factory\AccountControllerFactory',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason'  => true,
        'display_exceptions'        => true,
        'doctype'                   => 'HTML5',
        'not_found_template'        => 'error/404',
        'exception_template'        => 'error/index',
        'template_map'              => array(
            'partial/form' => __DIR__ . '/../view/partial/form.phtml',
        ),
        'template_path_stack'       => array(
            __DIR__ . '/../view',
        ),
    ),
);