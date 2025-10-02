<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Domain\Entity\SousTraitant;
use App\Application\Dto\Output\Admin\GetSousTraitantsOutputDto;

final class FrontTransformer
{
   /**
    * Transform raw response to CguOutputDto
    */
   public function transformPersonalData(object $dataSourceResult): GetSousTraitantsOutputDto
   {
      $rawList = (array) $dataSourceResult->ListeSousTraitant;

      // Normalisation : si 'sousTraitant' est un tableau ou un objet unique
      $sousTraitants = $rawList['sousTraitants'] ?? [];
      if (!is_array($sousTraitants)) {
         $sousTraitants = [$sousTraitants];
      }

      $dtoList = [];

      foreach ($sousTraitants as $sousTraitant) {
         $dtoList[] = new SousTraitant(
               nom: (string) $sousTraitant->Nom,
               description: (string) $sousTraitant->Description,
               territoires: (string) $sousTraitant->Territoires,
               pays: (string) $sousTraitant->Pays,
               adresse: (string) $sousTraitant->Adresse,
               cp: (string) $sousTraitant->CP,
               ville: (string) $sousTraitant->Ville,
               protection: (string) $sousTraitant->Protection
         );
      }

      return new GetSousTraitantsOutputDto(
         sousTraitants:  $dtoList
      );
   }

}
