#!/bin/bash

# Script pour corriger les chemins d'import dans les pages
# Remplace ../components par ../../components et ../hooks par ../../hooks

echo "🔧 Correction des chemins d'import dans les pages..."

# Fonction pour corriger un fichier
fix_file() {
  local file="$1"
  local depth="$2"
  
  echo "  📝 Correction de $file (profondeur: $depth)"
  
  # Ajouter "use client" si pas déjà présent
  if ! head -1 "$file" | grep -q "use client"; then
    sed -i '' '1i\
"use client";
' "$file"
  fi
  
  # Corriger les chemins selon la profondeur
  if [ "$depth" -eq 1 ]; then
    # Pages directes (ex: pages/login/page.tsx)
    sed -i '' 's|from "../components/|from "../../components/|g' "$file"
    sed -i '' 's|from "../hooks/|from "../../hooks/|g' "$file"
  elif [ "$depth" -eq 2 ]; then
    # Pages dans des sous-dossiers (ex: pages/legal/cgu/page.tsx)
    sed -i '' 's|from "../components/|from "../../../components/|g' "$file"
    sed -i '' 's|from "../hooks/|from "../../../hooks/|g' "$file"
  elif [ "$depth" -eq 3 ]; then
    # Pages dans des sous-sous-dossiers (ex: pages/logements/[id]/edit/page.tsx)
    sed -i '' 's|from "../components/|from "../../../../components/|g' "$file"
    sed -i '' 's|from "../hooks/|from "../../../../hooks/|g' "$file"
  fi
}

# Trouver et corriger tous les fichiers page.tsx
find app/pages -name "page.tsx" | while read file; do
  # Calculer la profondeur
  depth=$(echo "$file" | tr -cd '/' | wc -c)
  depth=$((depth - 2)) # Soustraire app/pages
  
  # Vérifier si le fichier a des imports incorrects
  if grep -q 'from "../components' "$file" || grep -q 'from "../hooks' "$file"; then
    fix_file "$file" "$depth"
  fi
done

echo "✅ Chemins d'import corrigés"

# Vérifier qu'il ne reste plus d'imports incorrects
remaining_incorrect_imports=$(grep -r 'from "../components' app/pages --include="*.tsx" | wc -l)
remaining_incorrect_hooks=$(grep -r 'from "../hooks' app/pages --include="*.tsx" | wc -l)

if [ "$remaining_incorrect_imports" -eq 0 ] && [ "$remaining_incorrect_hooks" -eq 0 ]; then
  echo "🎉 Tous les chemins d'import ont été corrigés avec succès !"
else
  echo "⚠️  Il reste des imports incorrects :"
  echo "  - Components: $remaining_incorrect_imports"
  echo "  - Hooks: $remaining_incorrect_hooks"
  echo ""
  echo "Imports restants :"
  grep -r 'from "../components' app/pages --include="*.tsx" || true
  grep -r 'from "../hooks' app/pages --include="*.tsx" || true
fi

echo "✨ Script terminé !"
