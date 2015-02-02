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

namespace Calculator\Controller;


use Calculator\Model\CalculatorModel;
use Zend\Mvc\Controller\AbstractActionController;

class CalculatorController extends AbstractActionController
{
    /**
     * @var CalculatorModel
     */
    private $model;

    /**
     * @param CalculatorModel $model
     */
    function __construct(CalculatorModel $model)
    {
        $this->model = $model;
    }


    public function indexAction()
    {
        return [];
    }

    public function addAction()
    {
        return ['title' => 'Add'];
    }

    public function doAddAction()
    {
        $this->model->setOp1($this->params()->fromPost('op1'));
        $this->model->setOp2($this->params()->fromPost('op2'));

        $this->model->add();

        return ['result' => $this->model->getResult()];

    }
}