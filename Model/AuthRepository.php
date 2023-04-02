<?php

class AuthRepository extends BaseRepository
{
    public function Register($name, $surname, $email, $passwd, $authDesc)
    {
        $sql = 'INSERT INTO tbAuthors SET Email = :email, Password = :password, Name = :name, Surname = :surname, AuthDesc = :desc, IsAdmin = false';

        $passwordHash = password_hash($passwd, PASSWORD_DEFAULT);

        $params = [
            ':email' => $email,
            ':password' => $passwordHash,
            ':name' => $name,
            ':surname' => $surname,
            ':desc' => $authDesc,
        ];
        return $this->db->insert($sql, $params);
    }
    public function Login($email, $passwd)
    {
        session_start();
        $sql = 'SELECT * FROM tbAuthors WHERE Email = :email';

        $params = [
            ':email' => $email,
        ];

        $user = $this->db->selectSingle($sql, $params);

        if ($user === false) {
            // email je chybny
            die('chybne prihlasovaci udaje');
        }

        $passwordCorrect = password_verify($passwd, $user['Password']);

        if (!$passwordCorrect) {
            // heslo je chybne
            die('chybne prihlasovaci udaje');
        }

        // prihlasen
        unset($user['Password'], $user[2]);
        $_SESSION['user'] = $user;
    }
    public function Check($idAutor, $idPost)
    {
        $sql = 'SELECT * FROM tbPost p 
                WHERE p.Id = :id';
        $params = [
            ':id' => $idPost,
        ];
        $post =  $this->db->selectSingle($sql, $params);

        return $idAutor == $post['IdAuthor'];

    }
}