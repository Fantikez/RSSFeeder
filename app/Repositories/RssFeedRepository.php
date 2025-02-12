<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Interfaces\RssFeedRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;

class RssFeedRepository implements RssFeedRepositoryInterface
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Post::all();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getById(int $id): Post
    {
        return Post::findOrFail($id);
    }

    /**
     * @param array $feed
     * @return object
     */
    public function store(array $feed): Post
    {
        return Post::create($feed);
    }

    public function update(int $id, array $feed): bool
    {
        return Post::whereId($id)->update($feed);
    }

    public function delete(int $id): void
    {
        Post::destroy($id);
    }

    public function search(array $search): LengthAwarePaginator
    {
        $query = Post::query();

        if (isset($search['search'])) {
            $columns = Schema::getColumnListing('posts');

            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$search['search']}%");
                }
            });
        }

        if (isset($search['filters'])) {
            foreach ($search['filters'] as $column => $value) {
                if (Schema::hasColumn('posts', $column)) {
                    if (!is_array($value)) {
                        $query->where($column, 'LIKE', "%{$value}%");
                    } else {
                        $query->whereBetween('pub_date', [$value['from'], $value['to']]);
                    }
                }
            }
        }

        $sortBy = $search['sort']['sort_by'] ?? 'created_at';
        $sortOrder = $search['sort']['sort_order'] ?? 'asc';

        $query->orderBy($sortBy, $sortOrder);

        $perPage = $search['perPage'] ?? 10;
        $page = $search['page'] ?? 1;

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}
