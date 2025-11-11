#!/bin/bash
# Script pour créer la structure de dossiers et fichiers TypeScript
# correspondant aux DTOs du backend

BASE_DIR="src/types/api"

# Créer tous les dossiers
mkdir -p "${BASE_DIR}"/{Document,External,Facture,Immeuble,Intervention,Logement,Occupant,Operator,Parc,Security,Shared}

# Créer tous les fichiers TypeScript
# Document
touch "${BASE_DIR}/Document/GetReportExcelDataSourceDto.ts"
touch "${BASE_DIR}/Document/GetReportExcelDto.ts"

# External
touch "${BASE_DIR}/External/GeneratedDocumentDto.ts"
touch "${BASE_DIR}/External/GetReportByTokenDataSourceDto.ts"
touch "${BASE_DIR}/External/GetReportByTokenDto.ts"
touch "${BASE_DIR}/External/StoredDocumentDto.ts"

# Facture
touch "${BASE_DIR}/Facture/ListFacturesDto.ts"

# Immeuble
touch "${BASE_DIR}/Immeuble/GetImmeubleDto.ts"
touch "${BASE_DIR}/Immeuble/ListImmeublesDto.ts"
touch "${BASE_DIR}/Immeuble/ListLogementsDto.ts"

# Intervention
touch "${BASE_DIR}/Intervention/ListCasesDto.ts"

# Logement
touch "${BASE_DIR}/Logement/ListLogementsDto.ts"
touch "${BASE_DIR}/Logement/LogementDto.ts"

# Occupant
touch "${BASE_DIR}/Occupant/GetOccupantAccountDto.ts"
touch "${BASE_DIR}/Occupant/GetOccupantDto.ts"

# Operator
touch "${BASE_DIR}/Operator/CreateGestionnaireDto.ts"
touch "${BASE_DIR}/Operator/DeleteUserDto.ts"
touch "${BASE_DIR}/Operator/GetOperatorDto.ts"
touch "${BASE_DIR}/Operator/ListOperatorsDto.ts"
touch "${BASE_DIR}/Operator/SetImmeublesDto.ts"
touch "${BASE_DIR}/Operator/UpdateUserDto.ts"

# Parc
touch "${BASE_DIR}/Parc/GetParcDto.ts"

# Security
touch "${BASE_DIR}/Security/CreateDto.ts"
touch "${BASE_DIR}/Security/LoginDto.ts"
touch "${BASE_DIR}/Security/LogoutDto.ts"
touch "${BASE_DIR}/Security/ResetOrCreateDto.ts"
touch "${BASE_DIR}/Security/ResetPasswordFromPKUserDto.ts"
touch "${BASE_DIR}/Security/ResetPasswordDto.ts"
touch "${BASE_DIR}/Security/UpdatePasswordDto.ts"

# Shared
touch "${BASE_DIR}/Shared/GetDetailsDepannageDto.ts"
touch "${BASE_DIR}/Shared/GetDocumentPathDto.ts"
touch "${BASE_DIR}/Shared/GetExcelDto.ts"
touch "${BASE_DIR}/Shared/GetReportByTokenDto.ts"
touch "${BASE_DIR}/Shared/GetReportDto.ts"
touch "${BASE_DIR}/Shared/ListAlertesDto.ts"
touch "${BASE_DIR}/Shared/ListAnomaliesDto.ts"
touch "${BASE_DIR}/Shared/ListDysfonctionnementsDto.ts"
touch "${BASE_DIR}/Shared/ListFuitesDto.ts"
touch "${BASE_DIR}/Shared/ListIndicatorsOuputDto.ts"
touch "${BASE_DIR}/Shared/ListInterventionsDto.ts"
touch "${BASE_DIR}/Shared/SessionDto.ts"
touch "${BASE_DIR}/Shared/SuccessDto.ts"
touch "${BASE_DIR}/Shared/UserDto.ts"

echo "✅ Structure créée avec succès dans ${BASE_DIR}"
echo "📁 $(find ${BASE_DIR} -type d | wc -l) dossiers créés"
echo "📄 $(find ${BASE_DIR} -type f -name '*.ts' | wc -l) fichiers créés"

