<?php declare(strict_types=1);

namespace MarekLis\PHPStanSymfonyRules\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class NoDieRule implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $errors = [];

        // Check if the function call is die(), exit(), or dd()
        if ($node->name instanceof Node\Name && in_array($node->name->toString(), ['die', 'exit', 'dd'])) {
            $errors[] = RuleErrorBuilder::message('Avoid using die(), exit(), or dd() in the codebase')->build();
        }

        return $errors;
    }
}
