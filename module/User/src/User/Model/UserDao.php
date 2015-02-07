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

use User\Model\Interfaces\UserDaoInterface;
use Zend\Db\Adapter\Adapter;

/**
 * Class UserDao
 *
 * Data Access Object for User
 *
 */
class UserDao implements UserDaoInterface
{
    /**
     * @var Adapter
     */
    private $_db;

    /**
     * @param Adapter $_db
     */
    function __construct(Adapter $_db)
    {
        $this->_db = $_db;
    }

    public function findAll()
    {
        $resultSet = $this->_db->query('SELECT * FROM users', Adapter::QUERY_MODE_EXECUTE);
        $users = new \ArrayObject();
        $count = $resultSet->count();

        for ($i = 0; $i < $count; $i++) {
            $row = $resultSet->current();
            $user = new User($row->id, $row->email, $row->password, $row->role, $row->date);
            $users->append($user);
            $resultSet->next();
        }

        return $users;
    }

    /**
     * getById
     *
     * current() is not using FETCH_ASSOC as it is supposed, it is using FETCH_ARRAY !!!
     *
     * @param $id
     *
     * @return User
     */
    public function getById($id)
    {
        $stmt = $this->_db->createStatement('SELECT * FROM users WHERE id = ?');
        $resultSet = $stmt->execute([$id]);
        $row = $resultSet->current();

        return new User($row['id'], $row['email'], $row['password'], $row['role'], $row['date']);
    }

    public function save($data)
    {
        $stmt = $this->_db->createStatement('INSERT INTO users VALUES (NULL, ?, ?, ?, NULL)');
        $stmt->execute([$data['email'], $data['password'], $data['role']]);
    }

    public function delete($id)
    {
        $stmt = $this->_db->createStatement('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function update($data)
    {
        $stmt = $this->_db->createStatement('UPDATE users SET email = ?, password = ?, role = ? WHERE id = ?');
        $stmt->execute([$data['email'], $data['password'], $data['role'], $data['id']]);
    }
}