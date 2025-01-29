<?php declare(strict_types=1);

namespace MarekLis\PHPStanSymfonyRules\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class NoDieRule implements Rule
{
    private const FORBIDDEN_FUNCTIONS = ['die', 'exit', 'dd'];

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
