<?php

namespace MarekLis\PHPStanSymfonyRules\Rules;

use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PhpParser\Node;

class NoDumpRule implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $errors = [];

        // Check if the function call is var_dump() or dump()
        if ($node->name instanceof Node\Name && in_array($node->name->toString(), ['var_dump', 'dump'])) {
            $errors[] = RuleErrorBuilder::message('Avoid using var_dump() or dump() in the codebase')->build();
        }

        return $errors;
    }
}