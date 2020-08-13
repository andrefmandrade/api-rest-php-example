<?php


namespace Api\Controller\Perform;

use Api\Dao\UserDao;
use Api\Entity\User;
use stdClass;

class UserController
{
    public static function create(stdClass $data)
    {
        $isValidOrInvalidField = User::isValidUser($data);
        if(!is_bool($isValidOrInvalidField)) {
            http_response_code(400);
            return ["error" => ["message" => $isValidOrInvalidField]];
        }
        $user = new UserDao();

        $userExists = $user->read("email", $data->email);
        if(is_array($userExists)) {
            http_response_code(400);
            return ["error" => ["message" => "E-mail already registered"]];
        }

        $passwordHash = User::encryptPassword($data->password);
        $user->setName($data->name)->setEmail($data->email)->setPassword($passwordHash)->setCreatedAt(date("Y-m-d H:i:s"));

        return $user->create();
    }

    public static function update(stdClass $data)
    {
        //Let's assume we get all user's fields from our front-end application (but we still validate the required fields)
        $isValidOrInvalidField = User::isValidUser($data);
        if(!is_bool($isValidOrInvalidField)) {
            http_response_code(400);
            return ["error" => ["message" => $isValidOrInvalidField]];
        }

        $user = new UserDao();

        //Let's assume we receive the user id from our front-end application
        $userExists = $user->read("id", $data->id);
        if(!is_array($userExists)) {
            http_response_code(400);
            return ["error" => ["message" => "User not registered"]];
        }

        //Check if sent e-mail is already registered (duplicity purposes) since e-mail is unique
        $userExists = $user->read("email", $data->email);
        if(is_array($userExists) AND (int) $userExists['id'] !==  $data->id) {
            http_response_code(400);
            return ["error" => ["message" => "E-mail already in use"]];
        }

        //Won't do any fancy JWT validation on this project so i'll just update User info on the go
        $passwordHash = User::encryptPassword($data->password);
        $user->setName($data->name)->setEmail($data->email)->setPassword($passwordHash)->setUpdatedAt(date("Y-m-d H:i:s"))->setId($data->id);

        return $user->update();
    }

    public static function delete(stdClass $data)
    {
        if(!isset($data->id) || empty($data->id)) {
            http_response_code(400);
            return ["error" => ["message" => "User id is either not set or empty"]];
        }

        $user = new UserDao();

        $userExists = $user->read("id", $data->id);
        if(!is_array($userExists)) {
            http_response_code(400);
            return ["error" => ["message" => "User not found"]];
        }

        $user->setId($data->id);

        return $user->delete();
    }

    public static function read(stdClass $data)
    {
        $user = new UserDao();

        if(count((array) $data)) {
            if(!isset($data->selectorType) || empty($data->selectorType)) {
                http_response_code(400);
                return ["error" => ["message" => "Provide a selector"]];
            }

            if(!isset($data->selectorValue) || empty($data->selectorValue)) {
                http_response_code(400);
                return ["error" => ["message" => "Provide the selector value"]];
            }

            $isValidSelector = User::isValidSelector($data->selectorType);

            if(!$isValidSelector) {
                http_response_code(400);
                return ["error" => ["message" => "Provide a valid selector"]];
            }

            return $user->read($data->selectorType, $data->selectorValue);
        }

        return $user->read();
    }
}