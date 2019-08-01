<?php

namespace App\Events;

use Illuminate\Support\Carbon;

final class ReviewRegistered
{

    private $id;
    private $titile;
    private $content;
    private $user_id;
    private $tags = [];
    private $created_at;
    private $updated_at;
    private $deleted_at;



    public function __construct(
        int $id,
        string $titile,
        string $content,
        int $user_id,
        array $tags,
        string $created_at,
        string $updated_at,
        string $deleted_at
    ) {
        $this->id = $id;
        $this->titile = $titile;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->tags = $tags;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
    }

    public function getTitle()
    {
        return $this->titile;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getTags()
    {
        return $this->tags;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function getDeletedAt()
    {
        return $this->deleted_at;
    }
}
