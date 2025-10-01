<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Operator\SetImmeublesInpuDto;
use App\Application\Dto\Input\Operator\CreateGestionnaireInputDto;
use App\Application\Dto\Input\Operator\DeleteUserInpuDto;
use App\Application\Dto\Input\Operator\GetUserInpuDto;
use App\Application\Dto\Input\Operator\UpdateUserInpuDto;

interface OperatorDataSourceInterface
{

//  public function fetchIndex(IndexInputDto $inputDto): object;
//  public function fetchCreate(CreateInputDto $inputDto): object;
//  public function fetchAddBuilding(AddBuildingInputDto $inputDto): object;
//  public function fetchRemoveBuilding(RemoveBuildingInputDto $inputDto): object;
//  public function fetchView(ViewInputDto $inputDto): object;
//  public function fetchEdit(EditInputDto $inputDto): object;
//  public function fetchEditPassword(EditPasswordInputDto $inputDto): object;
//  public function fetchDelete(DeleteInputDto $inputDto): object;
//  public function fetchOtatsoccupants(OtatsoccupantsInputDto $inputDto): object;

  public function fetchSetImmeubles(SetImmeublesInpuDto $inputDto): object;
  public function fetchCreateGestionnaire(CreateGestionnaireInputDto $inputDto): object;
  public function fetchDeleteUser(DeleteUserInpuDto $inputDto): object;
  public function fetchGetChildUsers(): object;
  public function fetchGetUser(GetUserInpuDto $inputDto): object;
  public function fetchUpdateUser(UpdateUserInpuDto $inputDto): object;
}
