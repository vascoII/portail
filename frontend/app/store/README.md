# Data Store

This directory contains the global state management for the application using Zustand.

## Files

- `dataStore.ts` - Main data store implementation

## Usage

### Import the store

```typescript
import { useDataStore } from "../store/dataStore";
```

### Access login data

```typescript
const { loginData, setLoginData, clearLoginData } = useDataStore();

// Access stored login data
if (loginData) {
  console.log("User name:", loginData.userName);
  console.log("Client name:", loginData.clientName);
  console.log("Number of buildings:", loginData.nbImmeubles);
}

// Store new login data (usually done automatically by useAuth hook)
setLoginData(loginDataFromBackend);

// Clear login data (usually done automatically by logout)
clearLoginData();
```

### LoginOutputDto Interface

The stored data matches the backend `LoginOutputDto` structure:

```typescript
interface LoginOutputDto {
  tokenJwt: string;
  loginId?: string | null;
  userName?: string | null;
  email?: string | null;
  userType?: string | null;
  adresse?: string | null;
  cp?: string | null;
  ville?: string | null;
  phoneNumber?: string | null;
  firstName?: string | null;
  userRole?: string | null;
  clientName?: string | null;
  nbImmeubles?: number | null;
  seuilConsoEf?: number | null;
  seuilConsoEc?: number | null;
  seuilConsoRepart?: number | null;
  seuilConsoCet?: number | null;
  seuilConsoActif?: boolean | null;
  seuilConsoEmail?: string | null;
  showImmeublesArc?: boolean | null;
  showFactures?: boolean | null;
  showChgtOccupant?: boolean | null;
  showChantiers?: boolean | null;
}
```

## Persistence

The data store uses Zustand's persist middleware to automatically save data to localStorage and restore it on page reload.

## Integration with Authentication

The data store is automatically updated by the `useAuth` hook:

- **Login**: Stores the complete `LoginOutputDto` from the backend
- **Logout**: Clears all stored data
- **Page reload**: Restores data from localStorage

## Example Components

- `UserProfile.tsx` - Example component showing how to display stored user data
- `LoginPage.tsx` - Shows debug information of stored data (remove in production)
