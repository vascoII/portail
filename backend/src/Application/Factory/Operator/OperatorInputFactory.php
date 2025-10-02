<?php

declare(strict_types=1);

namespace App\Application\Factory\Operator;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Operator\CreateGestionnaireInputDto;
use App\Application\Dto\Input\Operator\DeleteUserInpuDto;
use App\Application\Dto\Input\Operator\GetUserInputDto;
use App\Application\Dto\Input\Operator\SetImmeublesInpuDto;
use App\Application\Dto\Input\Operator\UpdateUserInpuDto;

final class OperatorInputFactory
{
  public function createCreateGestionnaireFromRequest(Request $request): CreateGestionnaireInputDto
  {
    return new CreateGestionnaireInputDto(
      (int) $request->request->get('pkUser'),
      (string) $request->request->get('email'),
      (string) $request->request->get('lastname'),
      (string) $request->request->get('firstname'),
      (string) $request->request->get('phone'),
      (string) $request->request->get('job')
    );
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
}
