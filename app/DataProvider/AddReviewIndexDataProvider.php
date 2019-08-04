<?php

namespace App\DataProvider;

use App\DataProvider\AddReviewIndexProviderInterface;
use App\Foundation\ElasticsearchClient;

class AddReviewIndexDataProvider implements AddReviewIndexProviderInterface
{
    private $client;

    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

    public function addReview(
        int $id,
        string $titile,
        string $content,
        srting $epoch,
        array $tags,
        int $user_id
    ) {
        $params = [
            'index' => 'reviews',
            'type' => 'reviews',
            'id' => sprintf('reviews:%s', $id),
            'body' => [
                'review_id' => $id,
                'title' => $titile,
                'content' => $content,
                'tags' => array_map(function (string $str) {
                    return ['tag_name' => $str];
                }, $tags),
                'user_id' => $user_id,
                'created_at' => $epoch
            ]
        ];
        return $this->client->client()->index($params);
    }
}
