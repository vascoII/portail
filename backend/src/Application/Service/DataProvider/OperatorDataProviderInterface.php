<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Operator\GetUserInputDto;
use App\Application\Dto\Output\Operator\IndexOutputDto;
use App\Application\Dto\Input\Operator\CreateGestionnaireInputDto;
use App\Application\Dto\Output\Operator\CreateOutputDto;
use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use App\Application\Dto\Output\Operator\AddBuildingOutputDto;
use App\Application\Dto\Input\Operator\RemoveBuildingInputDto;
use App\Application\Dto\Output\Operator\RemoveBuildingOutputDto;
use App\Application\Dto\Input\Operator\ViewInputDto;
use App\Application\Dto\Output\Operator\ViewOutputDto;
use App\Application\Dto\Input\Operator\EditInputDto;
use App\Application\Dto\Output\Operator\EditOutputDto;
use App\Application\Dto\Input\Operator\EditPasswordInputDto;
use App\Application\Dto\Output\Operator\EditPasswordOutputDto;
use App\Application\Dto\Input\Operator\DeleteUserInpuDto;
use App\Application\Dto\Output\Operator\DeleteOutputDto;
use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;
use App\Application\Dto\Output\Operator\OtatsoccupantsOutputDto;

interface OperatorDataProviderInterface
{

  public function indexService(GetUserInputDto $inputDto);
  public function createService(CreateGestionnaireInputDto $inputDto);
  public function addBuildingService($inputDto);
  public function removeBuildingService( $inputDto);
  public function viewService( $inputDto);
  public function editService( $inputDto);
  public function editPasswordService( $inputDto);
  public function deleteService( $inputDto);
  public function otatsoccupantsService( $inputDto);
}
