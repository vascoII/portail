<?php

declare(strict_types=1);

namespace App\Application\Factory\Operator;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
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

  public function createListOperatorsFromRequest(Request $request, string $type): ListOperatorsInputDto
  {
    return new ListOperatorsInputDto($type);
  }

  public function createViewFromRequest(Request $request): ViewInputDto
  {
    return new ViewInputDto((string) $request->query->get('id'));
  }

  public function createOtatsoccupantsFromRequest(Request $request): OtatsoccupantsInputDto
  {
    return new OtatsoccupantsInputDto();
  }

  // Methods for route parameters
  public function createIndexFromRoute(Request $request): IndexInputDto
  {
    return new IndexInputDto();
  }

  public function createViewFromRoute(Request $request, string $idParam): ViewInputDto
  {
    $id = (string) $request->attributes->get($idParam);
    return new ViewInputDto($id);
  }

  public function createOtatsoccupantsFromRoute(Request $request): OtatsoccupantsInputDto
  {
    return new OtatsoccupantsInputDto();
  }

  public function createEditFromRoute(Request $request, string $idParam): EditInputDto
  {
    $id = (string) $request->attributes->get($idParam);
    return new EditInputDto($id);
  }
}
