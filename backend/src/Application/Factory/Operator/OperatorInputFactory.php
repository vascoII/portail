<?php

declare(strict_types=1);

namespace App\Application\Factory\Operator;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
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

  public function createDeleteUserFromRequest(Request $request): DeleteUserInpuDto
  {
    return new DeleteUserInpuDto((int) $request->query->get('pkUser'));
  }

  public function createGetUserFromRequest(Request $request): GetUserInputDto
  {
    return new GetUserInputDto((int) $request->query->get('pkUser'));
  }

  public function createSetImmeublesFromRequest(Request $request): SetImmeublesInpuDto
  {
    return new SetImmeublesInpuDto(
      (int) $request->request->get('pkUserChild'),
      (string) $request->request->get('listImmeubles')
    );
  }

  public function createUpdateUserFromRequest(Request $request): UpdateUserInpuDto
  {
    return new UpdateUserInpuDto(
      (int) $request->request->get('pkUser'),
      (string) $request->request->get('email'),
      (string) $request->request->get('lastname'),
      (string) $request->request->get('firstname'),
      (string) $request->request->get('phone'),
      (string) $request->request->get('job')
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
