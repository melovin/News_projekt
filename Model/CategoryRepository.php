<?php

class CategoryRepository extends BaseRepository
{
    public function getCategories()
    {
        $sql = 'SELECT * FROM tbCategories';
        return $this->db->select($sql);
    }
    public function getCategory($catId)
    {
        $sql = 'SELECT * FROM tbCategories c
                WHERE c.Id = :id';
        $params = [
            ':id' => $catId,
        ];
        return $this->db->selectSingle($sql, $params);
    }
    public function deleteCategory($id)
    {
        $sql = 'DELETE FROM tbCategories
                WHERE Id = :id';
        $params = [
            ':id' => $id,
        ];

        return $this->db->delete($sql, $params);
    }
    public function addCategory($catName, $description)
    {
        $sql = 'INSERT INTO tbCategories 
                SET CatName = :catName, Description = :des';
        $params = [
            ':catName' => $catName,
            ':des' => $description,
        ];

        return $this->db->insert($sql, $params);
    }
    public function updateCategory($id, $catName, $description)
    {
        $sql = 'UPDATE tbCategories
                SET CatName = :catName, Description = :des
                WHERE Id = :id';
        $params = [
            ':id' => $id,
            ':catName' => $catName,
            ':des' => $description,
        ];

        return $this->db->update($sql, $params);
    }

}