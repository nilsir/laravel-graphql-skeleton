<?php

namespace App\GraphQL\Mutations;

use App\Models\Article;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ArticleMutator
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue
     * @param  mixed[]  $args
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context
     * @return mixed
     */
    public function create($rootValue, array $args, GraphQLContext $context)
    {
        $article = new Article($args);
        $context->user()->articles()->save($article);

        return $article;
    }
}
