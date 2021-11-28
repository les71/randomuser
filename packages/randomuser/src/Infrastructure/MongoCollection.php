<?php

namespace RandomUser\Infrastructure;

use MongoDB\Client;
use MongoDB\Collection;

class MongoCollection
{
    public static function create(string $collectionName): Collection
    {
        return (new Client(env('MONGO_URI')))
            ->selectDatabase(env('MONGO_DB'))
            ->selectCollection($collectionName);
    }
}
