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

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;

class AController extends AbstractActionController
{
    public function fooAction()
    {
        echo $this->forward()->dispatch('Application\Controller\B', ['action' => 'bar', 'var' => '10']);
        exit();
    }
}