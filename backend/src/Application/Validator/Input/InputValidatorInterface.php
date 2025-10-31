<?php

declare(strict_types=1);

namespace App\Application\Validator\Input;

interface InputValidatorInterface
{
    public function validate(array $data): void;
}
