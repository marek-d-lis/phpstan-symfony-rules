<?php

namespace MarekLis\PHPStanSymfonyRules\Rules;

use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PhpParser\Node;

class NoDumpRule implements Rule
{
    private const array FORBIDDEN_FUNCTIONS = ['var_dump', 'dump'];

    public function getNodeType(): string
    {
        return Node\Expr\FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node->name instanceof Node\Name) {
            return [];
        }

        $functionName = $node->name->toString();

        if (!in_array($functionName, self::FORBIDDEN_FUNCTIONS, true)) {
            return [];
        }

        return [
            RuleErrorBuilder::message(sprintf('Avoid using %s() in the codebase.', $functionName))->build(),
        ];
    }
}
