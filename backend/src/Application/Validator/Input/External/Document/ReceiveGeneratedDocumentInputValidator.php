<?php

declare(strict_types=1);

namespace App\Application\Validator\Input\External\Document;

use App\Application\Validator\Input\InputValidatorInterface;
use App\Domain\Exception\DomainExceptionFactory;
use App\Http\Action\External\Document\ReceiveGeneratedDocumentAction;

final class ReceiveGeneratedDocumentInputValidator implements InputValidatorInterface
{
  public function validate(array $data): void
  {
    $errors = [];

    if (! isset($data['id'])) {
      $errors[] = DomainExceptionFactory::requiredField('id', ReceiveGeneratedDocumentAction::class);
    } elseif (filter_var($data['id'], FILTER_VALIDATE_INT) === false) {
      $errors[] = DomainExceptionFactory::invalidFormat('id', 'integer', ReceiveGeneratedDocumentAction::class);
    }

    if (! array_key_exists('content', $data) || $data['content'] === null) {
      $errors[] = DomainExceptionFactory::requiredField('content', ReceiveGeneratedDocumentAction::class);
    } elseif (! is_string($data['content']) || $data['content'] === '') {
      $errors[] = DomainExceptionFactory::invalidFormat('content', 'non-empty string (binary/base64)', ReceiveGeneratedDocumentAction::class);
    }

    if ($errors) {
      throw DomainExceptionFactory::dtoValidation(ReceiveGeneratedDocumentAction::class, $errors);
    }
  }
}
