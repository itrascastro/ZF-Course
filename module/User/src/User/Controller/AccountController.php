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

namespace User\Controller;

use User\Form\User as UserForm;
use User\Model\Interfaces\UserDaoInterface;
use User\Model\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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
        $this->layout()->title = 'List Users';
        $users = $this->model->findAll();

        return ['users' => $users];
    }

    public function createAction()
    {
        $this->layout()->title = 'Create User';

        $form = new UserForm();
        $form->get('submit')->setValue('Create New User');
        $form->setAttribute('action', $this->url()->fromRoute('user\account\doCreate'));

        return ['form' => $form, 'isUpdate' => false];
    }

    public function doCreateAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form = new UserForm();
            $userEntity = new User();
            $form->setInputFilter($userEntity->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formData = $form->getData();

                $data['email']      = $formData['email'];
                $data['password']   = $formData['password'];
                $data['role']       = $formData['role'];
                $data['date']       = date('Y-m-d H:i:s');

                $this->model->save($data);

                $this->redirect()->toRoute('user\account\index');
            }

            $form->prepare();

            $this->layout()->title = 'Create User - Error - Review your data';

            // we reuse the create view
            $view = new ViewModel(['form' => $form, 'isUpdate' => false]);
            $view->setTemplate('user/account/create.phtml');

            return $view;
        }

        $this->redirect()->toRoute('user\account\create');
    }

    public function viewAction()
    {
        $this->layout()->title = 'User Details';

        $id = $this->params()->fromRoute('id');
        $user = $this->model->getById($id);

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

        $form = new UserForm();
        $form->setAttribute('action', $this->url()->fromRoute('user\account\doUpdate'));
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'Edit User');

        // we reuse the create view
        $view = new ViewModel(['form' => $form, 'isUpdate' => true]);
        $view->setTemplate('user/account/create.phtml');

        return $view;
    }

    public function doUpdateAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form = new UserForm();
            $userEntity = new User();
            $form->setInputFilter($userEntity->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formData = $form->getData();

                $data['id']         = $formData['id'];
                $data['email']      = $formData['email'];
                $data['password']   = $formData['password'];
                $data['role']       = $formData['role'];
                $data['date']       = $formData['date']; //date('Y-m-d H:i:s');

                $this->model->update($data);

                return $this->redirect()->toRoute('user\account\index');
            }

            $form->prepare();

            $this->layout()->title = 'Update User - Error - Review your data';

            // we reuse the create view
            $view = new ViewModel(['form' => $form, 'isUpdate' => true]);
            $view->setTemplate('user/account/create.phtml');

            return $view;
        }

        $this->redirect()->toRoute('user\account\index');
    }
}

