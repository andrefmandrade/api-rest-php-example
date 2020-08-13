<?php


namespace Api\Entity;


class User
{
    const fields = ["name", "email", "password"];
    const selector = ["id", "name", "email"];

    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $created_at
     */
    private $created_at;

    /**
     * @var string $updated_at
     */
    private $updated_at;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     * @return User
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     * @return User
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public static function isValidUser($data)
    {

        foreach (self::fields as $field) {
            if(!isset($data->$field)) return "Required value ($field) is not set";
            else if(empty($data->$field)) return "Required value ($field) is empty";
        }

        if(strlen($data->password) < 6) return "Password is required at least six digits";

        if((!filter_var($data->email, FILTER_VALIDATE_EMAIL))) return "Invalid e-mail address: $data->email";

        return true;
    }

    public static function encryptPassword($password)
    {
        $options = [
            "cost" => 12
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public static function isValidSelector($needle)
    {
        return in_array($needle, self::selector);
    }
}