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
}
