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
    public function addAuthor($autName, $autSurname, $description, $email, $isAdmin)
    {
        $sql = 'SELECT * FROM tbAuthors WHERE Email = :email';

        $params = [
            ':email' => $email,
        ];

        $user = $this->db->selectSingle($sql, $params);

        if ($user != false) {
            // email již existuje
            die('Účet s touto e-mailovou adresou již existuje.');
        }
        $sql = 'INSERT INTO tbAuthors 
                SET Name = :name, Surname = :surname, AuthDesc = :des, Email = :email, IsAdmin = :isAdmin';
        $params = [
            ':name' => $autName,
            ':surname' => $autSurname,
            ':des' => $description,
            ':email' => $email,
            ':isAdmin' => $isAdmin,
        ];

        return $this->db->insert($sql, $params);
    }
    public function updateAuthor($id, $autName, $autSurname, $description, $isAdmin, $email)
    {

        $sql = 'UPDATE tbAuthors
                SET Name = :name, Surname = :surname, AuthDesc = :des, IsAdmin = :isAdmin, Email = :email
                WHERE Id = :id';
        $params = [
            ':id' => $id,
            ':name' => $autName,
            ':surname' => $autSurname,
            ':des' => $description,
            ':isAdmin' => $isAdmin,
            ':email' => $email,
        ];

        return $this->db->update($sql, $params);
    }

}