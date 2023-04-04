<?php


class PostRepository extends BaseRepository
{
    public function getPosts()
    {
        $sql = 'SELECT p.*, a.Id as IdAut, a.Name, a.Surname, c.Id as IdCat, c.CatName FROM tbPost p 
                INNER JOIN tbAuthors a on a.Id = p.IdAuthor
                INNER JOIN tbCategories c on c.Id = p.IdCategory
                WHERE p.Active = true
                ORDER BY p.Date desc ';
        return $this->db->select($sql);
    }
    public function getPostsAdmin()
    {
        $sql = 'SELECT p.*, a.Id as IdAut, a.Name, a.Surname, c.Id as IdCat, c.CatName FROM tbPost p 
                INNER JOIN tbAuthors a on a.Id = p.IdAuthor
                INNER JOIN tbCategories c on c.Id = p.IdCategory
                ORDER BY p.Title ';
        return $this->db->select($sql);
    }
    public function getPost($postId)
    {
        $sql = 'SELECT p.*, a.Id as IdAut, a.Name, a.Surname, c.Id as IdCat, c.CatName FROM tbPost p 
                INNER JOIN tbAuthors a on a.Id = p.IdAuthor
                INNER JOIN tbCategories c on c.Id = p.IdCategory
                WHERE p.Id = :id';
        $params = [
            ':id' => $postId,
        ];
        return $this->db->selectSingle($sql, $params);
    }
    public function getPostsByCat($catId)
    {
        $sql = 'SELECT p.*, a.Id as IdAut, a.Name, a.Surname, c.Id as IdCat, c.CatName FROM tbPost p 
                INNER JOIN tbAuthors a on a.Id = p.IdAuthor
                INNER JOIN tbCategories c on c.Id = p.IdCategory
                WHERE c.Id = :id AND p.Active = true';
        $params = [
            ':id' => $catId,
        ];
        return $this->db->select($sql, $params);
    }
    public function getPostsByAuth($authId)
    {
        $sql = 'SELECT p.*, a.Id as IdAut, a.Name, a.Surname, c.Id as IdCat, c.CatName FROM tbPost p 
                INNER JOIN tbAuthors a on a.Id = p.IdAuthor
                INNER JOIN tbCategories c on c.Id = p.IdCategory
                WHERE a.Id = :id AND p.Active = true';
        $params = [
            ':id' => $authId,
        ];
        return $this->db->select($sql, $params);
    }
    public function getPostsByAuthAdmin($authId)
    {
        $sql = 'SELECT p.*, a.Id as IdAut, a.Name, a.Surname, c.Id as IdCat, c.CatName FROM tbPost p 
                INNER JOIN tbAuthors a on a.Id = p.IdAuthor
                INNER JOIN tbCategories c on c.Id = p.IdCategory
                WHERE a.Id = :id ';
        $params = [
            ':id' => $authId,
        ];
        return $this->db->select($sql, $params);
    }
    public function deletePost($id)
    {
        $sql = 'DELETE FROM tbPost
                WHERE id = :id';
        $params = [
            ':id' => $id,
        ];

        return $this->db->delete($sql, $params);
    }
    public function addPost($catId, $authId, $title, $content, $preview, $activity)
    {
        $sql = 'INSERT INTO tbPost 
                SET IdAuthor = :autId, IdCategory = :catId, Title = :title, Content = :content, Preview = :preview, Active = :activity';
        $params = [
            ':autId' => $authId,
            ':catId' => $catId,
            ':title' => $title,
            ':content' => $content,
            ':preview' => $preview,
            ':activity' => $activity,
        ];

        return $this->db->insert($sql, $params);
    }
    public function updatePost($id, $catId, $authId, $title, $content, $preview, $activity)
    {
        $sql = 'UPDATE tbPost
                SET IdAuthor = :autId, IdCategory = :catId, Title = :title, Content = :content, Preview = :preview, Active = :active
                WHERE Id = :id';
        $params = [
            ':id' => $id,
            ':autId' => $authId,
            ':catId' => $catId,
            ':title' => $title,
            ':content' => $content,
            ':preview' => $preview,
            ':active' => $activity,
        ];

        return $this->db->update($sql, $params);
    }
}