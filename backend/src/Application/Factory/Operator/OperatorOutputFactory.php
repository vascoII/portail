<?php

declare(strict_types=1);

namespace App\Application\Factory\Operator;

use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;

final class OperatorOutputFactory 
{
    /**
     * @param User[] $operators
     */
    public function create(array $operators): ListOperatorsOutputDto
    {
        return new ListOperatorsOutputDto($operators);
    }
}
