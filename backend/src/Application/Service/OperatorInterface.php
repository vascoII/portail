<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\Input\Operator\IndexInputDto;
use App\Application\Dto\Output\Operator\IndexOutputDto;
use App\Application\Dto\Input\Operator\CreateInputDto;
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
use App\Application\Dto\Input\Operator\DeleteInputDto;
use App\Application\Dto\Output\Operator\DeleteOutputDto;
use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;
use App\Application\Dto\Output\Operator\OtatsoccupantsOutputDto;

interface OperatorInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
  public function createService(CreateInputDto $inputDto): CreateOutputDto;
  public function addBuildingService(AddBuildingInputDto $inputDto): AddBuildingOutputDto;
  public function removeBuildingService(RemoveBuildingInputDto $inputDto): RemoveBuildingOutputDto;
  public function viewService(ViewInputDto $inputDto): ViewOutputDto;
  public function editService(EditInputDto $inputDto): EditOutputDto;
  public function editPasswordService(EditPasswordInputDto $inputDto): EditPasswordOutputDto;
  public function deleteService(DeleteInputDto $inputDto): DeleteOutputDto;
  public function otatsoccupantsService(OtatsoccupantsInputDto $inputDto): OtatsoccupantsOutputDto;
}
