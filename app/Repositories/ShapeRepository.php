<?php

namespace App\Repositories;

use App\Contracts\Repositories\ShapeRepositoryInterface;
use App\Models\Shape;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ShapeRepository implements ShapeRepositoryInterface
{
    public function __construct(private Shape $shape)
    {
    }

    public function add(array $data): string|object
    {
        return $this->shape->create($data);
    }

    public function getFirstWhere(array $params, array $relations = []): ?Model
    {
        return $this->shape->where($params)->first();
    }

    public function getList(array $orderBy = [], array $relations = [], int|string $dataLimit = DEFAULT_DATA_LIMIT, int $offset = null): Collection|LengthAwarePaginator
    {
        $query = $this->shape->when($relations, function ($query) use ($relations) {
            return $query->with($relations);
        })
            ->when(!empty($orderBy), function ($query) use ($orderBy) {
                $query->orderBy(array_key_first($orderBy), array_values($orderBy)[0]);
            });

        return $dataLimit == 'all' ? $query->get() : $query->paginate($dataLimit);
    }

    public function getListWhere(
        array      $orderBy = [],
        string     $searchValue = null,
        array      $filters = [],
        array      $relations = [],
        int|string $dataLimit = DEFAULT_DATA_LIMIT,
        int        $offset = null): Collection|LengthAwarePaginator
    {
        $query = $this->shape
            ->when($searchValue, function ($query) use ($searchValue) {
                return $query->where('name', 'like', "%$searchValue%");
            })
            ->when($filters && isset($filters['name']), function ($query) use ($filters) {
                return $query->where(['name' => $filters['name']]);
            })
            ->when(!empty($orderBy), function ($query) use ($orderBy) {
                $query->orderBy(array_key_first($orderBy), array_values($orderBy)[0]);
            });

        $filters += ['searchValue' => $searchValue];
        return $dataLimit == 'all' ? $query->get() : $query->paginate($dataLimit)->appends($filters);
    }

    public function update(string $id, array $data): bool
    {
        return $this->shape->where('id', $id)->update($data);
    }

    public function delete(array $params): bool
    {
        return $this->shape->where($params)->delete();
    }
}

