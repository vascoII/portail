/**
 * DTO for User entity (domain entity)
 * Corresponds to: App\Domain\Entity\User
 * Note: This is different from UserResponseDto which is a shared DTO
 */
export interface UserEntityResponseDto {
  loginId: string | null;
  userName: string | null;
  password: string | null;
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
  expirationDate: string | null; // ISO date string (DateTimeImmutable in PHP)
  passwordExpirationDate: string | null; // ISO date string (DateTimeImmutable in PHP)
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

