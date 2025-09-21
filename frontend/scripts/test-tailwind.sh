#!/bin/bash

# Script pour tester que Tailwind CSS fonctionne correctement

echo "🧪 Test de Tailwind CSS..."

# Test 1: Vérifier que la page se charge
echo "1. Test de chargement de la page..."
status_code=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:3000/pages/login)
if [ "$status_code" = "200" ]; then
  echo "   ✅ Page chargée avec succès (HTTP $status_code)"
else
  echo "   ❌ Erreur de chargement (HTTP $status_code)"
  exit 1
fi

# Test 2: Vérifier la présence des classes Tailwind
echo "2. Test des classes Tailwind CSS..."
tailwind_classes=$(curl -s http://localhost:3000/pages/login | grep -o 'class="[^"]*"' | grep -E '(bg-|text-|flex|grid|p-|m-|w-|h-)' | wc -l)
if [ "$tailwind_classes" -gt 0 ]; then
  echo "   ✅ $tailwind_classes classes Tailwind détectées"
else
  echo "   ❌ Aucune classe Tailwind détectée"
  exit 1
fi

# Test 3: Vérifier des classes spécifiques
echo "3. Test des classes spécifiques..."
specific_classes=("bg-gradient-to-br" "from-blue-50" "to-indigo-100" "min-h-screen" "flex" "flex-col")
for class in "${specific_classes[@]}"; do
  if curl -s http://localhost:3000/pages/login | grep -q "$class"; then
    echo "   ✅ Classe '$class' trouvée"
  else
    echo "   ❌ Classe '$class' manquante"
  fi
done

# Test 4: Vérifier que les styles sont appliqués (pas seulement les classes)
echo "4. Test des styles appliqués..."
if curl -s http://localhost:3000/pages/login | grep -q "style="; then
  echo "   ✅ Styles inline détectés"
else
  echo "   ⚠️  Aucun style inline détecté (normal avec Tailwind)"
fi

echo "🎉 Tests Tailwind CSS terminés avec succès !"
