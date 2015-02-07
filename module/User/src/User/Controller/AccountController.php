<?php

namespace User\Controller;

use User\Model\Interfaces\UserDaoInterface;
use Zend\Mvc\Controller\AbstractActionController;

class AccountController extends AbstractActionController
{
    /**
     * @var UserDaoInterface
     */
    private $model;

    function __construct(UserDaoInterface $model)
    {
        $this->model = $model;
    }

    public function indexAction()
    {
        $this->layout()->title  = 'List Users';
        $users                  = $this->model->findAll();

        return ['users' => $users];
    }

    public function createAction()
    {
        $this->layout()->title = 'Create User';

        return [];
    }

    public function doCreateAction()
    {
        $this->model->save($this->params()->fromPost());

        $this->redirect()->toRoute('user\account\index');
    }

    public function viewAction()
    {
        $this->layout()->title  = 'User Details';
        $id                     = $this->params()->fromRoute('id');
        $user                   = $this->model->getById($id);

        return ['user' => $user];
    }

    public function deleteAction()
    {
        $this->model->delete($this->params()->fromRoute('id'));

        $this->redirect()->toRoute('user\account\index');
    }

    public function updateAction()
    {
        $this->layout()->title = 'Update User';

        $user = $this->model->getById($this->params()->fromRoute('id'));

        return ['user' => $user];
    }

    public function doUpdateAction()
    {
        $this->model->update($this->params()->fromPost());

        $this->redirect()->toRoute('user\account\index');
    }
}

