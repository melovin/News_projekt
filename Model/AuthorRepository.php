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
    public function deleteAuthor($id)
    {
        $sql = 'DELETE FROM tbAuthors
                WHERE Id = :id';
        $params = [
            ':id' => $id,
        ];

        return $this->db->delete($sql, $params);
    }
    public function addAuthor($autName, $autSurname, $description)
    {
        $sql = 'INSERT INTO tbAuthors 
                SET Name = :name, Surname = :surname, AuthDesc = :des';
        $params = [
            ':name' => $autName,
            ':surname' => $autSurname,
            ':des' => $description,
        ];

        return $this->db->insert($sql, $params);
    }
    public function updateAuthor($id, $autName, $autSurname, $description)
    {
        $sql = 'UPDATE tbAuthors
                SET Name = :name, Surname = :surname, AuthDesc = :des
                WHERE Id = :id';
        $params = [
            ':id' => $id,
            ':name' => $autName,
            ':surname' => $autSurname,
            ':des' => $description,
        ];

        return $this->db->update($sql, $params);
    }

}