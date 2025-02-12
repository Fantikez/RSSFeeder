<?php

namespace App\Http\Controllers;

use App\Http\Requests\RssFeedApiUpdateRequest;
use App\Http\Requests\RssFeedSearchRequest;
use App\Http\Requests\RssFeedApiStoreRequest;
use App\Http\Resources\RssFeedResource;
use App\Repositories\RssFeedRepository;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(version="1.0", title="RssFeedApiController", description="Managing api endpoints")
 */
class RssFeedApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * @param RssFeedRepository $rssFeedRepository
     */
    public function __construct(public RssFeedRepository $rssFeedRepository)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/posts",
     *     operationId="getAll",
     *     tags={"List of all post"},
     *     summary="List of post",
     *     description="Return data with all posts",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/post")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     ),
     * )
     */
    public function index(): JsonResponse
    {
        $data = $this->rssFeedRepository->getAll();
        return self::sendResponse(RssFeedResource::collection($data), '');
    }

    /**
     * @OA\Post(
     *      path="/api/posts",
     *      operationId="create",
     *      tags={"Store post"},
     *      summary="Insert post",
     *      description="Insert post",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Data for insert post",
     *          @OA\JsonContent(
     *             ref="#/components/schemas/postStore"
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/post")
     *          ),
     *      ),
     *     @OA\Response(
     *           response=422,
     *           description="return error message",
     *           @OA\JsonContent(
     *               type="array",
     *               @OA\Items(ref="#/components/schemas/error")
     *           ),
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="return error message"
     *      ),
     *  )
     * Store a newly created resource in storage.
     */
    public function store(RssFeedApiStoreRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $post = $this->rssFeedRepository->store($request->validated());
            DB::commit();
            return self::sendResponse(new RssFeedResource($post), 'Post created successfully.', 201);
        } catch (\Exception $exception) {
            return self::rollback($exception);
        }
    }

    /**
     * @OA\Get(
     *       path="/api/posts/{id}",
     *       operationId="getById",
     *       tags={"Show post by id"},
     *       summary="Get specigied post",
     *       description="Get specigied post",
     *       @OA\Parameter(
     *           name="id",
     *           in="path",
     *           required=true,
     *           description="ID",
     *           @OA\Schema(type="integer", example=43)
     *       ),
     *       @OA\Response(
     *           response=200,
     *           description="Success",
     *           @OA\JsonContent(
     *               type="array",
     *               @OA\Items(ref="#/components/schemas/postGet")
     *           ),
     *       ),
     *       @OA\Response(
     *           response=500,
     *           description="return error message"
     *       ),
     *   )
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->rssFeedRepository->getById($id);
        return self::sendResponse(new RssFeedResource($data), '');
    }

    /**
     * @OA\Patch (
     *        path="/api/posts/{id}",
     *        operationId="update",
     *        tags={"Update post by id"},
     *        summary="Update post by id",
     *        description="Update post by id",
     *        @OA\Parameter(
     *            name="id",
     *            in="path",
     *            required=true,
     *            description="ID",
     *            @OA\Schema(type="integer", example=43)
     *        ),
     *        @OA\RequestBody(
     *            required=true,
     *            description="Data for insert post",
     *            @OA\JsonContent(
     *               ref="#/components/schemas/postStore"
     *            ),
     *        ),
     *        @OA\Response(
     *            response=200,
     *            description="Success",
     *            @OA\JsonContent(
     *                type="array",
     *                @OA\Items(ref="#/components/schemas/update")
     *            ),
     *        ),
     *       @OA\Response(
     *             response=422,
     *             description="return error message",
     *             @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/error")
     *             ),
     *         ),
     *        @OA\Response(
     *            response=500,
     *            description="return error message"
     *        ),
     *    )
     * Update the specified resource in storage.
     */
    public function update(RssFeedApiUpdateRequest $request, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = $this->rssFeedRepository->update($id, $request->validated());
            DB::commit();
            return self::sendResponse($data, 'Post updated successfully.', 200);
        }catch (\Exception $exception){
            return self::rollback($exception);
        }
    }

    /**
     * @OA\Delete (
     *         path="/api/posts/{id}",
     *         operationId="delete",
     *         tags={"Delete post by id"},
     *         summary="Delete post by id",
     *         description="Delete post by id",
     *         @OA\Parameter(
     *             name="id",
     *             in="path",
     *             required=true,
     *             description="ID",
     *             @OA\Schema(type="integer", example=43)
     *         ),
     *         @OA\Response(
     *             response=200,
     *             description="Success",
     *             @OA\JsonContent(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/delete")
     *             ),
     *         ),
     *         @OA\Response(
     *             response=500,
     *             description="return error message"
     *         ),
     *     )
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->rssFeedRepository->delete($id);

        return self::sendResponse(true, 'Post deleted successfully.', 200);
    }

    /**
     * Search
     * @OA\Get(
     *      path="/api/posts/search",
     *      operationId="search",
     *      tags={"Search posts"},
     *      summary="search",
     *      description="Return data with list of posts",
     *     @OA\RequestBody(
     *             required=true,
     *             description="Post data",
     *             @OA\JsonContent(
     *                ref="#/components/schemas/search"
     *             ),
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/postData")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error"
     *      ),
     *  )
     * @param RssFeedSearchRequest $request
     * @return JsonResponse
     */
    public function search(RssFeedSearchRequest $request): JsonResponse
    {
        $posts = $this->rssFeedRepository->search($request->validated());

        return self::sendResponse(RssFeedResource::collection($posts), '');
    }
}
