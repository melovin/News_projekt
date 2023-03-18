<?php


class AuthorRepository extends BaseRepository
{
    public function getAuthors()
    {
        $sql = 'SELECT * FROM tbAuthors';
        return $this->db->select($sql);
    }

    public function getAuthor($authId)
    {
        $sql = 'SELECT * FROM tbAuthors a
                WHERE a.Id = :id';
        $params = [
            ':id' => $authId,
        ];
        return $this->db->selectSingle($sql, $params);
    }

}