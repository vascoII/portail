#!/bin/bash

# Script pour tester la configuration API

echo "🧪 Test de la configuration API..."

# Test 1: Vérifier que le fichier .env.local existe
echo "1. Test du fichier .env.local..."
if [ -f ".env.local" ]; then
  echo "   ✅ Fichier .env.local trouvé"
else
  echo "   ❌ Fichier .env.local manquant"
  exit 1
fi

# Test 2: Vérifier les variables d'environnement
echo "2. Test des variables d'environnement..."
if grep -q "NEXT_PUBLIC_API_BASE_URL=http://localhost:8000" .env.local; then
  echo "   ✅ NEXT_PUBLIC_API_BASE_URL configuré correctement"
else
  echo "   ❌ NEXT_PUBLIC_API_BASE_URL mal configuré"
fi

if grep -q "NEXT_PUBLIC_API_VERSION=v1" .env.local; then
  echo "   ✅ NEXT_PUBLIC_API_VERSION configuré correctement"
else
  echo "   ❌ NEXT_PUBLIC_API_VERSION mal configuré"
fi

# Test 3: Vérifier le fichier de configuration API
echo "3. Test du fichier de configuration API..."
if [ -f "app/config/api.ts" ]; then
  echo "   ✅ Fichier app/config/api.ts trouvé"
else
  echo "   ❌ Fichier app/config/api.ts manquant"
  exit 1
fi

# Test 4: Vérifier les endpoints d'authentification
echo "4. Test des endpoints d'authentification..."
if grep -q "AUTH_ENDPOINTS" app/config/api.ts; then
  echo "   ✅ AUTH_ENDPOINTS configuré"
else
  echo "   ❌ AUTH_ENDPOINTS manquant"
fi

if grep -q "LOGIN:" app/config/api.ts; then
  echo "   ✅ Endpoint LOGIN configuré"
else
  echo "   ❌ Endpoint LOGIN manquant"
fi

if grep -q "RESET_PASSWORD:" app/config/api.ts; then
  echo "   ✅ Endpoint RESET_PASSWORD configuré"
else
  echo "   ❌ Endpoint RESET_PASSWORD manquant"
fi

# Test 5: Vérifier que useAuth utilise la configuration
echo "5. Test de l'utilisation de la configuration dans useAuth..."
if grep -q "AUTH_ENDPOINTS" app/hooks/useAuth.ts; then
  echo "   ✅ useAuth utilise AUTH_ENDPOINTS"
else
  echo "   ❌ useAuth n'utilise pas AUTH_ENDPOINTS"
fi

if grep -q "DEFAULT_HEADERS" app/hooks/useAuth.ts; then
  echo "   ✅ useAuth utilise DEFAULT_HEADERS"
else
  echo "   ❌ useAuth n'utilise pas DEFAULT_HEADERS"
fi

# Test 6: Vérifier que reset-password utilise la configuration
echo "6. Test de l'utilisation de la configuration dans reset-password..."
if grep -q "AUTH_ENDPOINTS" app/pages/reset-password/page.tsx; then
  echo "   ✅ reset-password utilise AUTH_ENDPOINTS"
else
  echo "   ❌ reset-password n'utilise pas AUTH_ENDPOINTS"
fi

# Test 7: Vérifier la construction des URLs
echo "7. Test de la construction des URLs..."
if grep -q "http://localhost:8000" app/config/api.ts; then
  echo "   ✅ URL du backend configurée correctement"
else
  echo "   ❌ URL du backend mal configurée"
fi

# Test 8: Vérifier les headers par défaut
echo "8. Test des headers par défaut..."
if grep -q "Content-Type.*application/json" app/config/api.ts; then
  echo "   ✅ Headers par défaut configurés"
else
  echo "   ❌ Headers par défaut manquants"
fi

# Test 9: Vérifier la gestion d'erreurs
echo "9. Test de la gestion d'erreurs..."
if grep -q "handleApiError" app/config/api.ts; then
  echo "   ✅ Fonction handleApiError configurée"
else
  echo "   ❌ Fonction handleApiError manquante"
fi

# Test 10: Vérifier les types TypeScript
echo "10. Test des types TypeScript..."
if grep -q "ApiResponse" app/config/api.ts; then
  echo "   ✅ Types ApiResponse configurés"
else
  echo "   ❌ Types ApiResponse manquants"
fi

if grep -q "ApiError" app/config/api.ts; then
  echo "   ✅ Types ApiError configurés"
else
  echo "   ❌ Types ApiError manquants"
fi

echo "🎉 Tests de la configuration API terminés avec succès !"

