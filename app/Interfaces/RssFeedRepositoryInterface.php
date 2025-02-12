<?php

namespace App\Interfaces;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface RssFeedRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): Post;

    public function store(array $feed): Post;

    public function update(int $id, array $feed): bool;

    public function delete(int $id): void;

    public function search(array $search): LengthAwarePaginator;
}
