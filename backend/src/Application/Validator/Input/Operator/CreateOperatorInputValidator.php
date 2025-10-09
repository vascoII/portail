<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\Operator;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Http\Action\Operator\CreateOperatorAction;
use App\Http\Action\Operator\PatchOperatorAction;
use App\Domain\Exception\DomainExceptionFactory;

final class CreateOperatorInputValidator implements InputValidatorInterface
{            
    public function validate(array $data): void
    {
        $errors = [];

        if (!filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            $errors[] = DomainExceptionFactory::invalidFormat('email', 'email', CreateOperatorAction::class);
        }

        if (!preg_match('/^\+?[0-9]{7,15}$/', $data['phone'] ?? '')) {
            $errors[] = DomainExceptionFactory::invalidFormat('phone', 'international phone number', CreateOperatorAction::class);
        }

        if (empty($data['lastname'])) {
            $errors[] = DomainExceptionFactory::requiredField('lastname', CreateOperatorAction::class);
        }

        if (empty($data['firstname'])) {
            $errors[] = DomainExceptionFactory::requiredField('firstname', CreateOperatorAction::class);
        }

        if (empty($data['job'])) {
            $errors[] = DomainExceptionFactory::requiredField('job', CreateOperatorAction::class);
        }

        
        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(CreateOperatorAction::class, $errors);
        }
    }  
    
    public function validatePassword(array $data): void
    {
        $errors = [];

        if (empty($data['password'])) {
            $errors[] = DomainExceptionFactory::requiredField('password', PatchOperatorAction::class);
        }
        
        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(CreateOperatorAction::class, $errors);
        }
    }  
}
