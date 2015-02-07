<?php

namespace User\Controller;

use User\Model\Interfaces\UserDaoInterface;
use Zend\Mvc\Controller\AbstractActionController;

class AccountController extends AbstractActionController
{
    /**
     * @var UserDaoInterface
     */
    private $_model;

    function __construct(UserDaoInterface $_model)
    {
        $this->_model = $_model;
    }

    public function indexAction()
    {
        $this->layout()->title = 'List Users';
        $users = $this->_model->findAll();

        var_dump($users);

        return ['users' => $users];
    }

    public function createAction()
    {
        $this->layout()->title = 'Create User';

        return [];
    }

    public function doCreateAction()
    {
        $this->_model->save($this->params()->fromPost());
        $this->redirect()->toRoute('account');
    }

    public function viewAction()
    {
        $this->layout()->title = 'User Details';

        $id = $this->params()->fromRoute('id');
        $user = $this->_model->getById($id);

        return ['user' => $user];
    }

    public function deleteAction()
    {
        $this->_model->delete($this->params()->fromRoute('id'));

        $this->redirect()->toRoute('account');
    }

    public function updateAction()
    {
        $this->layout()->title = 'Update User';

        $user = $this->_model->getById($this->params()->fromRoute('id'));

        return ['user' => $user];
    }

    public function doUpdateAction()
    {
        $this->_model->update($this->params()->fromPost());

        $this->redirect()->toRoute('account');
    }
}

