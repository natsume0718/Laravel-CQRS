<?php

namespace App\DataProvider\Database;

use App\DataProvider\RegisterReviewProviderInterface;
use Illuminate\Support\Facades\DB;
use App\DataProvider\Database\Review;
use App\DataProvider\Database\Tag;
use App\DataProvider\Database\ReviewTag;
use App\Events\ReviewRegistered;

class RegisterReviewDataProvider implements RegisterReviewProviderInterface
{
    public function registerReview(
        string $titile,
        string $content,
        int $user_id,
        array $tags = [],
        string $created_at
    ): int {
        return DB::transaction(function () use ($titile, $content, $user_id, $tags, $created_at) {
            $review_id = $this->createReview($titile, $content, $user_id, $created_at);
            foreach ($tags as $tag) {
                $this->createReviewTag($review_id, $this->createTag($tag, $created_at), $created_at);
            }
            \event(new ReviewRegistered(
                $review_id,
                $titile,
                $content,
                $user_id,
                $tags,
                $created_at
            ));
            return $review_id;
        });
    }

    public function createReview(string $title, string $content, int $user_id, string $created_at)
    {
        $result = Review::firstOrCreate(
            ['user_id' => $user_id, 'title' => $title],
            ['content' => $content, 'created_at' => $created_at]
        );
        return $result->id;
    }

    public function createTag(string $name, string $created_at)
    {
        $result = Tag::firstOrCreate(['tag_name' => $name], ['created_at' => $created_at]);
        return $result->id;
    }

    public function createReviewTag(int $review_id, int $tag_id, string $created_at)
    {
        ReviewTag::firstOrCreate(['review_id' => $review_id, 'tag_id' => $tag_id], ['created_at' => $created_at]);
    }
}
