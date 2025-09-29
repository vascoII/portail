<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Operator\IndexInputDto;
use App\Application\Dto\Input\Operator\CreateInputDto;
use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use App\Application\Dto\Input\Operator\RemoveBuildingInputDto;
use App\Application\Dto\Input\Operator\ViewInputDto;
use App\Application\Dto\Input\Operator\EditInputDto;
use App\Application\Dto\Input\Operator\EditPasswordInputDto;
use App\Application\Dto\Input\Operator\DeleteInputDto;
use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;

interface OperatorDataSourceInterface
{

  public function fetchIndex(IndexInputDto $inputDto): object;
  public function fetchCreate(CreateInputDto $inputDto): object;
  public function fetchAddBuilding(AddBuildingInputDto $inputDto): object;
  public function fetchRemoveBuilding(RemoveBuildingInputDto $inputDto): object;
  public function fetchView(ViewInputDto $inputDto): object;
  public function fetchEdit(EditInputDto $inputDto): object;
  public function fetchEditPassword(EditPasswordInputDto $inputDto): object;
  public function fetchDelete(DeleteInputDto $inputDto): object;
  public function fetchOtatsoccupants(OtatsoccupantsInputDto $inputDto): object;
}
