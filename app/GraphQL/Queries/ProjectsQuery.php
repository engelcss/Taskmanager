<?php

namespace App\GraphQL\Queries;

use App\Project;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class ProjectQuery extends Query {
    protected $attributes = [
        'name' => 'The projects query',
        'description' => 'Retrieves projects',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('project'));
    }

    public function resolve($root, $args) {
        return Project::all();
    }
}
