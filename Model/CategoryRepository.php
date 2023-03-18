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

}