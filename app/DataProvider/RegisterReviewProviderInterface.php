<?php

namespace App\DataProvider;

interface RegisterReviewProviderInterface
{
    public function registerReview(
        string $titile,
        string $content,
        int $user_id,
        array $tags = [],
        string $created_at
    ): int;
}
