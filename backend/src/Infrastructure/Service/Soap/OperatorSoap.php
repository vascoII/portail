<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

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
use App\Domain\Service\Soap\OperatorSoapInterface;

final class OperatorSoap implements OperatorSoapInterface
{
  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
    // TODO: Implement indexService logic
    return new IndexOutputDto([]);
  }

  public function createService(CreateInputDto $inputDto): CreateOutputDto
  {
    // TODO: Implement createService logic
    return new CreateOutputDto(true);
  }

  public function addBuildingService(AddBuildingInputDto $inputDto): AddBuildingOutputDto
  {
    // TODO: Implement addBuildingService logic
    return new AddBuildingOutputDto(true);
  }

  public function removeBuildingService(RemoveBuildingInputDto $inputDto): RemoveBuildingOutputDto
  {
    // TODO: Implement removeBuildingService logic
    return new RemoveBuildingOutputDto(true);
  }

  public function viewService(ViewInputDto $inputDto): ViewOutputDto
  {
    // TODO: Implement viewService logic
    return new ViewOutputDto([]);
  }

  public function editService(EditInputDto $inputDto): EditOutputDto
  {
    // TODO: Implement editService logic
    return new EditOutputDto(true);
  }

  public function editPasswordService(EditPasswordInputDto $inputDto): EditPasswordOutputDto
  {
    // TODO: Implement editPasswordService logic
    return new EditPasswordOutputDto(true);
  }

  public function deleteService(DeleteInputDto $inputDto): DeleteOutputDto
  {
    // TODO: Implement deleteService logic
    return new DeleteOutputDto(true);
  }

  public function otatsoccupantsService(OtatsoccupantsInputDto $inputDto): OtatsoccupantsOutputDto
  {
    // TODO: Implement otatsoccupantsService logic
    return new OtatsoccupantsOutputDto([]);
  }
}
