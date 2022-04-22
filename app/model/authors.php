<?php
namespace app\model;
use app\database\Database;
use PDO;
class authors extends Database
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getDataAuthors()
    {
        $data = [];
        $sql = "SELECT * FROM user";
        $stmt = $this->db->prepare($sql);

        if($stmt)
        {
            if($stmt->execute())
            {
                if($stmt->rowCount()>0)
                {
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                
            }
            $stmt->closeCursor();
        }
        return $data;
    }
    public function addAuthor($nameAuthor,$emailAuthor,$phoneAuthor,$addressAuthor,$birthdayAuthor,$genderAuthor)
    {
        $flagcheck = false;
        $deleted_at = null;
        $updated_at = null;
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `user`(`name`, `email`, `phone`, `address`, `birthday`, `gender`, `created_at`, `deleted_at`, `updated_at`) VALUES (:names,:email,:phone,:addressAuthor,:birthdayAuthor,:gender,:created_at,:deleted_at,:updated_at)";
        $stmt = $this->db->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(':names',$nameAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':email',$emailAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':phone',$phoneAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':addressAuthor',$addressAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':birthdayAuthor',$birthdayAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':gender',$genderAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':created_at',$created_at,PDO::PARAM_STR);
            $stmt->bindParam(':deleted_at',$deleted_at,PDO::PARAM_STR);
            $stmt->bindParam(':updated_at',$updated_at,PDO::PARAM_STR);
            if($stmt->execute()){
                $flagcheck = true;
                $stmt->closeCursor();
            }
        }
        return $flagcheck;
    }

    public function getDataAuthorById($id)
    {
        $data=[];
        $sql = "SELECT * FROM `user` WHERE `id`=:id";
        $stmt = $this->db->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute())
            {
                if($stmt->rowCount()>0)
                {
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                }
                $stmt->closeCursor();
            }
        }
        return $data;
    }
    public function updateAuthorDataById($nameAuthor,$emailAuthor,$phoneAuthor,$addressAuthor,$birthdayAuthor, $genderAuthor,$id)
    {
        $flagcheck = false;
        $created_at = date('Y-m-d H:i:s');
        $sql = "UPDATE `user` SET `name`= :names,`email`=:email,`phone`=:phone,`address`=:addressAuthor,`birthday`=:birthdayAuthor,`gender`=:gender,`created_at`=:created_at WHERE `id`=:id";
        $stmt = $this->db->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(':names',$nameAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':email',$emailAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':phone',$phoneAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':addressAuthor',$addressAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':birthdayAuthor',$birthdayAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':gender',$genderAuthor,PDO::PARAM_STR);
            $stmt->bindParam(':created_at',$created_at,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute())
            {
                $flagcheck = true;
                $stmt->closeCursor();
            }

        }
        return $flagcheck;

    }
    public function deleteAuthor($id)
    {
        $flagcheck = false;
        $sql = "DELETE FROM `user` WHERE `id`=:id";
        $stmt = $this->db->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute())
            {
                $flagcheck = true;
                $stmt->closeCursor();
            }
        }
        return $flagcheck;
    }
}