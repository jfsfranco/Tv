<?php

namespace App\Http\Controllers;

use App\TvShow\Application\Exception\EmptyArgumentException;
use App\TvShow\Application\Query\TvShowQuery;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\TvShow\Application\Factory\ErrorFactory;
use App\TvShow\Application\QueryHandler\QueryHandler;

final class TvShowController extends Controller
{
    /** @var QueryHandler */
    private $tvShowQueryHandler;

    /** @var ErrorFactory */
    private $errorResponseFactory;

    public function __construct(QueryHandler $tvShowQueryHandler, ErrorFactory $errorResponseFactory)
    {
        $this->tvShowQueryHandler = $tvShowQueryHandler;
        $this->errorResponseFactory = $errorResponseFactory;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->guardAgainstInvalidTvShow($request);

            $response = $this->tvShowQueryHandler->handle(new TvShowQuery($request->get("q")));

            if (!$response) {
                return response()->json("No result found",  Response::HTTP_NOT_FOUND);
            }

            return response()->json($response, Response::HTTP_OK );

        } catch (Throwable $throwable) {
            return $this->errorResponseFactory->createResponseForException($throwable);
        }
    }

    private function guardAgainstInvalidTvShow(Request $request): void
    {
        if (!$request->get("q")) {
            throw new EmptyArgumentException();
        }
    }
}
