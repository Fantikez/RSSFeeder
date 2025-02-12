<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="postStore",
 *     required = {"title", "link", "pub_date"},
 *     @OA\Property(property="title", type="string", example="Laravel"),
 *     @OA\Property(property="link", type="string", example="http://test"),
 *     @OA\Property(property="description", type="string", example="Lorem Ipsum...."),
 *     @OA\Property(property="pub_date", type="string", format="date-time", example="2024-02-12 12:00:00"),
 * )
 * @OA\Schema(
 *      schema="postGet",
 *      @OA\Property(property="success", type="boolean", example=true),
 *      @OA\Property(
 *           property="data",
 *           type="object",
 *           ref="#/components/schemas/postData"
 *       ),
 *  )
 * @OA\Schema(
 *      schema="error",
 *      @OA\Property(property="message", type="string", example="Title is required (and 2 more errors)"),
 *      @OA\Property(
 *          property="errors",
 *          type="object",
 *          ref="#/components/schemas/validation"
 *       ),
 * )
 *
 * @OA\Schema(
 *      schema="validation",
 *      @OA\Property(property="title", type="string", example="Title is required"),
 *      @OA\Property(property="link", type="string", example="link is required"),
 *      @OA\Property(property="pub_date", type="string", example="pub_date is required"),
 * )
 *
 * @OA\Schema(
 *      schema="update",
 *      @OA\Property(property="success", type="boolean", example=true),
 *      @OA\Property(property="data", type="boolean", example=true),
 *      @OA\Property(property="message", type="string", example="Post updated successfully."),
 *  )
 *
 * @OA\Schema(
 *      schema="delete",
 *      @OA\Property(property="success", type="boolean", example=true),
 *      @OA\Property(property="data", type="boolean", example=true),
 *      @OA\Property(property="message", type="string", example="Post deleted successfully."),
 *   )
 * @OA\Schema(
 *      schema="search",
 *      @OA\Property(property="search", type="string", example="iPhone"),
 *      @OA\Property(property="filters", type="object", ref="#/components/schemas/postData"),
 *      @OA\Property(property="sort", type="object", ref="#/components/schemas/sort"),
 *      @OA\Property(property="per_page", type="string", example="10"),
 *      @OA\Property(property="page", type="string", example="1"),
 * )
 * @OA\Schema(
 *      schema="sort",
 *      @OA\Property(property="sort_by", type="string", example="pub_date"),
 *      @OA\Property(property="sort_order", type="string", example="desk"),
 * )
 */
class PostSchema
{

}
