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

namespace MyString\Controller;


use MyString\Model\MyStringModel;
use Zend\Mvc\Controller\AbstractActionController;

class MyStringController extends AbstractActionController
{
    /**
     * @var MyStringModel
     */
    private $model;

    /**
     * @param MyStringModel $model
     */
    function __construct(MyStringModel $model)
    {
        $this->model = $model;
    }


    public function indexAction()
    {
        return [];
    }

    public function concatenateAction()
    {
        return ['title' => 'Concatenate'];
    }

    public function doConcatenateAction()
    {
        $this->model->setCad1($this->params()->fromPost('cad1'));
        $this->model->setCad2($this->params()->fromPost('cad2'));

        $this->model->concatenate();

        return ['result' => $this->model->getResult()];

    }

    public function findAction()
    {
        return ['title' => 'Find'];
    }

    public function doFindAction()
    {
        $this->model->setCad1($this->params()->fromPost('cad1'));
        $this->model->setCad2($this->params()->fromPost('cad2'));

        $this->model->find();

        $find = $this->model->getResult();

        $result = ($find !== false) ? $this->model->getCad1() . ' is in ' . $this->model->getCad2() : 'Not found';

        return ['result' => $result];

    }
}