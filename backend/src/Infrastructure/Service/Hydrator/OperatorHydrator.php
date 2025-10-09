<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

use App\Application\Dto\Input\Operator\SetImmeublesInpuDto;
use App\Application\Dto\Input\Operator\CreateGestionnaireInputDto;
use App\Application\Dto\Input\Operator\DeleteUserInpuDto;
use App\Application\Dto\Input\Operator\GetUserInpuDto;
use App\Application\Dto\Input\Operator\UpdateUserInpuDto;

final class OperatorHydrator
{

  public function hydrateGetListOperators(ListOperatorsInputDto $inputDto): object
  {
      return (object) [
          'type' => $inputDto->type
      ];
  }

  public function hydratePostOperator(CreateOperatorInputDto $inputDto): object
  {
      return (object) [
          'LoginID'     => $inputDto->email,
          'UserName'    => $inputDto->lastname,
          'FirstName'   => $inputDto->firstname,
          'PhoneNumber' => $inputDto->phone,
          'Email'       => $inputDto->email,
          'UserRole'    => $inputDto->job,
      ];
  }
  
  public function hydrateGetOperator(GetByIdIntInputDto $inputDto): object
  {
    return (object) [
      'PkUserChild' => $inputDto->id,
    ];
  }

  public function hydrateUpdateUser(UpdateUserInpuDto $inputDto): object
  {
    return (object) [
      'PkUserChild' => $inputDto->pkUser,
      'LoginID'     => $inputDto->email,
      'UserName'    => $inputDto->lastname,
      'FirstName'   => $inputDto->firstname,
      'PhoneNumber' => $inputDto->phone,
      'Email'       => $inputDto->email,
      'UserRole'    => $inputDto->job,
    ];
  }
  
}
