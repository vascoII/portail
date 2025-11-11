/**
 * DTO for user entity
 * Corresponds to: App\Application\Dto\Output\Shared\UserResponseDto
 */
export interface UserResponseDto {
  loginId: string | null;
  userName: string | null;
  email: string | null;
  userType: string | null;
  pkUser: number | null;
  adresse: string | null;
  cp: string | null;
  ville: string | null;
  fk: number | null;
  phoneNumber: string | null;
  firstName: string | null;
  userRole: string | null;
  clientName: string | null;
  clientId: string | null;
  cgu: string | null;
  fkClient: number | null;
  fkClientTop: number | null;
  nbImmeubles: number | null;
  seuilConsoEf: number | null;
  seuilConsoEc: number | null;
  seuilConsoRepart: number | null;
  seuilConsoCet: number | null;
  seuilConsoActif: boolean | null;
  seuilConsoEmail: string | null;
  showImmeublesArc: boolean | null;
  showFactures: boolean | null;
  showChgtOccupant: boolean | null;
  showChantiers: boolean | null;
}

