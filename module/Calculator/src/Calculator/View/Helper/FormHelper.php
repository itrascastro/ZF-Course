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

namespace Calculator\View\Helper;


use Zend\View\Helper\AbstractHelper;

class FormHelper extends AbstractHelper
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $submit;

    public function __invoke($action, $submit)
    {
        $this->action = $action;
        $this->submit = $submit;

        return $this->render();
    }

    private function render()
    {
        return '
            <form id="calculatorForm" action="' . $this->action . '" method="post">
                <input type="number" name="op1"><br>
                <input type="number" name="op2"><br>
                <input type="submit" value="' . $this->submit . '">
            </form>
        ';
    }
}