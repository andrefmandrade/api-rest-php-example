<?php


namespace Api\Dao;

use Api\Entity\User;
use PDO;

class UserDao extends User
{
    use Connect;

    public function create()
    {
        $sql = "INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :password, :created_at)";

        $stmt = $this->getConnect()->prepare($sql);
        $stmt->bindValue(":name", $this->getName());
        $stmt->bindValue(":email", $this->getEmail());
        $stmt->bindValue(":password", $this->getPassword());
        $stmt->bindValue(":created_at", $this->getCreatedAt());

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function read($selectorType = null, $selectorValue = null)
    {
        $isFetchAll = is_null($selectorType) && is_null($selectorValue);
        if($isFetchAll) $sql = "SELECT * FROM users";
        else $sql = "SELECT * FROM users WHERE $selectorType = :$selectorType";

        $stmt = $this->getConnect()->prepare($sql);
        if(!$isFetchAll)$stmt->bindValue(":$selectorType", $selectorValue);
        $stmt->execute();

        if($isFetchAll) return $stmt->fetchAll(PDO::FETCH_ASSOC);
        else return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update()
    {
        $sql = "UPDATE users SET name = :name, email = :email, password = :password, updated_at = :updated_at WHERE id = :id";

        $stmt = $this->getConnect()->prepare($sql);
        $stmt->bindValue(":id", $this->getId());
        $stmt->bindValue(":name", $this->getName());
        $stmt->bindValue(":email", $this->getEmail());
        $stmt->bindValue(":password", $this->getPassword());
        $stmt->bindValue(":updated_at", $this->getUpdatedAt());

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function delete()
    {
        $sql = "DELETE FROM users WHERE id = :id";

        $stmt = $this->getConnect()->prepare($sql);
        $stmt->bindValue(":id", $this->getId());

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}