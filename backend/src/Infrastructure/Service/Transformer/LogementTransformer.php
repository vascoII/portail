<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Logement\ListLogementsOuputDto;
use App\Application\Dto\Output\Logement\LogementOutputDto;
use App\Application\Factory\Logement\LogementEntityFactory;
use App\Application\Factory\Logement\LogementOutputFactory;
use App\Application\Service\Transformer\LogementTransformerInterface;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;
use App\Application\Factory\Shared\SharedOutputFactory;

final class LogementTransformer implements LogementTransformerInterface
{
    public function __construct(
        private readonly LogementEntityFactory $entityFactory,
        private readonly LogementOutputFactory $outputFactory,
        private readonly SharedOutputFactory $sharedOutputFactory
    ) {}

    public function transformGetLogement(object $dataSourceResult): LogementOutputDto
    {
        $entity = $this->entityFactory->createLogementFromRaw($dataSourceResult);

        return $this->outputFactory->createGetLogement($entity);
    }

    public function transformListLogements(object $dataSourceResult): ListLogementsOuputDto
    {
        $logementsRaw = is_array($rawLogement = $dataSourceResult->ListeInfosLogements->infosLogement ?? null)
           ? $rawLogement : ($rawLogement ? [$rawLogement] : []);

        $entities = $this->entityFactory->createManyLogementsFromRawList($logementsRaw);

        return $this->outputFactory->createListLogements($entities);
    }

    public function transformGetLogementCapteur(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkLogement' => $dataSourceResult->Logement->PkLogement,
            'logementCapteur' => [
                'IndexRecapTemperature' => [
                    'date' => $dataSourceResult->LogementCapteur->IndexRecapTemperature->Date,
                    'moy' => $dataSourceResult->LogementCapteur->IndexRecapTemperature->Moy,
                    'max' => $dataSourceResult->LogementCapteur->IndexRecapTemperature->Max,
                    'min' => $dataSourceResult->LogementCapteur->IndexRecapTemperature->Min,
                ],
                'IndexRecapHumidite' => [
                    'date' => $dataSourceResult->LogementCapteur->IndexRecapHumidite->Date,
                    'moy' => $dataSourceResult->LogementCapteur->IndexRecapHumidite->Moy,
                    'max' => $dataSourceResult->LogementCapteur->IndexRecapHumidite->Max,
                    'min' => $dataSourceResult->LogementCapteur->IndexRecapHumidite->Min,
                ],
                'SerieConsosTemperature' => [
                    'erreur' => $dataSourceResult->LogementCapteur->SerieConsosTemperature->Erreur,
                    'info' => $dataSourceResult->LogementCapteur->SerieConsosTemperature->Info,
                    'defaultIntervalle' => $dataSourceResult->LogementCapteur->SerieConsosTemperature->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->LogementCapteur->SerieConsosTemperature->ValeursXYL,
                    'annee' => $dataSourceResult->LogementCapteur->SerieConsosTemperature->Annee,
                ],
                'SerieConsosHumidite' => [
                    'erreur' => $dataSourceResult->LogementCapteur->SerieConsosHumidite->Erreur,
                    'info' => $dataSourceResult->LogementCapteur->SerieConsosHumidite->Info,
                    'defaultIntervalle' => $dataSourceResult->LogementCapteur->SerieConsosHumidite->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->LogementCapteur->SerieConsosHumidite->ValeursXYL,
                    'annee' => $dataSourceResult->LogementCapteur->SerieConsosHumidite->Annee,
                ],
            ],
        ];

        return $this->sharedOutputFactory->createListIndicators($entityToArray);
    }

    public function transformGetLogementCET(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkLogement' => $dataSourceResult->Logement->PkLogement,
            'logementCET' => [
                'ListeInfosAppareils' => $dataSourceResult->LogementCET->ListeInfosAppareils,
                'Tot_URepart' => $dataSourceResult->LogementCET->Tot_URepart,
                'Tot_TantChauff' => $dataSourceResult->LogementCET->Tot_TantChauff,
                'PU_Tant' => $dataSourceResult->LogementCET->PU_Tant,
                'Prix_URepart' => $dataSourceResult->LogementCET->Prix_URepart,
                'Prix_Abonn' => $dataSourceResult->LogementCET->Prix_Abonn,
                'Mont_ARepartTant' => $dataSourceResult->LogementCET->Mont_ARepartTant,
                'Part_RepartConsos' => $dataSourceResult->LogementCET->Part_RepartConsos,
                'CT_Combust' => $dataSourceResult->LogementCET->CT_Combust,
                'URepartLog' => $dataSourceResult->LogementCET->URepartLog,
                'TantLog' => $dataSourceResult->LogementCET->TantLog,
                'Prix_ChauffTantLog' => $dataSourceResult->LogementCET->Prix_ChauffTantLog,
                'CT_ChauffLog' => $dataSourceResult->LogementCET->CT_ChauffLog,
                'SerieConsosDJU' => [
                    'erreur' => $dataSourceResult->LogementCET->SerieConsosDJU->Erreur,
                    'info' => $dataSourceResult->LogementCET->SerieConsosDJU->Info,
                    'defaultIntervalle' => $dataSourceResult->LogementCET->SerieConsosDJU->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->LogementCET->SerieConsosDJU->ValeursXYL,
                    'annee' => $dataSourceResult->LogementCET->SerieConsosDJU->Annee,
                ],
            ],
        ];

        return $this->sharedOutputFactory->createListIndicators($entityToArray);
    }

    public function transformGetLogementEC(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkLogement' => $dataSourceResult->Logement->PkLogement,
            'logementEC' => [
                'NbFuites' => $dataSourceResult->LogementEC->NbFuites,
                'NbAnomalies' => $dataSourceResult->LogementEC->NbAnomalies,
                'ConsoPeriode' => [
                    'Conso' => $dataSourceResult->LogementEC->ConsoPeriode->Conso,
                    'DateDeb' => $dataSourceResult->LogementEC->ConsoPeriode->DateDeb,
                    'DateFin' => $dataSourceResult->LogementEC->ConsoPeriode->DateFin,
                    'R5' => [
                        'DateReleve' => $dataSourceResult->LogementEC->ConsoPeriode->R5->DateReleve,
                        'Index' => $dataSourceResult->LogementEC->ConsoPeriode->R5->Index,
                        'Conso' => $dataSourceResult->LogementEC->ConsoPeriode->R5->Conso,
                    ],
                    'R4' => [
                        'DateReleve' => $dataSourceResult->LogementEC->ConsoPeriode->R4->DateReleve,
                        'Index' => $dataSourceResult->LogementEC->ConsoPeriode->R4->Index,
                        'Conso' => $dataSourceResult->LogementEC->ConsoPeriode->R4->Conso,
                    ],
                    'R3' => [
                        'DateReleve' => $dataSourceResult->LogementEC->ConsoPeriode->R3->DateReleve,
                        'Index' => $dataSourceResult->LogementEC->ConsoPeriode->R3->Index,
                        'Conso' => $dataSourceResult->LogementEC->ConsoPeriode->R3->Conso,
                    ],
                    'R2' => [
                        'DateReleve' => $dataSourceResult->LogementEC->ConsoPeriode->R2->DateReleve,
                        'Index' => $dataSourceResult->LogementEC->ConsoPeriode->R2->Index,
                        'Conso' => $dataSourceResult->LogementEC->ConsoPeriode->R2->Conso,
                    ],
                    'R1' => [
                        'DateReleve' => $dataSourceResult->LogementEC->ConsoPeriode->R1->DateReleve,
                        'Index' => $dataSourceResult->LogementEC->ConsoPeriode->R1->Index,
                        'Conso' => $dataSourceResult->LogementEC->ConsoPeriode->R1->Conso,
                    ],
                    'VAR4' => $dataSourceResult->LogementEC->ConsoPeriode->VAR4,
                    'VAR3' => $dataSourceResult->LogementEC->ConsoPeriode->VAR3,
                    'VAR2' => $dataSourceResult->LogementEC->ConsoPeriode->VAR2,
                    'VAR1' => $dataSourceResult->LogementEC->ConsoPeriode->VAR1,
                    'DegresVAR4' => $dataSourceResult->LogementEC->ConsoPeriode->DegresVAR4,
                    'DegresVAR3' => $dataSourceResult->LogementEC->ConsoPeriode->DegresVAR3,
                    'DegresVAR2' => $dataSourceResult->LogementEC->ConsoPeriode->DegresVAR2,
                    'DegresVAR1' => $dataSourceResult->LogementEC->ConsoPeriode->DegresVAR1,
                ],
                'ListeInfosAppareils' => $dataSourceResult->LogementEC->ListeInfosAppareils,
                'SerieConsos' => [
                    'erreur' => $dataSourceResult->LogementEC->SerieConsos->Erreur,
                    'info' => $dataSourceResult->LogementEC->SerieConsos->Info,
                    'defaultIntervalle' => $dataSourceResult->LogementEC->SerieConsos->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->LogementEC->SerieConsos->ValeursXYL,
                    'annee' => $dataSourceResult->LogementEC->SerieConsos->Annee,
                ],
                'ConsoMemeTypeLogement' => $dataSourceResult->LogementEC->ConsoMemeTypeLogement,
            ],
        ];

        return $this->sharedOutputFactory->createListIndicators($entityToArray);
    }

    public function transformGetLogementEF(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkLogement' => $dataSourceResult->Logement->PkLogement,
            'logementEF' => [
                'NbFuites' => $dataSourceResult->LogementEF->NbFuites,
                'NbAnomalies' => $dataSourceResult->LogementEF->NbAnomalies,
                'ConsoPeriode' => [
                    'Conso' => $dataSourceResult->LogementEF->ConsoPeriode->Conso,
                    'DateDeb' => $dataSourceResult->LogementEF->ConsoPeriode->DateDeb,
                    'DateFin' => $dataSourceResult->LogementEF->ConsoPeriode->DateFin,
                    'R5' => [
                        'DateReleve' => $dataSourceResult->LogementEF->ConsoPeriode->R5->DateReleve,
                        'Index' => $dataSourceResult->LogementEF->ConsoPeriode->R5->Index,
                        'Conso' => $dataSourceResult->LogementEF->ConsoPeriode->R5->Conso,
                    ],
                    'R4' => [
                        'DateReleve' => $dataSourceResult->LogementEF->ConsoPeriode->R4->DateReleve,
                        'Index' => $dataSourceResult->LogementEF->ConsoPeriode->R4->Index,
                        'Conso' => $dataSourceResult->LogementEF->ConsoPeriode->R4->Conso,
                    ],
                    'R3' => [
                        'DateReleve' => $dataSourceResult->LogementEF->ConsoPeriode->R3->DateReleve,
                        'Index' => $dataSourceResult->LogementEF->ConsoPeriode->R3->Index,
                        'Conso' => $dataSourceResult->LogementEF->ConsoPeriode->R3->Conso,
                    ],
                    'R2' => [
                        'DateReleve' => $dataSourceResult->LogementEF->ConsoPeriode->R2->DateReleve,
                        'Index' => $dataSourceResult->LogementEF->ConsoPeriode->R2->Index,
                        'Conso' => $dataSourceResult->LogementEF->ConsoPeriode->R2->Conso,
                    ],
                    'R1' => [
                        'DateReleve' => $dataSourceResult->LogementEF->ConsoPeriode->R1->DateReleve,
                        'Index' => $dataSourceResult->LogementEF->ConsoPeriode->R1->Index,
                        'Conso' => $dataSourceResult->LogementEF->ConsoPeriode->R1->Conso,
                    ],
                    'VAR4' => $dataSourceResult->LogementEF->ConsoPeriode->VAR4,
                    'VAR3' => $dataSourceResult->LogementEF->ConsoPeriode->VAR3,
                    'VAR2' => $dataSourceResult->LogementEF->ConsoPeriode->VAR2,
                    'VAR1' => $dataSourceResult->LogementEF->ConsoPeriode->VAR1,
                    'DegresVAR4' => $dataSourceResult->LogementEF->ConsoPeriode->DegresVAR4,
                    'DegresVAR3' => $dataSourceResult->LogementEF->ConsoPeriode->DegresVAR3,
                    'DegresVAR2' => $dataSourceResult->LogementEF->ConsoPeriode->DegresVAR2,
                    'DegresVAR1' => $dataSourceResult->LogementEF->ConsoPeriode->DegresVAR1,
                ],
                'ListeInfosAppareils' => $dataSourceResult->LogementEF->ListeInfosAppareils,
                'SerieConsos' => [
                    'erreur' => $dataSourceResult->LogementEF->SerieConsos->Erreur,
                    'info' => $dataSourceResult->LogementEF->SerieConsos->Info,
                    'defaultIntervalle' => $dataSourceResult->LogementEF->SerieConsos->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->LogementEF->SerieConsos->ValeursXYL,
                    'annee' => $dataSourceResult->LogementEF->SerieConsos->Annee,
                ],
                'ConsoMemeTypeLogement' => $dataSourceResult->LogementEF->ConsoMemeTypeLogement,
            ],
        ];

        return $this->sharedOutputFactory->createListIndicators($entityToArray);
    }

    public function transformGetLogementRepart(object $dataSourceResult): ListIndicatorsOuputDto
    {
        $entityToArray = [
            'pkLogement' => $dataSourceResult->Logement->PkLogement,
            'logementRepart' => [
                'ListeInfosAppareils' => $dataSourceResult->LogementRepart->ListeInfosAppareils,
                'Tot_URepart' => $dataSourceResult->LogementRepart->Tot_URepart,
                'Tot_TantChauff' => $dataSourceResult->LogementRepart->Tot_TantChauff,
                'PU_Tant' => $dataSourceResult->LogementRepart->PU_Tant,
                'Prix_URepart' => $dataSourceResult->LogementRepart->Prix_URepart,
                'Prix_Abonn' => $dataSourceResult->LogementRepart->Prix_Abonn,
                'Mont_ARepartTant' => $dataSourceResult->LogementRepart->Mont_ARepartTant,
                'Part_RepartConsos' => $dataSourceResult->LogementRepart->Part_RepartConsos,
                'CT_Combust' => $dataSourceResult->LogementRepart->CT_Combust,
                'URepartLog' => $dataSourceResult->LogementRepart->URepartLog,
                'TantLog' => $dataSourceResult->LogementRepart->TantLog,
                'Prix_ChauffTantLog' => $dataSourceResult->LogementRepart->Prix_ChauffTantLog,
                'CT_ChauffLog' => $dataSourceResult->LogementRepart->CT_ChauffLog,
                'SerieConsosDJU' => [
                    'erreur' => $dataSourceResult->LogementRepart->SerieConsosDJU->Erreur,
                    'info' => $dataSourceResult->LogementRepart->SerieConsosDJU->Info,
                    'defaultIntervalle' => $dataSourceResult->LogementRepart->SerieConsosDJU->DefaultIntervalle,
                    'valeursXYL' => $dataSourceResult->LogementRepart->SerieConsosDJU->ValeursXYL,
                    'annee' => $dataSourceResult->LogementRepart->SerieConsosDJU->Annee,
                ],
                'ConsosPieces' => $dataSourceResult->LogementRepart->ConsosPieces,
            ],
        ];

        return $this->sharedOutputFactory->createListIndicators($entityToArray);
    }
}
