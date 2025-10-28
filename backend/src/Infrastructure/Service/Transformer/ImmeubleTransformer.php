<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Factory\Immeuble\ImmeubleEntityFactory;
use App\Application\Factory\Immeuble\ImmeubleOutputFactory;
use App\Application\Service\Transformer\ImmeubleTransformerInterface;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;
use App\Application\Factory\Shared\SharedOutputFactory;

final class ImmeubleTransformer implements ImmeubleTransformerInterface
{
    public function __construct(
        private readonly ImmeubleEntityFactory $entityFactory,
        private readonly ImmeubleOutputFactory $outputFactory,
        private readonly SharedOutputFactory $sharedOutputFactory
    ) {}

    public function transformGetImmeuble(object $dataSourceResult): GetImmeubleOutputDto
    {
        $entity = $this->entityFactory->createImmeubleFromRaw($dataSourceResult);

        return $this->outputFactory->createGetImmeuble($entity);
    }

    /**
     * Transform raw response to ListImmeublesOutputDto.
     */
    public function transformListImmeubles(object $dataSourceResult): ListImmeublesOutputDto
    {
        $immeublesRaw = is_array($rawImmeuble = $dataSourceResult->ListeInfosImmeubles->infosImmeuble ?? null)
           ? $rawImmeuble : ($rawImmeuble ? [$rawImmeuble] : []);

        $entities = $this->entityFactory->createManyImmeublesFromRawList($immeublesRaw);
        return $this->outputFactory->createListImmeubles($entities);
    }

    public function transformGetImmeubleCapteur(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkImmeuble' => $dataSourceResult->Immeuble->PkImmeuble,
            'immeubleCapteur' => [
                'IndexRecapTemperature' => [
                    'date' => $dataSourceResult->ImmeubleCapteur->IndexRecapTemperature->Date,
                    'moy' => $dataSourceResult->ImmeubleCapteur->IndexRecapTemperature->Moy,
                    'max' => $dataSourceResult->ImmeubleCapteur->IndexRecapTemperature->Max,
                    'min' => $dataSourceResult->ImmeubleCapteur->IndexRecapTemperature->Min,
                ],
                'indexRecapHumidite' => [
                    'date' => $dataSourceResult->ImmeubleCapteur->IndexRecapHumidite->Date,
                    'moy' => $dataSourceResult->ImmeubleCapteur->IndexRecapHumidite->Moy,
                    'max' => $dataSourceResult->ImmeubleCapteur->IndexRecapHumidite->Max,
                    'min' => $dataSourceResult->ImmeubleCapteur->IndexRecapHumidite->Min,
                ],
                'serieConsosTemperature' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleCapteur->SerieConsosTemperature->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleCapteur->SerieConsosTemperature->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleCapteur->SerieConsosTemperature->Annee,
                ],
                'SerieConsosHumidite' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleCapteur->SerieConsosHumidite->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleCapteur->SerieConsosHumidite->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleCapteur->SerieConsosHumidite->Annee,
                ],
            ],
        ];
        // $entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

        return $this->sharedOutputFactory->createListImmeublesIndicators($entityToArray);
    }

    public function transformGetImmeubleCET(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkImmeuble' => $dataSourceResult->Immeuble->PkImmeuble,
            'immeubleCET' => [
                'nbCompteursARelever' => $dataSourceResult->ImmeubleCET->NbCompteursARelever,
                'nbCompteursReleves' => $dataSourceResult->ImmeubleCET->NbCompteursReleves,
                'chantier' => [
                    'pkChantier' => $dataSourceResult->ImmeubleCET->Chantier->PkChantier,
                    'pkDevis' => $dataSourceResult->ImmeubleCET->Chantier->PkDevis,
                    'pkImmeuble' => $dataSourceResult->ImmeubleCET->Chantier->PkImmeuble,
                    'dateEntreeChantier' => $dataSourceResult->ImmeubleCET->Chantier->DateEntreeChantier,
                    'nbCompteursPoses' => $dataSourceResult->ImmeubleCET->Chantier->NbCompteursPoses,
                    'nbCompteursCommandes' => $dataSourceResult->ImmeubleCET->Chantier->NbCompteursCommandes,
                ],
                'topConsos' => [
                    'dateReleve' => $dataSourceResult->ImmeubleCET->TopConsos->DateReleve,
                    // consosGrandes et consosPetites sont vides ici, à adapter si structure connue
                ],
                'serieConsos' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleCET->SerieConsos->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleCET->SerieConsos->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleCET->SerieConsos->Annee,
                ],
                // ListeReleves est vide ici, à adapter si structure connue
                'totURepart' => $dataSourceResult->ImmeubleCET->Tot_URepart,
                'totTantChauff' => $dataSourceResult->ImmeubleCET->Tot_TantChauff,
                'puTant' => $dataSourceResult->ImmeubleCET->PU_Tant,
                'prixURepart' => $dataSourceResult->ImmeubleCET->Prix_URepart,
                'prixAbonn' => $dataSourceResult->ImmeubleCET->Prix_Abonn,
                'montARepartTant' => $dataSourceResult->ImmeubleCET->Mont_ARepartTant,
                'partRepartConsos' => $dataSourceResult->ImmeubleCET->Part_RepartConsos,
                'ctCombust' => $dataSourceResult->ImmeubleCET->CT_Combust,
                'serieConsosTotale1' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleCET->SerieConsosTotale1->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleCET->SerieConsosTotale1->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleCET->SerieConsosTotale1->Annee,
                ],
                'serieConsosTotale2' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleCET->SerieConsosTotale2->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleCET->SerieConsosTotale2->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleCET->SerieConsosTotale2->Annee,
                ],
                'serieConsosDJU' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleCET->SerieConsosDJU->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleCET->SerieConsosDJU->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleCET->SerieConsosDJU->Annee,
                ],
            ],
        ];
        // $entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

        return $this->sharedOutputFactory->createListImmeublesIndicators($entityToArray);
    }

    public function transformGetImmeubleEC(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkImmeuble' => $dataSourceResult->Immeuble->PkImmeuble,
            'immeubleEC' => [
                'nbCompteursARelever' => $dataSourceResult->ImmeubleEC->NbCompteursARelever,
                'nbCompteursReleves' => $dataSourceResult->ImmeubleEC->NbCompteursReleves,
                'nbFuites' => $dataSourceResult->ImmeubleEC->NbFuites,
                'degresFuites' => $dataSourceResult->ImmeubleEC->DegresFuites,
                'nbAnomalies' => $dataSourceResult->ImmeubleEC->NbAnomalies,
                'degresAnomalies' => $dataSourceResult->ImmeubleEC->DegresAnomalies,
                'chantier' => [
                    'pkChantier' => $dataSourceResult->ImmeubleEC->Chantier->PkChantier,
                    'pkDevis' => $dataSourceResult->ImmeubleEC->Chantier->PkDevis,
                    'pkImmeuble' => $dataSourceResult->ImmeubleEC->Chantier->PkImmeuble,
                    'dateEntreeChantier' => $dataSourceResult->ImmeubleEC->Chantier->DateEntreeChantier,
                    'nbCompteursPoses' => $dataSourceResult->ImmeubleEC->Chantier->NbCompteursPoses,
                    'nbCompteursCommandes' => $dataSourceResult->ImmeubleEC->Chantier->NbCompteursCommandes,
                ],
                'topConsos' => [
                    'dateReleve' => $dataSourceResult->ImmeubleEC->TopConsos->DateReleve,
                    'consosGrandes' => array_map(fn ($conso) => [
                        'pkLogement' => $conso->PkLogement,
                        'nomOcc' => $conso->NomOcc,
                        'refOcc' => $conso->RefOcc,
                        'fluide' => $conso->Fluide,
                        'conso' => $conso->Conso,
                    ], $dataSourceResult->ImmeubleEC->TopConsos->consosGrandes->conso ?? []),
                    'consosPetites' => array_map(fn ($conso) => [
                        'pkLogement' => $conso->PkLogement,
                        'nomOcc' => $conso->NomOcc,
                        'refOcc' => $conso->RefOcc,
                        'fluide' => $conso->Fluide,
                        'conso' => $conso->Conso,
                    ], $dataSourceResult->ImmeubleEC->TopConsos->consosPetites->conso ?? []),
                ],
                'serieConsos1' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleEC->SerieConsos1->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleEC->SerieConsos1->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleEC->SerieConsos1->Annee,
                ],
                'serieConsos2' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleEC->SerieConsos2->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleEC->SerieConsos2->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleEC->SerieConsos2->Annee,
                ],
                // ListeReleves à compléter si structure connue
            ],
        ];

        // $entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

        return $this->sharedOutputFactory->createListImmeublesIndicators($entityToArray);
    }

    public function transformGetImmeubleEF(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkImmeuble' => $dataSourceResult->Immeuble->PkImmeuble,
            'immeubleEF' => [
                'pkImmeuble' => $dataSourceResult->Immeuble->PkImmeuble,
                'nbCompteursARelever' => $dataSourceResult->ImmeubleEF->NbCompteursARelever,
                'nbCompteursReleves' => $dataSourceResult->ImmeubleEF->NbCompteursReleves,
                'nbFuites' => $dataSourceResult->ImmeubleEF->NbFuites,
                'degresFuites' => $dataSourceResult->ImmeubleEF->DegresFuites,
                'nbAnomalies' => $dataSourceResult->ImmeubleEF->NbAnomalies,
                'degresAnomalies' => $dataSourceResult->ImmeubleEF->DegresAnomalies,
                'chantier' => [
                    'pkChantier' => $dataSourceResult->ImmeubleEF->Chantier->PkChantier,
                    'pkDevis' => $dataSourceResult->ImmeubleEF->Chantier->PkDevis,
                    'pkImmeuble' => $dataSourceResult->ImmeubleEF->Chantier->PkImmeuble,
                    'dateEntreeChantier' => $dataSourceResult->ImmeubleEF->Chantier->DateEntreeChantier,
                    'nbCompteursPoses' => $dataSourceResult->ImmeubleEF->Chantier->NbCompteursPoses,
                    'nbCompteursCommandes' => $dataSourceResult->ImmeubleEF->Chantier->NbCompteursCommandes,
                ],
                'topConsos' => [
                    'dateReleve' => $dataSourceResult->ImmeubleEF->TopConsos->DateReleve,
                    'consosGrandes' => array_map(fn ($conso) => [
                        'pkLogement' => $conso->PkLogement,
                        'nomOcc' => $conso->NomOcc,
                        'refOcc' => $conso->RefOcc,
                        'fluide' => $conso->Fluide,
                        'conso' => $conso->Conso,
                    ], $dataSourceResult->ImmeubleEF->TopConsos->consosGrandes->conso ?? []),
                    'consosPetites' => array_map(fn ($conso) => [
                        'pkLogement' => $conso->PkLogement,
                        'nomOcc' => $conso->NomOcc,
                        'refOcc' => $conso->RefOcc,
                        'fluide' => $conso->Fluide,
                        'conso' => $conso->Conso,
                    ], $dataSourceResult->ImmeubleEF->TopConsos->consosPetites->conso ?? []),
                ],
                'serieConsos1' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleEF->SerieConsos1->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleEF->SerieConsos1->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleEF->SerieConsos1->Annee,
                ],
                'serieConsos2' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleEF->SerieConsos2->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleEF->SerieConsos2->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleEF->SerieConsos2->Annee,
                ],
                // ListeReleves à compléter si structure connue
            ],
        ];
        // $entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

        return $this->sharedOutputFactory->createListImmeublesIndicators($entityToArray);
    }

    public function transformGetImmeubleRepart(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkImmeuble' => $dataSourceResult->Immeuble->PkImmeuble,
            'immeubleRepart' => [
                'nbCompteursARelever' => $dataSourceResult->ImmeubleRepart->NbCompteursARelever,
                'nbCompteursReleves' => $dataSourceResult->ImmeubleRepart->NbCompteursReleves,
                'chantier' => [
                    'pkChantier' => $dataSourceResult->ImmeubleRepart->Chantier->PkChantier,
                    'pkDevis' => $dataSourceResult->ImmeubleRepart->Chantier->PkDevis,
                    'pkImmeuble' => $dataSourceResult->ImmeubleRepart->Chantier->PkImmeuble,
                    'dateEntreeChantier' => $dataSourceResult->ImmeubleRepart->Chantier->DateEntreeChantier,
                    'nbCompteursPoses' => $dataSourceResult->ImmeubleRepart->Chantier->NbCompteursPoses,
                    'nbCompteursCommandes' => $dataSourceResult->ImmeubleRepart->Chantier->NbCompteursCommandes,
                ],
                'topConsos' => [
                    'dateReleve' => $dataSourceResult->ImmeubleRepart->TopConsos->DateReleve,
                    // consosGrandes et consosPetites à compléter si structure connue
                ],
                'serieConsos' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleRepart->SerieConsos->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleRepart->SerieConsos->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleRepart->SerieConsos->Annee,
                ],
                // ListeReleves à compléter si structure connue
                'totURepart' => $dataSourceResult->ImmeubleRepart->Tot_URepart,
                'totTantChauff' => $dataSourceResult->ImmeubleRepart->Tot_TantChauff,
                'puTant' => $dataSourceResult->ImmeubleRepart->PU_Tant,
                'prixURepart' => $dataSourceResult->ImmeubleRepart->Prix_URepart,
                'prixAbonn' => $dataSourceResult->ImmeubleRepart->Prix_Abonn,
                'montARepartTant' => $dataSourceResult->ImmeubleRepart->Mont_ARepartTant,
                'partRepartConsos' => $dataSourceResult->ImmeubleRepart->Part_RepartConsos,
                'ctCombust' => $dataSourceResult->ImmeubleRepart->CT_Combust,
                'serieConsosTotale1' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleRepart->SerieConsosTotale1->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleRepart->SerieConsosTotale1->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleRepart->SerieConsosTotale1->Annee,
                ],
                'serieConsosTotale2' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleRepart->SerieConsosTotale2->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleRepart->SerieConsosTotale2->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleRepart->SerieConsosTotale2->Annee,
                ],
                'serieConsosDJU' => [
                    'defaultIntervalle' => $dataSourceResult->ImmeubleRepart->SerieConsosDJU->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->ImmeubleRepart->SerieConsosDJU->ValeursXYL,
                    'annee' => $dataSourceResult->ImmeubleRepart->SerieConsosDJU->Annee,
                ],
            ],
        ];

        // $entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

        return $this->sharedOutputFactory->createListImmeublesIndicators($entityToArray);
    }

    public function transformGetImmeubleSerieConsosEAU(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkImmeuble' => $dataSourceResult->Immeuble->PkImmeuble,
            'defaultIntervalle' => $dataSourceResult->SerieConsosEAU->DefaultIntervalle,
            'valeursXYL' => $dataSourceResult->SerieConsosEAU->ValeursXYL,
            'anne' => $dataSourceResult->SerieConsosEAU->Annee,
        ];
        // $entities = $this->entityFactory->createManyImmeublesIndocatorsFromRawList($immeublesRaw);

        return $this->sharedOutputFactory->createListImmeublesIndicators($entityToArray);
    }
}
