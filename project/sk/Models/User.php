<?php
/**
 * Created by PhpStorm.
 * User: pizelli
 * Date: 03/03/19
 * Time: 13:15
 */

namespace SK\Models;

use SK\DB\Sql;
use SK\Entities\User as UserEntity;

/**
 * Class User
 * @package SK\Models
 */
class User
{

    /**
     * @param int $id
     * @return mixed
     */
    public static function FindId(int $id)
    {
        $db = new Sql();
        return $db->select("SELECT * FROM users WHERE id = :id", ['id' => $id])[0];
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        $db = new Sql;
        return $db->select("SELECT * FROM users ORDER BY first_name");
    }

    /**
     * @param UserEntity $user
     * @return UserEntity
     */
    public static function Insert(UserEntity $user): UserEntity
    {
        if ($user != null) {
            $db = new Sql();
            $db->query("INSERT INTO users 
                (first_name, last_name, email, gender, document, birthdate) 
                VALUES 
                (:first_name, :last_name, :email, :gender, :document, :birthdate);"
                , [
                    'first_name' => $user->getFirstName(),
                    'last_name' => $user->getLastName(),
                    'email' => $user->getemail(),
                    'gender' => $user->getGender(),
                    'document' => $user->getDocument(),
                    'birthdate' => $user->getBirthday(),
                ]);
            return $user;
        }
    }

    /**
     * @param UserEntity $user
     * @return UserEntity
     */
    public static function Update(UserEntity $user): UserEntity
    {
        if ($user != null) {
            $db = new Sql();
            $db->query("UPDATE users SET  
                first_name = :first_name, 
                last_name = :last_name, 
                email = :email, 
                gender = :gender, 
                document = :document, 
                birthdate = :birthdate 
                WHERE id = :id;"
                , [
                    'id' => $user->getId(),
                    'first_name' => $user->getFirstName(),
                    'last_name' => $user->getLastName(),
                    'email' => $user->getEmail(),
                    'gender' => $user->getGender(),
                    'document' => $user->getDocument(),
                    'birthdate' => $user->getBirthday()
                ]);
            return $user;
        }
    }

    /**
     * @param int $id
     */
    public static function Delete(int $id)
    {
        if ($id != null) {
            $db = new Sql();
            Address::DeleteByUser($id);
            $db->query("DELETE FROM users WHERE id = :id;", [
                'id' => $id
            ]);
        }
    }

}