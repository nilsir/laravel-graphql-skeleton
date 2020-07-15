<?php

/*
 * This file is part of the laravel-graphql-skeleton.
 * (c) nilsir <nilsir@qq.com>
 * This source file is subject to the MIT license that is bundled.
 */

namespace App\GraphQL\Mutations;

use App\Models\Article;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ArticleMutator
{
    /**
     * Return a value for the field.
     *
     * @param null    $rootValue
     * @param mixed[] $args
     *
     * @return mixed
     */
    public function create($rootValue, array $args, GraphQLContext $context)
    {
        $article = new Article($args);
        $context->user()->articles()->save($article);

        return $article;
    }
}
