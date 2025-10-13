<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Shared\UserDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;
use App\Application\Dto\Output\Shared\ListAlertesOuputDto;
use App\Application\Factory\Shared\SharedEntityFactory;
use App\Application\Factory\Shared\SharedOutputFactory;
use App\Application\Service\Transformer\SharedTransformerInterface;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;


final class SharedTransformer implements SharedTransformerInterface
{
  public function __construct(
    private readonly SharedEntityFactory $entityFactory,
    private readonly SharedOutputFactory $outputFactory
  ) {}

  /**
   * Transform raw response to ReportOutputDto
   */
  public function transformGetReport(string $dataSourceResult, string $filename): GetReportOutputDto
  {
    return new GetReportOutputDto(
      data: $dataSourceResult,
      filename: $filename,
      length: strval(strlen($dataSourceResult))
    );
  }

  public function transformPost(bool $dataSourceResult): SuccessOutputDto
  {
    return new SuccessOutputDto(bool: $dataSourceResult);
  }

  public function transformPut(object $dataSourceResult): SuccessOutputDto
  {
    return new SuccessOutputDto(bool: empty($dataSourceResult->Erreur) ? true : false);
  }

  public function transformPatch(object $dataSourceResult): SuccessOutputDto
  {
    return new SuccessOutputDto(bool: empty($dataSourceResult->Erreur) ? true : false);
  }

  public function transformDelete(object $dataSourceResult): SuccessOutputDto
  {
    return new SuccessOutputDto(bool: empty($dataSourceResult->Erreur) ? true : false);
  }

  public function transformGetUser(object $dataSourceResult): UserDto
  {
    $operatorsRaw = $dataSourceResult->GetUserResult;

    $entity = $this->entityFactory->createUserFromRaw($operatorsRaw);

    return $this->outputFactory->createUser($entity);
  }

  public function transformSuccess(): SuccessOutputDto
  {
    return new SuccessOutputDto(bool: true);
  }

  public function transformListAnomalies(object $dataSourceResult): ListAnomaliesOuputDto
  {
    $anomaliesRaw = is_array($rawAnomalies = $dataSourceResult->ListeInfosDepannages->infosDepannage ?? null) ?
      $rawAnomalies : ($rawAnomalies ? [$rawAnomalies] : []);

    $entities = $this->entityFactory->createManyAnomaliesFromRawList($anomaliesRaw);

    return $this->outputFactory->createListAnomalies($entities);
  }

  public function transformListDysfonctionnements(object $dataSourceResult): ListDysfonctionnementsOuputDto
  {
    $dysfonctionnementsRaw = is_array($rawDysfonctionnement = $dataSourceResult->ListeInfosDepannages->infosDepannage ?? null) ?
      $rawDysfonctionnement : ($rawDysfonctionnement ? [$rawDysfonctionnement] : []);

    $entities = $this->entityFactory->createManyDysfonctionnementsFromRawList($dysfonctionnementsRaw);

    return $this->outputFactory->createListDysfonctionnements($entities);
  }

  public function transformListFuites(object $dataSourceResult): ListFuitesOuputDto
  {
    $fuitesRaw = is_array($rawFuite = $dataSourceResult->ListeInfosDepannages->infosDepannage ?? null) ?
      $rawFuite : ($rawFuite ? [$rawFuite] : []);

    $entities = $this->entityFactory->createManyFuitesFromRawList($fuitesRaw);

    return $this->outputFactory->createListFuites($entities);
  }

  public function transformListInterventions(object $dataSourceResult): ListInternetionsOutputDto
  {
    $interventionsRaw = is_array($rawIntervention = $dataSourceResult->ListeInfosDepannages->infosDepannage ?? null) ?
      $rawIntervention : ($rawIntervention ? [$rawIntervention] : []);

    $entities = $this->entityFactory->createManyInterventionsFromRawList($interventionsRaw);

    return $this->outputFactory->createListInterventions($entities);
  }

  public function transformListAlertes(object $dataSourceResult): ListAlertesOuputDto
  {
    $alertesRaw = is_array($rawAlerte = $dataSourceResult->ListeInfosDepannages->infosDepannage ?? null) ?
      $rawAlerte : ($rawAlerte ? [$rawAlerte] : []);

    $entities = $this->entityFactory->createManyAlertesFromRawList($alertesRaw);

    return $this->outputFactory->createListAlertes($entities);
  }


  public function transformListImmeublesIndicators(object $dataSourceResult): ListIndicatorsOuputDto
  {
      $immeublesRaw = is_array($rawImmeuble = $dataSourceResult->ListeInfosImmeubles->infosImmeuble ?? null) ?
          $rawImmeuble : ($rawImmeuble ? [$rawImmeuble] : []);

      $entitiesToArray = [];
      foreach ($immeublesRaw as $immeuble) {
        $entitiesToArray[] = [
            "nbLogements" => $immeuble->NbLogements,
            "nbAppareils" => $immeuble->NbAppareils,
            "nbCompteursEC" => $immeuble->NbCompteursEC,
            "nbCompteursEF" => $immeuble->NbCompteursEF,
            "nbCompteursRepart" => $immeuble->NbCompteursRepart,
            "nbCompteursCET" => $immeuble->NbCompteursCET,
            "nbCompteursCapteur" => $immeuble->NbCompteursCapteur,
            "nbCompteursElect" => $immeuble->NbCompteursElect,
            "nbCompteursGaz" => $immeuble->NbCompteursGaz,
            "nbFuites" => $immeuble->NbFuites,
            "nbDepannages" => $immeuble->NbDepannages,
            "nbDysfonctionnements" => $immeuble->NbDysfonctionnements,
            "nbAnomalies" => $immeuble->NbAnomalies,
            "nbChantiers" => $immeuble->NbChantiers   
        ];
      }
      //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

      return $this->outputFactory->createListImmeublesIndicators($entitiesToArray);
  }
}
