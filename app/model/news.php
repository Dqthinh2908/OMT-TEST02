<?php
namespace app\model;

use app\database\DataBase;
use PDO;

class news extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataNews()
    {
        $data = [];
        $sql = "SELECT `posts`.`id`, `posts`.`user_id`, `posts`.`title` ,`posts`.`image`, `posts`.`content`,`user`.`name`,`user`.`id` as `idAuthor`  FROM `posts` INNER JOIN `user` ON `posts`.`user_id` = `user`.`id`";
        $stmt = $this->db->prepare($sql);
        if($stmt)
        {
            if($stmt->execute())
            {
                if($stmt->rowCount()> 0){
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            $stmt->closeCursor();
        }
        return $data;
    }
    public function addNews($user_id,$titleNews,$nameImageNews,$contentNews)
    {
        $deletedAt = null;
        $updatedAt = null;
        $createdAt = date('y-m-d H:i:s');
        $flagcheck = false;
        $sql = "INSERT INTO `posts`(`user_id`, `title`, `image`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES (:user_ids,:titleName,:logoImageNews,:content,:created_at,:updated_at,:deleted_at)";
        $stmt = $this->db->prepare($sql);
        
        if($stmt)
        {
            $stmt->bindParam(':user_ids',$user_id,PDO::PARAM_INT);
            $stmt->bindParam(':titleName',$titleNews,PDO::PARAM_STR);
            $stmt->bindParam(':logoImageNews',$nameImageNews,PDO::PARAM_STR);
            $stmt->bindParam(':content',$contentNews,PDO::PARAM_STR);
            $stmt->bindParam(':created_at',$createdAt,PDO::PARAM_STR);
            $stmt->bindParam(':updated_at',$updatedAt,PDO::PARAM_STR);
            $stmt->bindParam(':deleted_at',$deletedAt,PDO::PARAM_STR);
            if($stmt->execute())
            {
                $flagcheck = true;
                $stmt->closeCursor();
            }
        
        }
        return $flagcheck;
    }

    public function getDataPostById($id = 0)
    {
        $data = [];
        $sql = "SELECT `posts`.`id`, `posts`.`user_id`, `posts`.`title` ,`posts`.`image`, `posts`.`content`,`user`.`name`,`user`.`id` as `idAuthor`  FROM `posts` 
        INNER JOIN `user` ON `posts`.`user_id` = `user`.`id` 
        WHERE `posts`.`id` = :id" ;
        $stmt = $this->db->prepare($sql);
        if($stmt)
        {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if($stmt->execute())
            {
                if($stmt->rowCount() > 0)
                {
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                }
                $stmt->closeCursor();        
            }   
        }
        return $data;
    }
    public function updateDataNews($titleNews,$contentNews,$nameImage,$selectAuthor,$id)
    {
        $flagcheck = false;
        $updatedAt = date("Y-m-d H:i:s");
        $sql = "UPDATE `posts` SET `user_id`=:user_ids,`title`=:title,`image`=:images,`content`=:content,`updated_at`=:updated_at WHERE `id` = :id";
        $stmt = $this->db->prepare($sql);

        if($stmt)
        {
            $stmt->bindParam(':user_ids',$selectAuthor,PDO::PARAM_INT);
            $stmt->bindParam(':title',$titleNews,PDO::PARAM_STR);
            $stmt->bindParam(':images',$nameImage,PDO::PARAM_STR);
            $stmt->bindParam(':updated_at',$updatedAt,PDO::PARAM_STR);
            $stmt->bindParam(':content',$contentNews,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute())
            {
                $flagcheck = true;
                $stmt->closeCursor();
            }

        }
        return $flagcheck;
    }
    public function deleteDataNews($id)
    {
        $flagcheck = false;
        $sql = "DELETE FROM `posts` WHERE `id`=:id";
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