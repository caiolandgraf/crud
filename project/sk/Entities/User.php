<?php
/**
 * Created by PhpStorm.
 * User: pizelli
 * Date: 03/03/19
 * Time: 13:20
 */

namespace SK\Entities;

/**
 * Class User
 * @package SK\Entities
 */
class User
{
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $gender;
    private $document;
    private $birthday;

    /**
     * User constructor.
     * @param null $first_name
     * @param null $last_name
     * @param null $email
     * @param null $gender
     * @param null $document
     * @param null $birthday
     */
    public function __construct(
        $first_name = null,
        $last_name = null,
        $email = null,
        $gender = null,
        $document = null,
        $birthday = null)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->gender = $gender;
        $this->document = $document;
        $this->birthday = $birthday;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }


    /**
     * @param $first_name
     */
    public function setFirstName($first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return null
     */
    public function getLastName()
    {
        return $this->last_name;
    }


    /**
     * @param $last_name
     */
    public function setLastName($last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * @param $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }


    /**
     * @return null
     */
    public function getGender()
    {
        return $this->gender;
    }


    /**
     * @param $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return null
     */
    public function getDocument()
    {
        return $this->document;
    }


    /**
     * @param $document
     */
    public function setDocument($document): void
    {
        $this->document = $document;
    }

    /**
     * @return bool|string
     */
    public function getBirthday()
    {
        return dateConvert($this->birthday);
    }


    /**
     * @param $birthday
     */
    public function setBirthday($birthday): void
    {
        $this->birthday = $birthday;
    }
}