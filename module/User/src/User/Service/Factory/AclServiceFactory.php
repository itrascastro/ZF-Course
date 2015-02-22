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
        $this->acl = new Acl();

        $config = $serviceLocator->get('config');
        $this->roles = $config['application']['roles'];

        foreach ($this->roles as $role) {
            $this->acl->addRole($role);
        }

        $routes = $config['router']['routes'];

        foreach ($routes as $route => $value) {
            $this->parseRoute($route, $value);
        }

        return $this->acl;
    }

    private function parseRoute($route, $value, $parent = null)
    {
        if (!$parent) {
            if (empty($value['child_routes'])) {
                $this->acl->addResource($route);
                $routeRoles = !empty($value['options']['defaults']['roles']) ? $value['options']['defaults']['roles'] : $this->roles;
                $this->acl->allow($routeRoles, $route);
            } elseif ($value['may_terminate']) {
                $this->acl->addResource($route);
                $routeRoles = !empty($value['options']['defaults']['roles']) ? $value['options']['defaults']['roles'] : $this->roles;
                $this->acl->allow($routeRoles, $route);

                foreach ($value['child_routes'] as $childRoute => $childValue) {
                    $this->parseRoute($childRoute, $childValue, $route);
                }
            } else {
                foreach ($value['child_routes'] as $childRoute => $childValue) {
                    $this->parseRoute($childRoute, $childValue, $route);
                }
            }
        } else {
            if (empty($value['child_routes'])) {
                $this->acl->addResource($parent . '/' . $route);
                $routeRoles = !empty($value['options']['defaults']['roles']) ? $value['options']['defaults']['roles'] : $this->roles;
                $this->acl->allow($routeRoles, $parent . '/' . $route);
            } elseif ($value['may_terminate']) {
                $this->acl->addResource($parent . '/' . $route);
                $routeRoles = !empty($value['options']['defaults']['roles']) ? $value['options']['defaults']['roles'] : $this->roles;
                $this->acl->allow($routeRoles, $parent . '/' . $route);

                foreach ($value['child_routes'] as $childRoute => $childValue) {
                    $this->parseRoute($childRoute, $childValue, $parent . '/' . $route);
                }
            } else {
                foreach ($value['child_routes'] as $childRoute => $childValue) {
                    $this->parseRoute($childRoute, $childValue, $parent . '/' . $route);
                }
            }
        }
    }
}