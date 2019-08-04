<?php

namespace App\Listeners;

use App\Events\ReviewRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\DataProvider\Database\AddReviewIndexDataProvider;

class ReviewIndexCreator implements ShouldQueue
{
    use InteractsWithQueue;

    private $provider;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(AddReviewIndexDataProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Handle the event.
     *
     * @param  ReviewRegistered  $event
     * @return void
     */
    public function handle(ReviewRegistered $event)
    {
        $this->provider->addReview(
            $event->getId(),
            $event->getTitle(),
            $event->getContent(),
            $event->getCreatedAt(),
            $event->getTags(),
            $event->getUserId()
        );
    }
}
