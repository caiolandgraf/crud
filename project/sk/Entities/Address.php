<?php
/**
 * Created by PhpStorm.
 * User: caiol
 * Date: 05/03/2019
 * Time: 13:50
 */

namespace SK\Entities;


/**
 * Class Address
 * @package SK\Entities\User
 */
class Address
{
    /**
     * @var
     */
    private $user_id;
    /**
     * @var
     */
    private $address_id;
    /**
     * @var null
     */
    private $street;
    /**
     * @var null
     */
    private $address_number;
    /**
     * @var null
     */
    private $address_complement;

    /**
     * Address constructor.
     * @param null $user_id
     * @param null $street
     * @param null $address_number
     * @param null $address_complement
     */
    public function __construct(
        $user_id = null,
        $street = null,
        $address_number = null,
        $address_complement = null)
    {
        $this->user_id = $user_id;
        $this->street = $street;
        $this->address_number = $address_number;
        $this->address_complement = $address_complement;
    }

    /**
     * @return mixed
     */
    public function UserGetId()
    {
        return $this->user_id;
    }

    /**
     * @param $user_id
     */
    public function UserSetId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getAddressId()
    {
        return $this->address_id;
    }

    /**
     * @param $address_id
     */
    public function setAddressId($address_id): void
    {
        $this->address_id = $address_id;
    }

    /**
     * @return null
     */
    public function getAddressStreet()
    {
        return $this->street;
    }


    /**
     * @param $street
     */
    public function setAddressStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return null
     */
    public function getAddressNumber()
    {
        return $this->address_number;
    }

    /**
     * @param $address_number
     */
    public function setAddressNumber($address_number): void
    {
        $this->address_number = $address_number;
    }

    /**
     * @return null
     */
    public function getAddressComplement()
    {
        return $this->address_complement;
    }

    /**
     * @param $address_complement
     */
    public function setAddressComplement($address_complement): void
    {
        $this->address_complement = $address_complement;
    }
}