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

namespace Calculator\Controller\Plugin;


use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class PrependZerosPlugin extends AbstractPlugin
{
    /**
     * @var int The number of 0's to prepend
     */
    private $digits;

    public function __construct($digits)
    {
        $this->digits = $digits;
    }

    /**
     * __invoke
     *
     * @param int $number The number to prepend zeros in
     *
     * @return string
     */
    public function __invoke($number)
    {
        return sprintf('%0' . $this->digits . 'd', $number);
    }
}