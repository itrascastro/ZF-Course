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

namespace User\Model;


class User 
{
    private $_id;
    private $_email;
    private $_password;
    private $_role;
    private $_date;

    function __construct($_id = null, $_email = null, $_password = null, $_role = null, $_date = null)
    {
        $this->_id = $_id;
        $this->_email = $_email;
        $this->_password = $_password;
        $this->_role = $_role;
        $this->_date = $_date;
    }

    /**
     * exchangeArray
     *
     * This method is required to work with TableGateWay
     *
     * @param $data
     */
    public function exchangeArray($data)
    {
        $this->_id          = (!empty($data['id'])) ? $data['id'] : null;
        $this->_email       = (!empty($data['email'])) ? $data['email'] : null;
        $this->_password    = (!empty($data['password'])) ? $data['password'] : null;
        $this->_role        = (!empty($data['role'])) ? $data['role'] : null;
        $this->_date        = (!empty($data['date'])) ? $data['date'] : null;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->_role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->_role = $role;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }
}