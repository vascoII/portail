<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\Security;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Domain\Exception\DomainExceptionFactory;
use App\Http\Action\Security\LoginAction;
use App\Http\Action\Security\ResetPasswordAction;
use App\Http\Action\Security\PatchCguAction;
use App\Http\Action\Security\PatchEmailAction;
use App\Http\Action\Security\UpdatePasswordAction;

final class SecurityInputValidator implements InputValidatorInterface
{
    public function validateLoginInput(array $data): void
    {
        $errors = [];

        if (empty($data['username'])) {
            $errors[] = DomainExceptionFactory::requiredField('username', LoginAction::class);
        }

        if (empty($data['password'])) {
            $errors[] = DomainExceptionFactory::requiredField('password', LoginAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(LoginAction::class, $errors);
        }
    }

    public function validateResetPasswordInput(array $data): void
    {
        $errors = [];

        if (isset($data['email']) && ! filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = DomainExceptionFactory::invalidFormat('email', 'email', ResetPasswordAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(ResetPasswordAction::class, $errors);
        }
    }

    public function validateUpdateCguInput(array $data): void
    {
        $errors = [];

        if (! isset($data['pkUser']) || ! is_int($data['pkUser'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkUser', PatchCguAction::class);
        }

        if (empty($data['cgu'])) {
            $errors[] = DomainExceptionFactory::requiredField('cgu', PatchCguAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(PatchCguAction::class, $errors);
        }
    }

    public function validateUpdateEmailInput(array $data): void
    {
        $errors = [];

        if (! isset($data['pkUser']) || ! is_int($data['pkUser'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkUser', PatchEmailAction::class);
        }

        if (empty($data['email'])) {
            $errors[] = DomainExceptionFactory::requiredField('email', PatchEmailAction::class);
        } elseif (! filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = DomainExceptionFactory::invalidFormat('email', 'email', PatchEmailAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(PatchEmailAction::class, $errors);
        }
    }

    public function validateUpdatePasswordInput(array $data): void
    {
        $errors = [];

        if (empty($data['pkUser'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkUser', UpdatePasswordAction::class);
        }

        if (empty($data['password'])) {
            $errors[] = DomainExceptionFactory::requiredField('password', UpdatePasswordAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(UpdatePasswordAction::class, $errors);
        }
    }
}
