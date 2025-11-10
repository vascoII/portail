<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\Document\Pdf;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Domain\Exception\DomainExceptionFactory;
use App\Http\Action\Document\Pdf\GenerateFacturePdfAction;
use App\Http\Action\Document\Pdf\GenerateImmeubleDetailPdfAction;
use App\Http\Action\Document\Pdf\GenerateInterventionPdfAction;
use App\Http\Action\Document\Pdf\GenerateLogementRepartPdfAction;
use App\Http\Action\Document\Pdf\GenerateOccupantNotePdfAction;
use App\Http\Action\Document\Pdf\GenerateOccupantRelevePdfAction;
use App\Http\Action\Document\Pdf\GenerateOccupantRepartPdfAction;

final class GeneratePdfInputValidator implements InputValidatorInterface
{
    public function validateGenerateFacturePdfInput(array $data): void
    {
        $errors = [];

        if (! isset($data['pkFacture'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkFacture', GenerateFacturePdfAction::class);
        } elseif (false === filter_var($data['pkFacture'], FILTER_VALIDATE_INT)) {
            $errors[] = DomainExceptionFactory::invalidFormat('pkFacture', 'integer', GenerateFacturePdfAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(GenerateFacturePdfAction::class, $errors);
        }
    }

    public function validateGenerateImmeubleDetailPdfInput(array $data): void
    {
        $errors = [];

        if (empty($data['date1'])) {
            $errors[] = DomainExceptionFactory::requiredField('date1', GenerateImmeubleDetailPdfAction::class);
        } elseif (false === \DateTimeImmutable::createFromFormat('Y-m-d', (string) $data['date1'])) {
            $errors[] = DomainExceptionFactory::invalidFormat('date1', 'date au format YYYY-MM-DD', GenerateImmeubleDetailPdfAction::class);
        }

        if (empty($data['date2'])) {
            $errors[] = DomainExceptionFactory::requiredField('date2', GenerateImmeubleDetailPdfAction::class);
        } elseif (false === \DateTimeImmutable::createFromFormat('Y-m-d', (string) $data['date2'])) {
            $errors[] = DomainExceptionFactory::invalidFormat('date2', 'date au format YYYY-MM-DD', GenerateImmeubleDetailPdfAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(GenerateImmeubleDetailPdfAction::class, $errors);
        }
    }

    public function validateGenerateInterventionPdfInput(array $data): void
    {
        $errors = [];

        if (empty($data['workOrderNumber'])) {
            $errors[] = DomainExceptionFactory::requiredField('workOrderNumber', GenerateInterventionPdfAction::class);
        } elseif (! is_string($data['workOrderNumber'])) {
            $errors[] = DomainExceptionFactory::invalidFormat('workOrderNumber', 'string', GenerateInterventionPdfAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(GenerateInterventionPdfAction::class, $errors);
        }
    }

    public function validateGenerateLogementRepartPdfInput(array $data): void
    {
        $errors = [];

        if (! isset($data['pkImmeuble'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkImmeuble', GenerateLogementRepartPdfAction::class);
        } elseif (false === filter_var($data['pkImmeuble'], FILTER_VALIDATE_INT)) {
            $errors[] = DomainExceptionFactory::invalidFormat('pkImmeuble', 'integer', GenerateLogementRepartPdfAction::class);
        }

        if (! isset($data['pkLogement'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkLogement', GenerateLogementRepartPdfAction::class);
        } elseif (false === filter_var($data['pkLogement'], FILTER_VALIDATE_INT)) {
            $errors[] = DomainExceptionFactory::invalidFormat('pkLogement', 'integer', GenerateLogementRepartPdfAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(GenerateLogementRepartPdfAction::class, $errors);
        }
    }

    public function validateGenerateOccupantNotePdfInput(array $data): void
    {
        $errors = [];

        if (! isset($data['pkOccupant'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkOccupant', GenerateOccupantNotePdfAction::class);
        } elseif (false === filter_var($data['pkOccupant'], FILTER_VALIDATE_INT)) {
            $errors[] = DomainExceptionFactory::invalidFormat('pkOccupant', 'integer', GenerateOccupantNotePdfAction::class);
        }

        if (! isset($data['pkImmeuble'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkImmeuble', GenerateOccupantNotePdfAction::class);
        } elseif (false === filter_var($data['pkImmeuble'], FILTER_VALIDATE_INT)) {
            $errors[] = DomainExceptionFactory::invalidFormat('pkImmeuble', 'integer', GenerateOccupantNotePdfAction::class);
        }

        if (array_key_exists('typeEnergie', $data) && null !== $data['typeEnergie']) {
            $allowed = ['EAU', 'CHAUFFAGE'];
            if (! in_array($data['typeEnergie'], $allowed, true)) {
                $errors[] = DomainExceptionFactory::invalidFormat('typeEnergie', 'EAU or CHAUFFAGE', GenerateOccupantNotePdfAction::class);
            }
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(GenerateOccupantNotePdfAction::class, $errors);
        }
    }

    public function validateGenerateOccupantRelevePdfInput(array $data): void
    {
        $errors = [];

        if (! isset($data['pkOccupant'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkOccupant', GenerateOccupantRelevePdfAction::class);
        } elseif (false === filter_var($data['pkOccupant'], FILTER_VALIDATE_INT)) {
            $errors[] = DomainExceptionFactory::invalidFormat('pkOccupant', 'integer', GenerateOccupantRelevePdfAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(GenerateOccupantRelevePdfAction::class, $errors);
        }
    }

    public function validateGenerateOccupantRepartPdfInput(array $data): void
    {
        $errors = [];

        if (! isset($data['pkImmeuble'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkImmeuble', GenerateOccupantRepartPdfAction::class);
        } elseif (false === filter_var($data['pkImmeuble'], FILTER_VALIDATE_INT)) {
            $errors[] = DomainExceptionFactory::invalidFormat('pkImmeuble', 'integer', GenerateOccupantRepartPdfAction::class);
        }

        if (! isset($data['pkOccupant'])) {
            $errors[] = DomainExceptionFactory::requiredField('pkOccupant', GenerateOccupantRepartPdfAction::class);
        } elseif (false === filter_var($data['pkOccupant'], FILTER_VALIDATE_INT)) {
            $errors[] = DomainExceptionFactory::invalidFormat('pkOccupant', 'integer', GenerateOccupantRepartPdfAction::class);
        }

        if ($errors) {
            throw DomainExceptionFactory::dtoValidation(GenerateOccupantRepartPdfAction::class, $errors);
        }
    }
}
