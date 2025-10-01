<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Logement\GetTableauBordLogementInputDto;
use App\Application\Dto\Input\Logement\GetNbTicketsInterByLogementInputDto;
use App\Application\Dto\Input\Logement\SetOccupants4ChgtInputDto;
use App\Application\Dto\Input\Logement\GetOccupants4ChgtInputDto;
use App\Application\Dto\Input\Logement\SetSeuilConsoInputDto;
use App\Application\Dto\Input\Logement\GetStatOccupantsGraphInputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilsByLogementInpuDto;
use App\Application\Dto\Input\Logement\GetInfosLogementsInputDto;

interface LogementDataSourceInterface
{

//  public function fetchIndex(IndexInputDto $inputDto): object;
//  public function fetchShow(ShowInputDto $inputDto): object;
//  public function fetchSearch(SearchInputDto $inputDto): object;
//  public function fetchListInterventions(InterventionsInputDto $inputDto): object;
//  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object;
//  public function fetchListLeaks(LeaksInputDto $inputDto): object;
//  public function fetchListDysfunctions(DysfunctionsInputDto $inputDto): object;
//  public function fetchListAnomalies(AnomaliesInputDto $inputDto): object;
//  public function fetchFilterResult(FilterResultInputDto $inputDto): object;
//  public function fetchEdit(EditInputDto $inputDto): object;
//  public function fetchCreateTicket(CreateTicketInputDto $inputDto): object;
//  public function fetchCreateTicketImmeuble(CreateTicketImmeubleInputDto $inputDto): object;
//  public function fetchGetTicketOnwer(GetTicketOnwerInputDto $inputDto): object;
//  public function fetchGuide(GuideInputDto $inputDto): object;
//  public function fetchGetInfosAppareil(GetInfosAppareilInputDto $inputDto): object;
//  public function fetchShowRepartReleve(ShowRepartReleveInputDto $inputDto): object;

    public function fetchGetTableauBordLogement(GetTableauBordLogementInputDto $inputDto): object;
		public function fetchGetNbTicketsInterByLogement(GetNbTicketsInterByLogementInputDto $inputDto): object;
		public function fetchsetOccupants4Chgt(SetOccupants4ChgtInputDto $inputDto): object;
		public function fetchgetOccupants4Chgt(GetOccupants4ChgtInputDto $inputDto): object;
		public function fetchSetSeuilConso(SetSeuilConsoInputDto $inputDto): object;
		public function fetchGetStatOccupantsGraph(GetStatOccupantsGraphInputDto $inputDto): object;
		public function fetchGetInfosAppareilsByLogement(GetInfosAppareilsByLogementInpuDto $inputDto): object;
		public function fetchGetInfosLogements(GetInfosLogementsInputDto $inputDto): object;
}
