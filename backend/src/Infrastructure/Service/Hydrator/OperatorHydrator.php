<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

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

  public function hydrateDeleteOperator(GetByIdIntInputDto $inputDto): object
  {
    return (object) [
      'PkUserChild' => $inputDto->id,
    ];
  }

  public function hydratePutOperator(PutOperatorInputDto $inputDto): object
  {
    return (object) [
      'PkUserChild' => $inputDto->id,
      'LoginID'     => $inputDto->email,
      'UserName'    => $inputDto->lastname,
      'FirstName'   => $inputDto->firstname,
      'PhoneNumber' => $inputDto->phone,
      'Email'       => $inputDto->email,
      'UserRole'    => $inputDto->job,
    ];
  }

  public function hydratePatchOperator(PatchOperatorInputDto $inputDto): object
  {
    return (object) [
      'PkUserChild' => $inputDto->id,
      'Password'    => $inputDto->password,
    ];
  }
  
}
