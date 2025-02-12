<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="post",
 *     title="Post",
 *     description="Модель поста",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(
 *          property="data",
 *          type="object",
 *          ref="#/components/schemas/postData"
 *      ),
 *     @OA\Property(property="message", type="string", example="Post created successfully.")
 * )
 *
 * @OA\Schema(
 *      schema="postData",
 *      title="Post",
 *      description="Модель поста",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="title", type="string", example="Laravel"),
 *      @OA\Property(property="link", type="string", example="http://test"),
 *      @OA\Property(property="description", type="string", example="This is a solid deal..."),
 *      @OA\Property(property="pub_date", type="string", format="date-time", example="2024-02-12 12:00:00"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-12T12:00:00Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2024-02-12T12:30:00Z")
 *  )
 */
class Post extends Model
{
    protected $fillable = [
        'title',
        'link',
        'description',
        'pub_date',
    ];
}
