<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DataProvider\RegisterReviewProviderInterface;
use Illuminate\Support\Carbon;

class RegisterAction extends Controller
{
    private $provider;
    public function __construct(RegisterReviewProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(Request $request)
    {
        $this->provider->registerReview(
            $request->get('title'),
            $request->get('content'),
            $request->get('user_id', 1),
            $request->get('tags'),
            Carbon::now()->toDateString()
        );
        return response('', Response::HTTP_OK);
    }
}
