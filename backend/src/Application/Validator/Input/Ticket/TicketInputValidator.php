<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\Ticket;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Domain\Exception\DomainExceptionFactory;
use App\Http\Action\Ticket\CreateTicketAction;
use App\Http\Action\Ticket\PatchTicketAction;

final class TicketInputValidator implements InputValidatorInterface
{
    public function validateCreateTicketInput(array $data): void
    {
        $errors = [];

        if (! isset($data['pkLogement'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkLogement', CreateTicketAction::class);
        } elseif (false === filter_var($data['pkLogement'], FILTER_VALIDATE_INT)) {
            $errors[] = DomainExceptionFactory::invalidFormat('pkLogement', 'integer', CreateTicketAction::class);
        }

        if (empty($data['name'])) {
            $errors[] = DomainExceptionFactory::requiredField('name', CreateTicketAction::class);
        }

        if (! filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            $errors[] = DomainExceptionFactory::invalidFormat('email', 'email', CreateTicketAction::class);
        }

        $phonePattern = '/^\+?[0-9]{7,15}$/';
        if (! preg_match($phonePattern, $data['phone'] ?? '')) {
            $errors[] = DomainExceptionFactory::invalidFormat('phone', 'international phone number', CreateTicketAction::class);
        }
        if (! preg_match($phonePattern, $data['mobile'] ?? '')) {
            $errors[] = DomainExceptionFactory::invalidFormat('mobile', 'international phone number', CreateTicketAction::class);
        }

        if (empty($data['objet'])) {
            $errors[] = DomainExceptionFactory::requiredField('objet', CreateTicketAction::class);
        }
        if (empty($data['message'])) {
            $errors[] = DomainExceptionFactory::requiredField('message', CreateTicketAction::class);
        }

        if (empty($data['attachmentName'])) {
            $errors[] = DomainExceptionFactory::requiredField('attachmentName', CreateTicketAction::class);
        }
        if (empty($data['attachmentContent'])) {
            $errors[] = DomainExceptionFactory::requiredField('attachmentContent', CreateTicketAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(CreateTicketAction::class, $errors);
        }
    }

    public function validatePatchTicketInput(array $data): void
    {
        $errors = [];

        if (! isset($data['pkTicket'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkTicket', PatchTicketAction::class);
        } elseif (false === filter_var($data['pkTicket'], FILTER_VALIDATE_INT)) {
            $errors[] = DomainExceptionFactory::invalidFormat('pkTicket', 'integer', PatchTicketAction::class);
        }

        if (empty($data['statut'])) {
            $errors[] = DomainExceptionFactory::requiredField('statut', PatchTicketAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(PatchTicketAction::class, $errors);
        }
    }
}
