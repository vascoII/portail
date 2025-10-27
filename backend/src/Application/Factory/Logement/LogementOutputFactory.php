<?php

declare(strict_types=1);

namespace App\Application\Factory\Logement;

use App\Application\Dto\Output\Logement\ListLogementsOuputDto;
use App\Application\Dto\Output\Logement\LogementOutputDto;
use App\Domain\Entity\Logement;


final class LogementOutputFactory 
{
    /**
     * @param Logement[] $logements
     */
    public function createListLogements(array $logements): ListLogementsOuputDto
    {
        return new ListLogementsOuputDto($logements);
    }

   
    /**
     * @param array $logement
     */
    public function createGetLogement(array $logement): LogementOutputDto
    {
        return new LogementOutputDto($logement);
    }

    
}
