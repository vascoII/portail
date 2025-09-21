#!/bin/bash

# Script pour corriger les imports next/router vers next/navigation
# et ajouter "use client" aux composants qui utilisent useRouter

echo "🔧 Correction des imports next/router vers next/navigation..."

# Remplacer next/router par next/navigation
find app/ -name "*.tsx" -o -name "*.ts" | xargs sed -i '' 's/import { useRouter } from "next\/router";/import { useRouter } from "next\/navigation";/g'

echo "✅ Imports corrigés"

# Ajouter "use client" aux fichiers qui utilisent useRouter
echo "🔧 Ajout de 'use client' aux composants utilisant useRouter..."

find app/ -name "*.tsx" -exec grep -l "useRouter" {} \; | while read file; do
  if ! head -1 "$file" | grep -q "use client"; then
    echo "  📝 Ajout de 'use client' à $file"
    sed -i '' '1i\
"use client";
' "$file"
  fi
done

echo "✅ Directive 'use client' ajoutée"

# Vérifier qu'il ne reste plus d'imports next/router
remaining_router_imports=$(grep -r "next/router" app/ --include="*.tsx" --include="*.ts" | wc -l)

if [ "$remaining_router_imports" -eq 0 ]; then
  echo "🎉 Tous les imports ont été corrigés avec succès !"
else
  echo "⚠️  Il reste $remaining_router_imports imports next/router à corriger"
  grep -r "next/router" app/ --include="*.tsx" --include="*.ts"
fi

echo "✨ Script terminé !"
