<?php
/**
 * Created by PhpStorm.
 * User: caiol
 * Date: 05/03/2019
 * Time: 13:55
 */

namespace SK\Models;


use SK\DB\Sql;
use SK\Entities\Address as AddressEntity;
use SK\Entities\User;

/**
 * Class Address
 * @package SK\Models
 */
class Address
{
    /**
     * @param int $address_id
     * @return mixed
     */
    public static function AddressFindId(int $address_id)
    {
        $db = new Sql();
        return $db->select("SELECT * FROM users_address WHERE id = :id", ['id' => $address_id])[0];
    }

    public static function AddressByUser(array $user)
    {
        $db = new Sql();
        return $db->select("SELECT * FROM users_address WHERE user_id = :id", ['id' => $user['id']])[0];
    }

    /**
     * @return array
     */
    public static function AddressGetAll(): array
    {
        $db = new Sql();
        return $db->select("SELECT * FROM users_address ORDER BY user_id");
    }

    /**
     * @param AddressEntity $address
     * @return AddressEntity
     */
    public static function Insert(AddressEntity $address): AddressEntity
    {
        if ($address != null) {
            $db = new Sql();
            $db->query("INSERT INTO users_address 
                (user_id, street, number, complement) 
                VALUES 
                (:user_id, :street, :number, :complement);"
                , [
                    'user_id' => $address->UserGetId(),
                    'street' => $address->getAddressStreet(),
                    'number' => $address->getAddressNumber(),
                    'complement' => $address->getAddressComplement()
                ]);
            return $address;
        }
    }

    /**
     * @param AddressEntity $address
     * @return UserEntity
     */
    public static function Update(AddressEntity $address): AddressEntity
    {
        if ($address != null) {
            $db = new Sql();
            $db->query("UPDATE users_address SET 
                user_id =  :user_id,
                street = :street, 
                number = :number, 
                complement = :complement
                WHERE id = :id;"
                , [
                    'user_id' => $address->UserGetId(),
                    'id' => $address->getAddressId(),
                    'street' => $address->getAddressStreet(),
                    'number' => $address->getAddressNumber(),
                    'complement' => $address->getAddressComplement()
                ]);
            return $address;
        }
    }

    /**
     * @param int $id
     */
    public static function Delete(int $id)
    {
        if ($id != null) {
            $db = new Sql();
            $db->query("DELETE FROM users_address WHERE id = :id;", [
                'id' => $id
            ]);
        }
    }

    public static function DeleteByUser(int $id)
    {
        if ($id != null) {
            $db = new Sql();
            $db->query("DELETE FROM users_address WHERE user_id = :id;", [
                'id' => $id
            ]);
        }
    }
}