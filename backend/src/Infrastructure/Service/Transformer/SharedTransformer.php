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
        "pkImmeuble" => $immeuble->Immeuble->PkImmeuble,
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

  public function transformGetImmeubleIndicators(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkImmeuble" => $dataSourceResult->Immeuble->PkImmeuble,
      "nbLogements" => $dataSourceResult->NbLogements,
      "nbAppareils" => $dataSourceResult->NbAppareils,
      "nbDepannages" => $dataSourceResult->NbDepannages,
      "nbDepannagesTotal" => $dataSourceResult->NbDepannagesTotal,
      "degresDepannages" => $dataSourceResult->DegresDepannages,
      "nbDysfonctionnements" => $dataSourceResult->NbDysfonctionnements,
      "degresDysfonctionnements" => $dataSourceResult->DegresDysfonctionnements,
      "hasTelereleve" => $dataSourceResult->HasTelereleve,
      "nbCompteursEC" => $dataSourceResult->NbCompteursEC,
      "nbCompteursEF" => $dataSourceResult->NbCompteursEF,
      "nbCompteursRepart" => $dataSourceResult->NbCompteursRepart,
      "nbCompteursCET" => $dataSourceResult->NbCompteursCET,
      "nbCompteursCapteur" => $dataSourceResult->NbCompteursCapteur,
      "nbCompteursElect" => $dataSourceResult->NbCompteursElect,
      "nbCompteursGaz" => $dataSourceResult->NbCompteursGaz,
      "nbCompteursTelereveleTotal" => $dataSourceResult->NbCompteursTelereveleTotal,
      "nbCompteursTelereveleOK" => $dataSourceResult->NbCompteursTelereveleOK,
      "hasTransfertFichiers" => $dataSourceResult->HasTransfertFichiers
    ];
    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListImmeublesIndicators($entityToArray);
  }

  public function transformGetImmeubleCapteur(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkImmeuble" => $dataSourceResult->Immeuble->PkImmeuble,
      "immeubleCapteur" => [
        "IndexRecapTemperature" => [
          "date" => $dataSourceResult->ImmeubleCapteur->IndexRecapTemperature->Date,
          "moy" => $dataSourceResult->ImmeubleCapteur->IndexRecapTemperature->Moy,
          "max" => $dataSourceResult->ImmeubleCapteur->IndexRecapTemperature->Max,
          "min" => $dataSourceResult->ImmeubleCapteur->IndexRecapTemperature->Min,
        ],
        "indexRecapHumidite" => [
          "date" => $dataSourceResult->ImmeubleCapteur->IndexRecapHumidite->Date,
          "moy" => $dataSourceResult->ImmeubleCapteur->IndexRecapHumidite->Moy,
          "max" => $dataSourceResult->ImmeubleCapteur->IndexRecapHumidite->Max,
          "min" => $dataSourceResult->ImmeubleCapteur->IndexRecapHumidite->Min,
        ],
        "serieConsosTemperature" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleCapteur->SerieConsosTemperature->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleCapteur->SerieConsosTemperature->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleCapteur->SerieConsosTemperature->Annee,
        ],
        "SerieConsosHumidite" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleCapteur->SerieConsosHumidite->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleCapteur->SerieConsosHumidite->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleCapteur->SerieConsosHumidite->Annee,
        ]
      ]
    ];
    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListImmeublesIndicators($entityToArray);
  }

  public function transformGetImmeubleCET(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkImmeuble" => $dataSourceResult->Immeuble->PkImmeuble,
      "immeubleCET" => [
        "nbCompteursARelever" => $dataSourceResult->ImmeubleCET->NbCompteursARelever,
        "nbCompteursReleves" => $dataSourceResult->ImmeubleCET->NbCompteursReleves,
        "chantier" => [
          "pkChantier" => $dataSourceResult->ImmeubleCET->Chantier->PkChantier,
          "pkDevis" => $dataSourceResult->ImmeubleCET->Chantier->PkDevis,
          "pkImmeuble" => $dataSourceResult->ImmeubleCET->Chantier->PkImmeuble,
          "dateEntreeChantier" => $dataSourceResult->ImmeubleCET->Chantier->DateEntreeChantier,
          "nbCompteursPoses" => $dataSourceResult->ImmeubleCET->Chantier->NbCompteursPoses,
          "nbCompteursCommandes" => $dataSourceResult->ImmeubleCET->Chantier->NbCompteursCommandes,
        ],
        "topConsos" => [
          "dateReleve" => $dataSourceResult->ImmeubleCET->TopConsos->DateReleve,
          // consosGrandes et consosPetites sont vides ici, à adapter si structure connue
        ],
        "serieConsos" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleCET->SerieConsos->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleCET->SerieConsos->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleCET->SerieConsos->Annee,
        ],
        // ListeReleves est vide ici, à adapter si structure connue
        "totURepart" => $dataSourceResult->ImmeubleCET->Tot_URepart,
        "totTantChauff" => $dataSourceResult->ImmeubleCET->Tot_TantChauff,
        "puTant" => $dataSourceResult->ImmeubleCET->PU_Tant,
        "prixURepart" => $dataSourceResult->ImmeubleCET->Prix_URepart,
        "prixAbonn" => $dataSourceResult->ImmeubleCET->Prix_Abonn,
        "montARepartTant" => $dataSourceResult->ImmeubleCET->Mont_ARepartTant,
        "partRepartConsos" => $dataSourceResult->ImmeubleCET->Part_RepartConsos,
        "ctCombust" => $dataSourceResult->ImmeubleCET->CT_Combust,
        "serieConsosTotale1" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleCET->SerieConsosTotale1->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleCET->SerieConsosTotale1->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleCET->SerieConsosTotale1->Annee,
        ],
        "serieConsosTotale2" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleCET->SerieConsosTotale2->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleCET->SerieConsosTotale2->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleCET->SerieConsosTotale2->Annee,
        ],
        "serieConsosDJU" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleCET->SerieConsosDJU->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleCET->SerieConsosDJU->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleCET->SerieConsosDJU->Annee,
        ],
      ]
    ];
    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListImmeublesIndicators($entityToArray);
  }

  public function transformGetImmeubleEC(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkImmeuble" => $dataSourceResult->Immeuble->PkImmeuble,
      "immeubleEC" => [
        "nbCompteursARelever" => $dataSourceResult->ImmeubleEC->NbCompteursARelever,
        "nbCompteursReleves" => $dataSourceResult->ImmeubleEC->NbCompteursReleves,
        "nbFuites" => $dataSourceResult->ImmeubleEC->NbFuites,
        "degresFuites" => $dataSourceResult->ImmeubleEC->DegresFuites,
        "nbAnomalies" => $dataSourceResult->ImmeubleEC->NbAnomalies,
        "degresAnomalies" => $dataSourceResult->ImmeubleEC->DegresAnomalies,
        "chantier" => [
          "pkChantier" => $dataSourceResult->ImmeubleEC->Chantier->PkChantier,
          "pkDevis" => $dataSourceResult->ImmeubleEC->Chantier->PkDevis,
          "pkImmeuble" => $dataSourceResult->ImmeubleEC->Chantier->PkImmeuble,
          "dateEntreeChantier" => $dataSourceResult->ImmeubleEC->Chantier->DateEntreeChantier,
          "nbCompteursPoses" => $dataSourceResult->ImmeubleEC->Chantier->NbCompteursPoses,
          "nbCompteursCommandes" => $dataSourceResult->ImmeubleEC->Chantier->NbCompteursCommandes,
        ],
        "topConsos" => [
          "dateReleve" => $dataSourceResult->ImmeubleEC->TopConsos->DateReleve,
          "consosGrandes" => array_map(fn($conso) => [
            "pkLogement" => $conso->PkLogement,
            "nomOcc" => $conso->NomOcc,
            "refOcc" => $conso->RefOcc,
            "fluide" => $conso->Fluide,
            "conso" => $conso->Conso,
          ], $dataSourceResult->ImmeubleEC->TopConsos->consosGrandes->conso ?? []),
          "consosPetites" => array_map(fn($conso) => [
            "pkLogement" => $conso->PkLogement,
            "nomOcc" => $conso->NomOcc,
            "refOcc" => $conso->RefOcc,
            "fluide" => $conso->Fluide,
            "conso" => $conso->Conso,
          ], $dataSourceResult->ImmeubleEC->TopConsos->consosPetites->conso ?? []),
        ],
        "serieConsos1" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleEC->SerieConsos1->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleEC->SerieConsos1->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleEC->SerieConsos1->Annee,
        ],
        "serieConsos2" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleEC->SerieConsos2->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleEC->SerieConsos2->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleEC->SerieConsos2->Annee,
        ],
        // ListeReleves à compléter si structure connue
      ]
    ];

    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListImmeublesIndicators($entityToArray);
  }

  public function transformGetImmeubleEF(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "immeubleEF" => [
        "pkImmeuble" => $dataSourceResult->Immeuble->PkImmeuble,
        "nbCompteursARelever" => $dataSourceResult->ImmeubleEF->NbCompteursARelever,
        "nbCompteursReleves" => $dataSourceResult->ImmeubleEF->NbCompteursReleves,
        "nbFuites" => $dataSourceResult->ImmeubleEF->NbFuites,
        "degresFuites" => $dataSourceResult->ImmeubleEF->DegresFuites,
        "nbAnomalies" => $dataSourceResult->ImmeubleEF->NbAnomalies,
        "degresAnomalies" => $dataSourceResult->ImmeubleEF->DegresAnomalies,
        "chantier" => [
          "pkChantier" => $dataSourceResult->ImmeubleEF->Chantier->PkChantier,
          "pkDevis" => $dataSourceResult->ImmeubleEF->Chantier->PkDevis,
          "pkImmeuble" => $dataSourceResult->ImmeubleEF->Chantier->PkImmeuble,
          "dateEntreeChantier" => $dataSourceResult->ImmeubleEF->Chantier->DateEntreeChantier,
          "nbCompteursPoses" => $dataSourceResult->ImmeubleEF->Chantier->NbCompteursPoses,
          "nbCompteursCommandes" => $dataSourceResult->ImmeubleEF->Chantier->NbCompteursCommandes,
        ],
        "topConsos" => [
          "dateReleve" => $dataSourceResult->ImmeubleEF->TopConsos->DateReleve,
          "consosGrandes" => array_map(fn($conso) => [
            "pkLogement" => $conso->PkLogement,
            "nomOcc" => $conso->NomOcc,
            "refOcc" => $conso->RefOcc,
            "fluide" => $conso->Fluide,
            "conso" => $conso->Conso,
          ], $dataSourceResult->ImmeubleEF->TopConsos->consosGrandes->conso ?? []),
          "consosPetites" => array_map(fn($conso) => [
            "pkLogement" => $conso->PkLogement,
            "nomOcc" => $conso->NomOcc,
            "refOcc" => $conso->RefOcc,
            "fluide" => $conso->Fluide,
            "conso" => $conso->Conso,
          ], $dataSourceResult->ImmeubleEF->TopConsos->consosPetites->conso ?? []),
        ],
        "serieConsos1" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleEF->SerieConsos1->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleEF->SerieConsos1->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleEF->SerieConsos1->Annee,
        ],
        "serieConsos2" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleEF->SerieConsos2->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleEF->SerieConsos2->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleEF->SerieConsos2->Annee,
        ],
        // ListeReleves à compléter si structure connue
      ]
    ];
    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListImmeublesIndicators($entityToArray);
  }

  public function transformGetImmeubleElect(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkImmeuble" => $dataSourceResult->Immeuble->PkImmeuble,
      "nbCompteursARelever" => $dataSourceResult->ImmeubleGaz->NbCompteursARelever,
      "nbCompteursReleves" => $dataSourceResult->ImmeubleGaz->NbCompteursReleves,
      "chantier" => [
        "pkChantier" => $dataSourceResult->ImmeubleGaz->Chantier->PkChantier,
        "pkDevis" => $dataSourceResult->ImmeubleGaz->Chantier->PkDevis,
        "pkImmeuble" => $dataSourceResult->ImmeubleGaz->Chantier->PkImmeuble,
        "dateEntreeChantier" => $dataSourceResult->ImmeubleGaz->Chantier->DateEntreeChantier,
        "nbCompteursPoses" => $dataSourceResult->ImmeubleGaz->Chantier->NbCompteursPoses,
        "nbCompteursCommandes" => $dataSourceResult->ImmeubleGaz->Chantier->NbCompteursCommandes
      ],
      "topConsos" => [
        "DateReleve" => $dataSourceResult->ImmeubleGaz->TopConsos->DateReleve,
        "consosGrandes" => $dataSourceResult->ImmeubleGaz->TopConsos->consosGrandes,
        "consosPetites" => $dataSourceResult->ImmeubleGaz->TopConsos->consosPetites
      ],
      "listeReleves" => $dataSourceResult->ImmeubleGaz->ListeReleves
    ];
    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListImmeublesIndicators($entityToArray);
  }

  public function transformGetImmeubleGaz(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkImmeuble" => $dataSourceResult->Immeuble->PkImmeuble,
      "nbCompteursARelever" => $dataSourceResult->ImmeubleGaz->NbCompteursARelever,
      "nbCompteursReleves" => $dataSourceResult->ImmeubleGaz->NbCompteursReleves,
      "chantier" => [
        "pkChantier" => $dataSourceResult->ImmeubleGaz->Chantier->PkChantier,
        "pkDevis" => $dataSourceResult->ImmeubleGaz->Chantier->PkDevis,
        "pkImmeuble" => $dataSourceResult->ImmeubleGaz->Chantier->PkImmeuble,
        "dateEntreeChantier" => $dataSourceResult->ImmeubleGaz->Chantier->DateEntreeChantier,
        "nbCompteursPoses" => $dataSourceResult->ImmeubleGaz->Chantier->NbCompteursPoses,
        "nbCompteursCommandes" => $dataSourceResult->ImmeubleGaz->Chantier->NbCompteursCommandes
      ],
      "topConsos" => [
        "DateReleve" => $dataSourceResult->ImmeubleGaz->TopConsos->DateReleve,
        "consosGrandes" => $dataSourceResult->ImmeubleGaz->TopConsos->consosGrandes,
        "consosPetites" => $dataSourceResult->ImmeubleGaz->TopConsos->consosPetites
      ],
      "listeReleves" => $dataSourceResult->ImmeubleGaz->ListeReleves
    ];
    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListImmeublesIndicators($entityToArray);
  }

  public function transformGetImmeubleRepart(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkImmeuble" => $dataSourceResult->Immeuble->PkImmeuble,
      "immeubleRepart" => [
        "nbCompteursARelever" => $dataSourceResult->ImmeubleRepart->NbCompteursARelever,
        "nbCompteursReleves" => $dataSourceResult->ImmeubleRepart->NbCompteursReleves,
        "chantier" => [
          "pkChantier" => $dataSourceResult->ImmeubleRepart->Chantier->PkChantier,
          "pkDevis" => $dataSourceResult->ImmeubleRepart->Chantier->PkDevis,
          "pkImmeuble" => $dataSourceResult->ImmeubleRepart->Chantier->PkImmeuble,
          "dateEntreeChantier" => $dataSourceResult->ImmeubleRepart->Chantier->DateEntreeChantier,
          "nbCompteursPoses" => $dataSourceResult->ImmeubleRepart->Chantier->NbCompteursPoses,
          "nbCompteursCommandes" => $dataSourceResult->ImmeubleRepart->Chantier->NbCompteursCommandes,
        ],
        "topConsos" => [
          "dateReleve" => $dataSourceResult->ImmeubleRepart->TopConsos->DateReleve,
          // consosGrandes et consosPetites à compléter si structure connue
        ],
        "serieConsos" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleRepart->SerieConsos->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleRepart->SerieConsos->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleRepart->SerieConsos->Annee,
        ],
        // ListeReleves à compléter si structure connue
        "totURepart" => $dataSourceResult->ImmeubleRepart->Tot_URepart,
        "totTantChauff" => $dataSourceResult->ImmeubleRepart->Tot_TantChauff,
        "puTant" => $dataSourceResult->ImmeubleRepart->PU_Tant,
        "prixURepart" => $dataSourceResult->ImmeubleRepart->Prix_URepart,
        "prixAbonn" => $dataSourceResult->ImmeubleRepart->Prix_Abonn,
        "montARepartTant" => $dataSourceResult->ImmeubleRepart->Mont_ARepartTant,
        "partRepartConsos" => $dataSourceResult->ImmeubleRepart->Part_RepartConsos,
        "ctCombust" => $dataSourceResult->ImmeubleRepart->CT_Combust,
        "serieConsosTotale1" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleRepart->SerieConsosTotale1->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleRepart->SerieConsosTotale1->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleRepart->SerieConsosTotale1->Annee,
        ],
        "serieConsosTotale2" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleRepart->SerieConsosTotale2->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleRepart->SerieConsosTotale2->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleRepart->SerieConsosTotale2->Annee,
        ],
        "serieConsosDJU" => [
          "defaultIntervalle" => $dataSourceResult->ImmeubleRepart->SerieConsosDJU->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->ImmeubleRepart->SerieConsosDJU->ValeursXYL,
          "annee" => $dataSourceResult->ImmeubleRepart->SerieConsosDJU->Annee,
        ],
      ]
    ];

    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListImmeublesIndicators($entityToArray);
  }

  public function transformGetImmeubleSerieConsosCompteurGeneral(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkImmeuble" => $dataSourceResult->Immeuble->PkImmeuble,
      "defaultIntervalle" => $dataSourceResult->SerieConsosCompteurGeneral->DefaultIntervalle,
      "valeursXYL" => $dataSourceResult->SerieConsosCompteurGeneral->ValeursXYL,
      "anne" => $dataSourceResult->SerieConsosCompteurGeneral->Annee
    ];
    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListImmeublesIndicators($entityToArray);
  }

  public function transformGetImmeubleSerieConsosEAU(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkImmeuble" => $dataSourceResult->Immeuble->PkImmeuble,
      "defaultIntervalle" => $dataSourceResult->SerieConsosEAU->DefaultIntervalle,
      "valeursXYL" => $dataSourceResult->SerieConsosEAU->ValeursXYL,
      "anne" => $dataSourceResult->SerieConsosEAU->Annee
    ];
    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListImmeublesIndicators($entityToArray);
  }

  public function transformListLogementsIndicators(object $dataSourceResult): ListIndicatorsOuputDto
  {

    $logementsRaw = is_array($rawLogement = $dataSourceResult->ListeInfosLogements->infosLogement ?? null) ?
      $rawLogement : ($rawLogement ? [$rawLogement] : []);

    $entitiesToArray = [];
    foreach ($logementsRaw as $logement) {
      $entitiesToArray[] = [
        "pkImmeuble" => $logement->Immeuble->PkImmeuble,
        "pkLogement" => $logement->Logement->PkLogement,
        "nbAppareils" => $logement->NbAppareils,
        "nbCompteursEC" => $logement->NbCompteursEC,
        "nbCompteursEF" => $logement->NbCompteursEF,
        "nbCompteursRepart" => $logement->NbCompteursRepart,
        "nbCompteursCET" => $logement->NbCompteursCET,
        "nbCompteursCapteur" => $logement->NbCompteursCapteur,
        "nbCompteursElect" => $logement->NbCompteursElect,
        "nbCompteursGaz" => $logement->NbCompteursGaz,
        "nbFuites" => $logement->NbFuites,
        "nbDepannages" => $logement->NbDepannages,
        "nbDysfonctionnements" => $logement->NbDysfonctionnements,
        "nbAnomalies" => $logement->NbAnomalies,
        "nbTicketsInter" => $logement->NbTicketsInter,
        "ticketsInterEnabled" => $logement->TicketsInterEnabled,
        "listeAppareils" => $logement->ListeAppareils
      ];
    }
    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListLogementsIndicators($entitiesToArray);
  }

  public function transformGetLogementIndicators(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkLogement" => $dataSourceResult->Logement->PkLogement,
      "NbAppareils" => $dataSourceResult->NbAppareils,
      "NbCompteursEC" => $dataSourceResult->NbCompteursEC,
      "NbCompteursEF" => $dataSourceResult->NbCompteursEF,
      "NbCompteursRepart" => $dataSourceResult->NbCompteursRepart,
      "NbCompteursCET" => $dataSourceResult->NbCompteursCET,
      "NbCompteursCapteur" => $dataSourceResult->NbCompteursCapteur,
      "NbCompteursElect" => $dataSourceResult->NbCompteursElect,
      "NbCompteursGaz" => $dataSourceResult->NbCompteursGaz,
      "NbDepannages" => $dataSourceResult->NbDepannages,
      "NbDepannagesTotal" => $dataSourceResult->NbDepannagesTotal,
      "NbDysfonctionnements" => $dataSourceResult->NbDysfonctionnements,
      "NbTicketsInter" => $dataSourceResult->NbTicketsInter,
      "TicketsInterEnabled" => $dataSourceResult->TicketsInterEnabled
    ];
    //$entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

    return $this->outputFactory->createListLogementsIndicators($entityToArray);
  }

  public function transformGetLogementCapteur(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkLogement" => $dataSourceResult->Logement->PkLogement,
      "logementCapteur" => [
        "IndexRecapTemperature" => [
          "date" => $dataSourceResult->LogementCapteur->IndexRecapTemperature->Date,
          "moy" => $dataSourceResult->LogementCapteur->IndexRecapTemperature->Moy,
          "max" => $dataSourceResult->LogementCapteur->IndexRecapTemperature->Max,
          "min" => $dataSourceResult->LogementCapteur->IndexRecapTemperature->Min
        ],
        "IndexRecapHumidite" => [
          "date" => $dataSourceResult->LogementCapteur->IndexRecapHumidite->Date,
          "moy" => $dataSourceResult->LogementCapteur->IndexRecapHumidite->Moy,
          "max" => $dataSourceResult->LogementCapteur->IndexRecapHumidite->Max,
          "min" => $dataSourceResult->LogementCapteur->IndexRecapHumidite->Min
        ],
        "SerieConsosTemperature" => [
          "erreur" => $dataSourceResult->LogementCapteur->SerieConsosTemperature->Erreur,
          "info" => $dataSourceResult->LogementCapteur->SerieConsosTemperature->Info,
          "defaultIntervalle" => $dataSourceResult->LogementCapteur->SerieConsosTemperature->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->LogementCapteur->SerieConsosTemperature->ValeursXYL,
          "annee" => $dataSourceResult->LogementCapteur->SerieConsosTemperature->Annee
        ],
        "SerieConsosHumidite" => [
          "erreur" => $dataSourceResult->LogementCapteur->SerieConsosHumidite->Erreur,
          "info" => $dataSourceResult->LogementCapteur->SerieConsosHumidite->Info,
          "defaultIntervalle" => $dataSourceResult->LogementCapteur->SerieConsosHumidite->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->LogementCapteur->SerieConsosHumidite->ValeursXYL,
          "annee" => $dataSourceResult->LogementCapteur->SerieConsosHumidite->Annee
        ]
      ]
    ];

    return $this->outputFactory->createListIndicators($entityToArray);
  }

  public function transformGetLogementCET(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkLogement" => $dataSourceResult->Logement->PkLogement,
      "logementCET" => [
        "ListeInfosAppareils" => $dataSourceResult->LogementCET->ListeInfosAppareils,
        "Tot_URepart" => $dataSourceResult->LogementCET->Tot_URepart,
        "Tot_TantChauff" => $dataSourceResult->LogementCET->Tot_TantChauff,
        "PU_Tant" => $dataSourceResult->LogementCET->PU_Tant,
        "Prix_URepart" => $dataSourceResult->LogementCET->Prix_URepart,
        "Prix_Abonn" => $dataSourceResult->LogementCET->Prix_Abonn,
        "Mont_ARepartTant" => $dataSourceResult->LogementCET->Mont_ARepartTant,
        "Part_RepartConsos" => $dataSourceResult->LogementCET->Part_RepartConsos,
        "CT_Combust" => $dataSourceResult->LogementCET->CT_Combust,
        "URepartLog" => $dataSourceResult->LogementCET->URepartLog,
        "TantLog" => $dataSourceResult->LogementCET->TantLog,
        "Prix_ChauffTantLog" => $dataSourceResult->LogementCET->Prix_ChauffTantLog,
        "CT_ChauffLog" => $dataSourceResult->LogementCET->CT_ChauffLog,
        "SerieConsosDJU" => [
          "erreur" => $dataSourceResult->LogementCET->SerieConsosDJU->Erreur,
          "info" => $dataSourceResult->LogementCET->SerieConsosDJU->Info,
          "defaultIntervalle" => $dataSourceResult->LogementCET->SerieConsosDJU->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->LogementCET->SerieConsosDJU->ValeursXYL,
          "annee" => $dataSourceResult->LogementCET->SerieConsosDJU->Annee
        ]
      ]
    ];

    return $this->outputFactory->createListIndicators($entityToArray);
  }

  public function transformGetLogementEC(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkLogement" => $dataSourceResult->Logement->PkLogement,
      "logementEC" => [
        "NbFuites" => $dataSourceResult->LogementEC->NbFuites,
        "NbAnomalies" => $dataSourceResult->LogementEC->NbAnomalies,
        "ConsoPeriode" => [
          "Conso" => $dataSourceResult->LogementEC->ConsoPeriode->Conso,
          "DateDeb" => $dataSourceResult->LogementEC->ConsoPeriode->DateDeb,
          "DateFin" => $dataSourceResult->LogementEC->ConsoPeriode->DateFin,
          "R5" => [
            "DateReleve" => $dataSourceResult->LogementEC->ConsoPeriode->R5->DateReleve,
            "Index" => $dataSourceResult->LogementEC->ConsoPeriode->R5->Index,
            "Conso" => $dataSourceResult->LogementEC->ConsoPeriode->R5->Conso
          ],
          "R4" => [
            "DateReleve" => $dataSourceResult->LogementEC->ConsoPeriode->R4->DateReleve,
            "Index" => $dataSourceResult->LogementEC->ConsoPeriode->R4->Index,
            "Conso" => $dataSourceResult->LogementEC->ConsoPeriode->R4->Conso
          ],
          "R3" => [
            "DateReleve" => $dataSourceResult->LogementEC->ConsoPeriode->R3->DateReleve,
            "Index" => $dataSourceResult->LogementEC->ConsoPeriode->R3->Index,
            "Conso" => $dataSourceResult->LogementEC->ConsoPeriode->R3->Conso
          ],
          "R2" => [
            "DateReleve" => $dataSourceResult->LogementEC->ConsoPeriode->R2->DateReleve,
            "Index" => $dataSourceResult->LogementEC->ConsoPeriode->R2->Index,
            "Conso" => $dataSourceResult->LogementEC->ConsoPeriode->R2->Conso
          ],
          "R1" => [
            "DateReleve" => $dataSourceResult->LogementEC->ConsoPeriode->R1->DateReleve,
            "Index" => $dataSourceResult->LogementEC->ConsoPeriode->R1->Index,
            "Conso" => $dataSourceResult->LogementEC->ConsoPeriode->R1->Conso
          ],
          "VAR4" => $dataSourceResult->LogementEC->ConsoPeriode->VAR4,
          "VAR3" => $dataSourceResult->LogementEC->ConsoPeriode->VAR3,
          "VAR2" => $dataSourceResult->LogementEC->ConsoPeriode->VAR2,
          "VAR1" => $dataSourceResult->LogementEC->ConsoPeriode->VAR1,
          "DegresVAR4" => $dataSourceResult->LogementEC->ConsoPeriode->DegresVAR4,
          "DegresVAR3" => $dataSourceResult->LogementEC->ConsoPeriode->DegresVAR3,
          "DegresVAR2" => $dataSourceResult->LogementEC->ConsoPeriode->DegresVAR2,
          "DegresVAR1" => $dataSourceResult->LogementEC->ConsoPeriode->DegresVAR1
        ],
        "ListeInfosAppareils" => $dataSourceResult->LogementEC->ListeInfosAppareils,
        "SerieConsos" => [
          "erreur" => $dataSourceResult->LogementEC->SerieConsos->Erreur,
          "info" => $dataSourceResult->LogementEC->SerieConsos->Info,
          "defaultIntervalle" => $dataSourceResult->LogementEC->SerieConsos->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->LogementEC->SerieConsos->ValeursXYL,
          "annee" => $dataSourceResult->LogementEC->SerieConsos->Annee
        ],
        "ConsoMemeTypeLogement" => $dataSourceResult->LogementEC->ConsoMemeTypeLogement
      ]
    ];

    return $this->outputFactory->createListIndicators($entityToArray);
  }

  public function transformGetLogementEF(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkLogement" => $dataSourceResult->Logement->PkLogement,
      "logementEF" => [
        "NbFuites" => $dataSourceResult->LogementEF->NbFuites,
        "NbAnomalies" => $dataSourceResult->LogementEF->NbAnomalies,
        "ConsoPeriode" => [
          "Conso" => $dataSourceResult->LogementEF->ConsoPeriode->Conso,
          "DateDeb" => $dataSourceResult->LogementEF->ConsoPeriode->DateDeb,
          "DateFin" => $dataSourceResult->LogementEF->ConsoPeriode->DateFin,
          "R5" => [
            "DateReleve" => $dataSourceResult->LogementEF->ConsoPeriode->R5->DateReleve,
            "Index" => $dataSourceResult->LogementEF->ConsoPeriode->R5->Index,
            "Conso" => $dataSourceResult->LogementEF->ConsoPeriode->R5->Conso
          ],
          "R4" => [
            "DateReleve" => $dataSourceResult->LogementEF->ConsoPeriode->R4->DateReleve,
            "Index" => $dataSourceResult->LogementEF->ConsoPeriode->R4->Index,
            "Conso" => $dataSourceResult->LogementEF->ConsoPeriode->R4->Conso
          ],
          "R3" => [
            "DateReleve" => $dataSourceResult->LogementEF->ConsoPeriode->R3->DateReleve,
            "Index" => $dataSourceResult->LogementEF->ConsoPeriode->R3->Index,
            "Conso" => $dataSourceResult->LogementEF->ConsoPeriode->R3->Conso
          ],
          "R2" => [
            "DateReleve" => $dataSourceResult->LogementEF->ConsoPeriode->R2->DateReleve,
            "Index" => $dataSourceResult->LogementEF->ConsoPeriode->R2->Index,
            "Conso" => $dataSourceResult->LogementEF->ConsoPeriode->R2->Conso
          ],
          "R1" => [
            "DateReleve" => $dataSourceResult->LogementEF->ConsoPeriode->R1->DateReleve,
            "Index" => $dataSourceResult->LogementEF->ConsoPeriode->R1->Index,
            "Conso" => $dataSourceResult->LogementEF->ConsoPeriode->R1->Conso
          ],
          "VAR4" => $dataSourceResult->LogementEF->ConsoPeriode->VAR4,
          "VAR3" => $dataSourceResult->LogementEF->ConsoPeriode->VAR3,
          "VAR2" => $dataSourceResult->LogementEF->ConsoPeriode->VAR2,
          "VAR1" => $dataSourceResult->LogementEF->ConsoPeriode->VAR1,
          "DegresVAR4" => $dataSourceResult->LogementEF->ConsoPeriode->DegresVAR4,
          "DegresVAR3" => $dataSourceResult->LogementEF->ConsoPeriode->DegresVAR3,
          "DegresVAR2" => $dataSourceResult->LogementEF->ConsoPeriode->DegresVAR2,
          "DegresVAR1" => $dataSourceResult->LogementEF->ConsoPeriode->DegresVAR1
        ],
        "ListeInfosAppareils" => $dataSourceResult->LogementEF->ListeInfosAppareils,
        "SerieConsos" => [
          "erreur" => $dataSourceResult->LogementEF->SerieConsos->Erreur,
          "info" => $dataSourceResult->LogementEF->SerieConsos->Info,
          "defaultIntervalle" => $dataSourceResult->LogementEF->SerieConsos->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->LogementEF->SerieConsos->ValeursXYL,
          "annee" => $dataSourceResult->LogementEF->SerieConsos->Annee
        ],
        "ConsoMemeTypeLogement" => $dataSourceResult->LogementEF->ConsoMemeTypeLogement
      ]
    ];

    return $this->outputFactory->createListIndicators($entityToArray);
  }

  public function transformGetLogementElect(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkLogement" => $dataSourceResult->Logement->PkLogement,
      "logementElect" => [
        "LogementElect" => $dataSourceResult->LogementElect->ListeInfosAppareils
      ]
    ];

    return $this->outputFactory->createListIndicators($entityToArray);
  }

  public function transformGetLogementGaz(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkLogement" => $dataSourceResult->Logement->PkLogement,
      "logementGaz" => [
        "ListeInfosAppareils" => $dataSourceResult->LogementGaz->ListeInfosAppareils
      ]
    ];

    return $this->outputFactory->createListIndicators($entityToArray);
  }

  public function transformGetLogementRepart(object $dataSourceResult): ListIndicatorsOuputDto
  {
    $entityToArray = [
      "pkLogement" => $dataSourceResult->Logement->PkLogement,
      "logementRepart" => [
        "ListeInfosAppareils" => $dataSourceResult->LogementRepart->ListeInfosAppareils,
        "Tot_URepart" => $dataSourceResult->LogementRepart->Tot_URepart,
        "Tot_TantChauff" => $dataSourceResult->LogementRepart->Tot_TantChauff,
        "PU_Tant" => $dataSourceResult->LogementRepart->PU_Tant,
        "Prix_URepart" => $dataSourceResult->LogementRepart->Prix_URepart,
        "Prix_Abonn" => $dataSourceResult->LogementRepart->Prix_Abonn,
        "Mont_ARepartTant" => $dataSourceResult->LogementRepart->Mont_ARepartTant,
        "Part_RepartConsos" => $dataSourceResult->LogementRepart->Part_RepartConsos,
        "CT_Combust" => $dataSourceResult->LogementRepart->CT_Combust,
        "URepartLog" => $dataSourceResult->LogementRepart->URepartLog,
        "TantLog" => $dataSourceResult->LogementRepart->TantLog,
        "Prix_ChauffTantLog" => $dataSourceResult->LogementRepart->Prix_ChauffTantLog,
        "CT_ChauffLog" => $dataSourceResult->LogementRepart->CT_ChauffLog,
        "SerieConsosDJU" => [
          "erreur" => $dataSourceResult->LogementRepart->SerieConsosDJU->Erreur,
          "info" => $dataSourceResult->LogementRepart->SerieConsosDJU->Info,
          "defaultIntervalle" => $dataSourceResult->LogementRepart->SerieConsosDJU->DefaultIntervalle,
          "valeursXYL" => $dataSourceResult->LogementRepart->SerieConsosDJU->ValeursXYL,
          "annee" => $dataSourceResult->LogementRepart->SerieConsosDJU->Annee
        ],
        "ConsosPieces" => $dataSourceResult->LogementRepart->ConsosPieces
      ]
    ];

    return $this->outputFactory->createListIndicators($entityToArray);
  }
}
