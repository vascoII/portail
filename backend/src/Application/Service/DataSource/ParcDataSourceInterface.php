<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

interface ParcDataSourceInterface
{
  public function fetchGetParc(): object;
  public function fetchListParcInterventions(): object;
  public function fetchGetParcIndicators(): object;
  public function fetchGetParcCapteur(): object;
  public function fetchGetParcCET(): object;
  public function fetchGetParcEC(): object;
  public function fetchGetParcEF(): object;
  public function fetchGetParcElect(): object;
  public function fetchGetParcGaz(): object;
  public function fetchGetParcRepart(): object;
  public function fetchGetParcSerieConsosCompteurGeneral(): object;
  public function fetchGetParcSerieConsosEAU(): object;
}
