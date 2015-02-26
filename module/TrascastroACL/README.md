TrascastroACL
=============

This module creates an ACL service from your routes.

Now you can manage your application access control from your routes by simply adding a 'roles' key like in this example:

            'user\users\update' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/users/update/id/:id/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'User\Controller\Users',
                        'action'     => 'update',
                        'roles'      => ['admin', 'moderator'],
                    ),
                ),
            ),

Only users with 'admin' or 'moderator' roles can now access to that route. If you do not create the 'roles' key in a
route or you left it empty, then the resource will be public.

The only configuration file you have to have is 'roles.global.php'. Copy it from the module config directory to the
config/autoload directory and remove the '.dist' suffix. You can add your roles there.