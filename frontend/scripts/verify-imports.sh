#!/bin/bash

# Script pour vérifier que tous les imports sont corrects

echo "🔍 Vérification des imports..."

# Fonction pour vérifier un fichier
check_file() {
  local file="$1"
  local errors=0
  
  # Vérifier les imports de composants
  if grep -q 'from "../components' "$file"; then
    echo "  ❌ $file : imports de composants incorrects"
    grep -n 'from "../components' "$file"
    errors=$((errors + 1))
  fi
  
  # Vérifier les imports de hooks
  if grep -q 'from "../hooks' "$file"; then
    echo "  ❌ $file : imports de hooks incorrects"
    grep -n 'from "../hooks' "$file"
    errors=$((errors + 1))
  fi
  
  # Vérifier la directive "use client"
  if grep -q "useRouter\|useState\|useEffect" "$file" && ! head -1 "$file" | grep -q "use client"; then
    echo "  ⚠️  $file : utilise des hooks mais n'a pas 'use client'"
    errors=$((errors + 1))
  fi
  
  return $errors
}

total_errors=0

# Vérifier tous les fichiers page.tsx
echo "📄 Vérification des pages..."
find app/pages -name "page.tsx" | while read file; do
  check_file "$file"
  total_errors=$((total_errors + $?))
done

# Vérifier les composants
echo "🧩 Vérification des composants..."
find app/components -name "*.tsx" | while read file; do
  check_file "$file"
  total_errors=$((total_errors + $?))
done

# Vérifier les hooks
echo "🪝 Vérification des hooks..."
find app/hooks -name "*.ts" | while read file; do
  check_file "$file"
  total_errors=$((total_errors + $?))
done

if [ $total_errors -eq 0 ]; then
  echo "✅ Tous les imports sont corrects !"
else
  echo "❌ $total_errors erreurs trouvées"
fi

echo "✨ Vérification terminée !"
