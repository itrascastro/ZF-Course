<?php
/**
 * xenFramework (http://xenframework.com/)
 *
 * This file is part of the xenframework package.
 *
 * (c) Ismael Trascastro <itrascastro@xenframework.com>
 *
 * @link        http://github.com/xenframework for the canonical source repository
 * @copyright   Copyright (c) xenFramework. (http://xenframework.com)
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace User\Service\Factory;


use Zend\Permissions\Acl\Acl;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AclServiceFactory implements FactoryInterface
{
    /**
     * @var Acl
     */
    private $acl;

    /**
     * @var array
     */
    private $roles;

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->acl      = new Acl();
        $config         = $serviceLocator->get('config');
        $this->roles    = $config['application']['roles'];
        $routes         = $config['router']['routes'];

        foreach ($this->roles as $role) {
            $this->acl->addRole($role);
        }

        foreach ($routes as $route => $value) {
            $this->parseRoute($route, $value);
        }

        return $this->acl;
    }

    /**
     * parseRoute
     *
     * For each route
     *      - It has not a parent route
     *          - It has not child routes
     *          - It has child routes
     *              - It can be alone (may_terminate == true)
     *              - It can't be alone (may_terminate == false)
     *      - It has a parent route
     *          - It has not child routes
     *          - It has child routes
     *              - It can be alone (may_terminate == true)
     *              - It can't be alone (may_terminate == false)
     *
     * @param string $route
     * @param array $value
     * @param string $parent
     */
    private function parseRoute($route, $value, $parent = null)
    {
        if (!$parent) {
            if (empty($value['child_routes'])) {
                $this->routeRolesToAcl($route, $value);
            } elseif ($value['may_terminate']) {
                $this->routeRolesToAcl($route, $value);
                $this->iterateChilds($route, $value);
            } else {
                $this->iterateChilds($route, $value);
            }
        } else {
            $route = $parent . '/' . $route;

            if (empty($value['child_routes'])) {
                $this->routeRolesToAcl($route, $value);
            } elseif ($value['may_terminate']) {
                $this->routeRolesToAcl($route, $value);
                $this->iterateChilds($route, $value);
            } else {
                $this->iterateChilds($route, $value);
            }
        }
    }

    /**
     * routeRolesToAcl
     *
     * Creates an allow rule in Acl for that route and its allowed roles
     *
     * @param string $route
     * @param array $value
     */
    private function routeRolesToAcl($route, $value)
    {
        $this->acl->addResource($route);
        $routeRoles = !empty($value['options']['defaults']['roles']) ? $value['options']['defaults']['roles'] : $this->roles;
        $this->acl->allow($routeRoles, $route);
    }

    /**
     * iterateChilds
     *
     * Iterates child routes for a given route parsing each child
     *
     * @param string $route
     * @param array $value
     */
    private function iterateChilds($route, $value)
    {
        foreach ($value['child_routes'] as $childRoute => $childValue) {
            $this->parseRoute($childRoute, $childValue, $route);
        }
    }
}
