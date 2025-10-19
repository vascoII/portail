<?php

declare(strict_types=1);

namespace App\Application\Factory\Operator;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\CreateOperationImmeubleInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorImmeubleInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

use App\Application\Validator\Input\Operator\CreateOperatorInputValidator;

final class OperatorInputFactory
{

  public function __construct(
    private CreateOperatorInputValidator $validator
  ) {}

  public function createOperatorFromRequest(Request $request): CreateOperatorInputDto
  {
    $raw = (string) $request->getContent();
    $data = json_decode($raw, true);

    if (!is_array($data)) {
      $data = [];
    }

    $this->validator->validate($data);

    return new CreateOperatorInputDto(
      email: $data['email'],
      lastname: $data['lastname'],
      firstname: $data['firstname'],
      phone: $data['phone'],
      job: $data['job']
    );
  }

  public function getOperatorFromRoute(Request $request): GetByIdIntInputDto
  {
    return new GetByIdIntInputDto(id: (int) $request->attributes->get('operatorId'));
  }

  public function putOperatorFromRequest(Request $request): PutOperatorInputDto
  {
    $raw = (string) $request->getContent();
    $data = json_decode($raw, true);

    if (!is_array($data)) {
      $data = [];
    }

    $this->validator->validate($data);

    return new PutOperatorInputDto(
      id: (int) $request->attributes->get('id'),
      email: $data['email'],
      lastname: $data['lastname'],
      firstname: $data['firstname'],
      phone: $data['phone'],
      job: $data['job']
    );
  }

  public function patchOperatorFromRequest(Request $request): PatchOperatorInputDto
  {
    $raw = (string) $request->getContent();
    $data = json_decode($raw, true);

    if (!is_array($data)) {
      $data = [];
    }

    $this->validator->validatePassword($data);

    return new PatchOperatorInputDto(
      id: (int) $request->attributes->get('id'),
      password: $data['password']
    );
  }

  public function createListOperatorsFromRequest(Request $request, string $type): ListOperatorsInputDto
  {
    return new ListOperatorsInputDto($type);
  }

  public function createOperationImmeubleFromRequest(Request $request): CreateOperationImmeubleInputDto
  {
    $raw = (string) $request->getContent();
    $data = json_decode($raw, true);

    if (!is_array($data)) {
      $data = [];
    }

    return new CreateOperationImmeubleInputDto(
      operatorId: (int) $request->attributes->get('id'),
      immeubleId: (int) $data['immeubleId']
    );
  }

  public function patchOperatorImmeubleFromRequest(Request $request): PatchOperatorImmeubleInputDto
  {
    $raw = (string) $request->getContent();
    $data = json_decode($raw, true);

    if (!is_array($data)) {
      $data = [];
    }

    return new PatchOperatorImmeubleInputDto(
      operatorId: (int) $request->attributes->get('id'),
      immeubleId: (int) $data['immeubleId']
    );
  }
}
