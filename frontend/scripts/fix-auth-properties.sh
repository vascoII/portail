#!/bin/bash

# Script pour corriger les propriétés d'authentification
# Remplace 'loading' par 'isLoading' dans les composants utilisant useAuth

echo "🔧 Correction des propriétés d'authentification..."

# Fonction pour corriger un fichier
fix_auth_file() {
  local file="$1"
  local changes=0
  
  echo "  📝 Vérification de $file"
  
  # Vérifier si le fichier utilise useAuth
  if grep -q "useAuth" "$file"; then
    # Remplacer loading par isLoading dans la destructuration
    if sed -i '' 's/const { \([^}]*\)loading\([^}]*\) } = useAuth();/const { \1isLoading\2 } = useAuth();/g' "$file"; then
      changes=$((changes + 1))
    fi
    
    # Remplacer les utilisations de loading par isLoading
    if sed -i '' 's/\bloading\b/isLoading/g' "$file"; then
      changes=$((changes + 1))
    fi
    
    if [ $changes -gt 0 ]; then
      echo "    ✅ $changes corrections appliquées"
    else
      echo "    ℹ️  Aucune correction nécessaire"
    fi
  else
    echo "    ℹ️  Fichier n'utilise pas useAuth"
  fi
}

total_files=0
total_changes=0

# Trouver et corriger tous les fichiers TypeScript/TSX
echo "📄 Vérification des fichiers..."
find app/ -name "*.tsx" -o -name "*.ts" | while read file; do
  total_files=$((total_files + 1))
  fix_auth_file "$file"
done

echo "✅ Correction terminée"

# Vérifier qu'il ne reste plus d'utilisations incorrectes
remaining_loading=$(grep -r "loading.*useAuth\|useAuth.*loading" app/ --include="*.tsx" --include="*.ts" | wc -l)
remaining_loading_usage=$(grep -r "\bloading\b" app/ --include="*.tsx" --include="*.ts" | grep -v "isLoading" | wc -l)

if [ "$remaining_loading" -eq 0 ] && [ "$remaining_loading_usage" -eq 0 ]; then
  echo "🎉 Toutes les propriétés d'authentification sont correctes !"
else
  echo "⚠️  Il reste des utilisations incorrectes :"
  echo "  - useAuth avec loading: $remaining_loading"
  echo "  - Utilisations de loading: $remaining_loading_usage"
  echo ""
  echo "Utilisations restantes :"
  grep -r "loading.*useAuth\|useAuth.*loading" app/ --include="*.tsx" --include="*.ts" || true
  grep -r "\bloading\b" app/ --include="*.tsx" --include="*.ts" | grep -v "isLoading" || true
fi

echo "✨ Script terminé !"
