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

namespace MyString\Model;


class MyStringModel
{
    private $cad1;
    private $cad2;
    private $result;

    function __construct($cad1 = null, $cad2 = null, $result = null)
    {
        $this->cad1 = $cad1;
        $this->cad2 = $cad2;
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getCad1()
    {
        return $this->cad1;
    }

    /**
     * @param mixed $cad1
     */
    public function setCad1($cad1)
    {
        $this->cad1 = $cad1;
    }

    /**
     * @return mixed
     */
    public function getCad2()
    {
        return $this->cad2;
    }

    /**
     * @param mixed $cad2
     */
    public function setCad2($cad2)
    {
        $this->cad2 = $cad2;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    public function concatenate()
    {
        $this->result = $this->cad1 . $this->cad2;
    }

    public function find()
    {
        $this->result = strpos($this->cad2, $this->cad1);
    }

}