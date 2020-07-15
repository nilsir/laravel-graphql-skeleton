<?php

/*
 * This file is part of the laravel-graphql-skeleton.
 * (c) nilsir <nilsir@qq.com>
 * This source file is subject to the MIT license that is bundled.
 */

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AuthMutator
{
    /**
     * Return a value for the field.
     *
     * @param null           $rootValue   Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param mixed[]        $args        the arguments that were passed into the field
     * @param GraphQLContext $context     arbitrary data that is shared between all fields of a single query
     * @param ResolveInfo    $resolveInfo information about the query itself, such as the execution state, the field name, path to the field from the root, and more
     *
     * @return mixed
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $credentials = Arr::only($args, ['email', 'password']);

        if ($token = Auth::guard('api')->attempt($credentials)) {
            return $token;
        }

        return null;
    }
}
