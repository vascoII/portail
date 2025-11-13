/**
 * DTO for login output
 * Corresponds to: App\Application\Dto\Output\Security\LoginOutputDto
 */
export interface LoginResponseDto {
  tokenJwt: string;
  loginId: string | null;
  userName: string | null;
  email: string | null;
  userType: string | null;
  adresse: string | null;
  cp: string | null;
  ville: string | null;
  phoneNumber: string | null;
  firstName: string | null;
  userRole: string | null;
  clientName: string | null;
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

