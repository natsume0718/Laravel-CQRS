<?php

namespace App\DataProvider;

interface AddReviewIndexProviderInterface
{
    public function addReview(
        int $id,
        string $titile,
        string $content,
        srting $epoch,
        array $tags,
        int $user_id
    ): array;
}
