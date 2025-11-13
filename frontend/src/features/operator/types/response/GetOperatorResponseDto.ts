/**
 * DTO for getting a single operator
 * Corresponds to: App\Application\Dto\Output\Operator\GetOperatorOutputDto
 */
export interface GetOperatorResponseDto {
  userName: string;
  email: string;
  userType: string;
  pkUser: number;
  adresse: string;
  cp: string;
  ville: string;
  fk: number;
  phoneNumber: string;
  firstName: string;
  userRole: string;
  clientName: string;
  clientId: string;
  cgu: string;
  fkClient: number;
  fkClientTop: number;
  nbImmeubles: number;
  seuilConsoEf: number;
  seuilConsoEc: number;
  seuilConsoRepart: number;
  seuilConsoCet: number;
  seuilConsoActif: boolean;
  seuilConsoEmail: string;
  showImmeublesArc: boolean;
  showFactures: boolean;
  showChgtOccupant: boolean;
  showChantiers: boolean;
}

