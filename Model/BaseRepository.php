<?php



abstract class BaseRepository
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

}