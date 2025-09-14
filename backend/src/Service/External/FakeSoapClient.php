<?php

namespace App\Service\External;

use App\Dto\ImmeubleDto;

class FakeSoapClient
{
  /**
   * Simule un appel SOAP pour récupérer les indicateurs d'un immeuble
   * 
   * @param int $immeubleId
   * @return array Data brute style SOAP
   */
  public function getIndicatorsByImmeubleId(int $immeubleId): array
  {
    sleep(5);
    // Fake response pour le POC
    return [
      [
        'kpi_id' => 1,
        'kpi_name' => 'Consommation Eau',
        'kpi_value' => 320.5,
        'updated_at' => '2025-09-14T12:30:00+00:00',
      ],
      [
        'kpi_id' => 2,
        'kpi_name' => 'Consommation Électricité',
        'kpi_value' => 1025.2,
        'updated_at' => '2025-09-14T12:45:00+00:00',
      ],
      [
        'kpi_id' => 3,
        'kpi_name' => 'Gaz',
        'kpi_value' => 210.0,
        'updated_at' => '2025-09-14T12:50:00+00:00',
      ],
    ];
  }

  public function findOneByImmeubleId(int $immeubleId): ImmeubleDto
  {
    return new ImmeubleDto(
      id: $immeubleId,
      name: "Résidence Les Tilleuls",
      address: "12 rue des Fleurs, Paris",
      numApartments: 24,
    );
  }
}
