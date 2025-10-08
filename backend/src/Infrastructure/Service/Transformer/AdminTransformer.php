<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Admin\GetSousTraitantsOutputDto;
use App\Application\Dto\Output\Admin\LoginFromParamOutputDto;
use App\Application\Dto\Output\Admin\ResetPasswordFromEmailOutputDto;
use App\Application\Dto\Output\Admin\UpdateCGUFromPKUserOutputDto;
use App\Application\Dto\Output\Admin\UpdateEmailFromPKUserOutputDto;
use App\Application\Service\Transformer\AdminTransformerInterface;
use App\Application\Factory\Admin\AdminEntityFactory;
use App\Application\Factory\Admin\AdminOutputFactory;
final class AdminTransformer implements AdminTransformerInterface
{
  
  public function __construct(
      private readonly AdminEntityFactory $entityFactory,
      private readonly AdminOutputFactory $outputFactory
  ) {}

  /**
   * Transform raw response to LoginFromParamOutputDto
   */
  public function transformLoginFromParam(object $dataSourceResult): LoginFromParamOutputDto
  {
    $session = $dataSourceResult->LoginFromParamResult;
    return new LoginFromParamOutputDto($session);
  }

  /**
   * Transform raw response to GetSousTraitantsOutputDto
   */
  public function transformGetSousTraitants(object $dataSourceResult): GetSousTraitantsOutputDto
  {
    $sousTraitants = [];
    if (is_array($dataSourceResult->GetSousTraitantsResult)) {
      foreach ($dataSourceResult->GetSousTraitantsResult as $sousTraitant) {
        $sousTraitants[] = $sousTraitant;
      }
    }
    return new GetSousTraitantsOutputDto($sousTraitants);
  }

  /**
   * Transform raw response to UpdateEmailFromPKUserOutputDto
   */
  public function transformUpdateEmailFromPKUser(object $dataSourceResult): UpdateEmailFromPKUserOutputDto
  {
    $user = $this->transformUser($dataSourceResult->UpdateEmailFromPKUserResult);
    return new UpdateEmailFromPKUserOutputDto($user);
  }

  /**
   * Transform raw response to UpdateCGUFromPKUserOutputDto
   */
  public function transformUpdateCGUFromPKUser(object $dataSourceResult): UpdateCGUFromPKUserOutputDto
  {
    $user = $this->transformUser($dataSourceResult->UpdateCGUFromPKUserResult);
    return new UpdateCGUFromPKUserOutputDto($user);
  }

  /**
   * Transform raw response to ResetPasswordFromEmailOutputDto
   */
  public function transformResetPasswordFromEmail(object $dataSourceResult): ResetPasswordFromEmailOutputDto
  {
    $user = $this->transformUser($dataSourceResult->ResetPasswordFromEmailResult);
    return new ResetPasswordFromEmailOutputDto($user);
  }

  private function transformUser(object $soapUser): \App\Application\Dto\Output\Shared\UserDto
  {
    return new \App\Application\Dto\Output\Shared\UserDto(
      loginId: (string) $soapUser->LoginID,
      userName: (string) $soapUser->UserName,
      email: (string) $soapUser->EMail,
      userType: (string) $soapUser->UserType,
      pkUser: (int) $soapUser->PKUser,
      adresse: (string) $soapUser->Adresse,
      cp: (string) $soapUser->CP,
      ville: (string) $soapUser->Ville,
      fk: (int) $soapUser->FK,
      phoneNumber: (string) $soapUser->PhoneNumber,
      firstName: (string) $soapUser->FirstName,
      userRole: (string) $soapUser->UserRole,
      clientName: (string) $soapUser->ClientName,
      clientId: (string) $soapUser->ClientID,
      cgu: (string) $soapUser->CGU,
      fkClient: (int) $soapUser->FKClient,
      fkClientTop: (int) $soapUser->FKClientTop,
      nbImmeubles: (int) $soapUser->NbImmeubles,
      seuilConsoEf: (int) $soapUser->Seuil_Conso_EF,
      seuilConsoEc: (int) $soapUser->Seuil_Conso_EC,
      seuilConsoRepart: (int) $soapUser->Seuil_Conso_Repart,
      seuilConsoCet: (int) $soapUser->Seuil_Conso_CET,
      seuilConsoActif: (bool) $soapUser->Seuil_Conso_Actif,
      seuilConsoEmail: (string) $soapUser->Seuil_Conso_Email,
      showImmeublesArc: (bool) $soapUser->showImmeublesArc,
      showFactures: (bool) $soapUser->showFactures,
      showChgtOccupant: (bool) $soapUser->showChgtOccupant,
      showChantiers: (bool) $soapUser->showChantiers
    );
  }
}
