<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Operator\IndexInputDto;
use App\Application\Dto\Input\Operator\CreateInputDto;
use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use App\Application\Dto\Input\Operator\RemoveBuildingInputDto;
use App\Application\Dto\Input\Operator\ViewInputDto;
use App\Application\Dto\Input\Operator\EditInputDto;
use App\Application\Dto\Input\Operator\EditPasswordInputDto;
use App\Application\Dto\Input\Operator\DeleteInputDto;
use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;

interface OperatorSoapInterface
{

  public function indexService(IndexInputDto $inputDto): array;
  public function createService(CreateInputDto $inputDto): array;
  public function addBuildingService(AddBuildingInputDto $inputDto): array;
  public function removeBuildingService(RemoveBuildingInputDto $inputDto): array;
  public function viewService(ViewInputDto $inputDto): array;
  public function editService(EditInputDto $inputDto): array;
  public function editPasswordService(EditPasswordInputDto $inputDto): array;
  public function deleteService(DeleteInputDto $inputDto): array;
  public function otatsoccupantsService(OtatsoccupantsInputDto $inputDto): array;
}
