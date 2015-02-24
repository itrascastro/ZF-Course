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

use User\Form\UserForm;
use User\Model\UsersModel;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UsersRESTController extends AbstractRestfulController
{
    /**
     * @var UsersModel
     */
    private $model;

    /**
     * @var UserForm
     */
    private $form;

    /**
     * @param UsersModel $model
     * @param UserForm $form
     */
    function __construct(UsersModel $model, UserForm $form)
    {
        $this->model = $model;
        $this->form = $form;
    }

    // The following methods will be mapped from the HTTP request
    // http://framework.zend.com/manual/current/en/modules/zend.mvc.controllers.html#the-abstractrestfulcontroller

    /**
     * getList
     *
     * Maps HTTP Request Method: GET
     *
     * Using from the client
     *
     * Curl
     *      curl -i -H "Accept: application/json" http://localhost:8080/users-rest/
     * Browser
     *      http://localhost:8080/users-rest/
     *
     * @return JsonModel
     */
    public function getList()
    {
        $users = $this->model->findAll(false);

        foreach ($users as $user) {
            $userArray  = $user->getArrayCopy();
            $data[]     = $userArray;
        }

        return new JsonModel([
            'data' => $data
        ]);
    }

    /**
     * get
     *
     * Maps HTTP Request Method: GET
     *
     * Curl
     *      curl -i -H "Accept: application/json" http://localhost:8080/users-rest/id/?/
     * Browser
     *      http://localhost:8080/users-rest/id/?/
     *
     * @param int $id
     * @return JsonModel
     */
    public function get($id)
    {
        $user       = $this->model->getById($id);
        $userArray  = $user->getArrayCopy();

        return new JsonModel([
            'data' => $userArray
        ]);
    }

    /**
     * create
     *
     * Maps HTTP Request Method: POST
     *
     * Curl
     *      curl -i -H "Accept: application/json" -X POST -d "username=API&email=api@email.com&password=1234&role=user" http://localhost:8080/users-rest/
     *
     * @param mixed $data
     * @return mixed|JsonModel
     */
    public function create($data)
    {
        $this->form->setData($data);

        if ($this->form->isValid()) {
            $formData = $this->form->getData();

            $data['username']   = $formData['username'];
            $data['email']      = $formData['email'];
            $data['password']   = $formData['password'];
            $data['role']       = $formData['role'];
            $data['date']       = date('Y-m-d H:i:s');

            $id = $this->model->save($data);

            // We cannot call $this->get($id) because the request method now is POST instead of GET
            $user       = $this->model->getById($id);
            $userArray  = $user->getArrayCopy();

            return new JsonModel([
                'data' => $userArray,
            ]);
        }
    }

    /**
     * update
     *
     * Maps HTTP Request Method: PUT
     *
     * Curl
     *      curl -i -H "Accept: application/json" -X PUT -d "username=APIUPDATE" http://localhost:8080/users-rest/id/14/
     *
     * @param mixed $id
     * @return mixed|JsonModel
     */
    public function update($id, $data)
    {
        $user = $this->model->getById($id);
        $user->exchangeArray2($data);

        if (!isset($data['password'])) {
            $user->setPassword(null);
        }

        $this->form->bind($user);
        $this->form->getInputFilter()->get('password')->setAllowEmpty(true);

        if ($this->form->isValid()) {
            $formData = $this->form->getData();

            $data['id']         = $formData->getId();
            $data['username']   = $formData->getUsername();
            $data['email']      = $formData->getEmail();
            $data['password']   = $formData->getPassword();
            $data['role']       = $formData->getRole();
            $data['date']       = $formData->getDate();

            $id = $this->model->update($data);

            // We cannot call $this->get($id) because the request method now is POST instead of GET
            $user       = $this->model->getById($id);
            $userArray  = $user->getArrayCopy();

            return new JsonModel([
                'data' => $userArray,
            ]);
        }

        return new JsonModel([
            'error' => true,
        ]);
    }

    /**
     * delete
     *
     * Maps HTTP Request Method: DELETE
     *
     * Curl
     *      curl -i -H "Accept: application/json" -X DELETE http://localhost:8080/users-rest/id/?/
     *
     * @param mixed $id
     * @return mixed|JsonModel
     */
    public function delete($id)
    {
        $this->model->delete($id);

        return new JsonModel([
            'data' => 'deleted',
        ]);
    }
}

