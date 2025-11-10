<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\Releve;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Domain\Exception\DomainExceptionFactory;
use App\Http\Action\External\Releve\GenerateReleveAction;

final class ReleveInputValidator implements InputValidatorInterface
{
    public function validateGenerateReleveInput(array $data): void
    {
        $errors = [];

        if (! filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            $errors[] = DomainExceptionFactory::invalidFormat('email', 'email', GenerateReleveAction::class);
        }

        if (! preg_match('/^\+?[0-9]{7,15}$/', $data['telephone'] ?? '')) {
            $errors[] = DomainExceptionFactory::invalidFormat('phone', 'international phone number', GenerateReleveAction::class);
        }

        if (empty($data['numeroImmeuble'])) {
            $errors[] = DomainExceptionFactory::requiredField('numeroImmeuble', GenerateReleveAction::class);
        }

        if (empty($data['prenom'])) {
            $errors[] = DomainExceptionFactory::requiredField('prenom', GenerateReleveAction::class);
        }

        if (empty($data['nom'])) {
            $errors[] = DomainExceptionFactory::requiredField('nom', GenerateReleveAction::class);
        }

        if (empty($data['adresse'])) {
            $errors[] = DomainExceptionFactory::requiredField('adresse', GenerateReleveAction::class);
        }

        if (empty($data['codePostal'])) {
            $errors[] = DomainExceptionFactory::requiredField('codePostal', GenerateReleveAction::class);
        }

        if (empty($data['ville'])) {
            $errors[] = DomainExceptionFactory::requiredField('ville', GenerateReleveAction::class);
        }

        if (empty($data['datePassage'])) {
            $errors[] = DomainExceptionFactory::requiredField('datePassage', GenerateReleveAction::class);
        } elseif (! \DateTimeImmutable::createFromFormat('d/m/Y', $data['datePassage'])) {
            $errors[] = DomainExceptionFactory::invalidFormat('datePassage', 'date au format DD/MM/YYYY', GenerateReleveAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(GenerateReleveAction::class, $errors);
        }
    }
}
