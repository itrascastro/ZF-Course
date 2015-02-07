<?php
return array(
    'router' => array(
        'routes' => array(
            'user\account\index' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/account/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Account',
                        'action'     => 'index',
                    ),
                ),
            ),
            'user\account\view' => array(
                'type'              => 'Segment',
                'options'           => array(
                    'route'         => '/account/view/id/[:id]/',
                    'constraints'   => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Account',
                        'action'     => 'view',
                    ),
                ),
            ),
            'user\account\create' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/account/create/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Account',
                        'action'     => 'create',
                    ),
                ),
            ),
            'user\account\doCreate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/account/do-create/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Account',
                        'action'     => 'doCreate',
                    ),
                ),
            ),
            'user\account\delete' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/account/delete/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Account',
                        'action'     => 'delete',
                    ),
                ),
            ),
            'user\account\update' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/account/update/id/[:id]/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Account',
                        'action'     => 'update',
                    ),
                ),
            ),
            'user\account\doUpdate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/account/do-update/',
                    'defaults' => array(
                        'controller' => 'User\Controller\Account',
                        'action'     => 'doUpdate',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'User\Model\UserDao'   => 'User\Model\Factory\UserDaoFactory',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'User\Controller\Account' => 'User\Controller\Factory\AccountControllerFactory',
        ),
    ),
    'view_manager' => array(
        'template_map'              => array(
            'user/account/partial/form' => __DIR__ . '/../view/user/account/partial/form.phtml',
        ),
        'template_path_stack'       => array(
            __DIR__ . '/../view',
        ),
    ),
);