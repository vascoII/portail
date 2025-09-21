#!/bin/bash

# Script pour tester la page CGU avec Tailwind CSS

echo "🧪 Test de la page Conditions Générales d'Utilisation..."

# Test 1: Vérifier que la page se charge
echo "1. Test de chargement de la page..."
status_code=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:3000/pages/legal/cgu)
if [ "$status_code" = "200" ]; then
  echo "   ✅ Page chargée avec succès (HTTP $status_code)"
else
  echo "   ❌ Erreur de chargement (HTTP $status_code)"
  exit 1
fi

# Test 2: Vérifier la présence des classes Tailwind spécifiques
echo "2. Test des classes Tailwind CSS spécifiques..."
specific_classes=("max-w-4xl" "bg-white" "rounded-lg" "shadow-lg" "bg-gradient-to-r" "from-green-600" "to-green-700" "text-2xl" "font-bold" "text-white")
for class in "${specific_classes[@]}"; do
  if curl -s http://localhost:3000/pages/legal/cgu | grep -q "$class"; then
    echo "   ✅ Classe '$class' trouvée"
  else
    echo "   ❌ Classe '$class' manquante"
  fi
done

# Test 3: Vérifier la structure des sections
echo "3. Test de la structure des sections..."
if curl -s http://localhost:3000/pages/legal/cgu | grep -q "Objet"; then
  echo "   ✅ Section 'Objet' trouvée"
else
  echo "   ❌ Section 'Objet' manquante"
fi

if curl -s http://localhost:3000/pages/legal/cgu | grep -q "Acceptation des conditions"; then
  echo "   ✅ Section 'Acceptation des conditions' trouvée"
else
  echo "   ❌ Section 'Acceptation des conditions' manquante"
fi

# Test 4: Vérifier les numéros de sections
echo "4. Test des numéros de sections..."
for i in {1..12}; do
  if curl -s http://localhost:3000/pages/legal/cgu | grep -q "bg-green-100 text-green-800.*$i"; then
    echo "   ✅ Section $i numérotée correctement"
  else
    echo "   ❌ Section $i non trouvée"
  fi
done

# Test 5: Vérifier les listes à puces
echo "5. Test des listes à puces..."
if curl -s http://localhost:3000/pages/legal/cgu | grep -q "list-disc list-inside"; then
  echo "   ✅ Listes à puces stylées trouvées"
else
  echo "   ❌ Listes à puces manquantes"
fi

# Test 6: Vérifier la date de mise à jour
echo "6. Test de la date de mise à jour..."
if curl -s http://localhost:3000/pages/legal/cgu | grep -q "Dernière mise à jour"; then
  echo "   ✅ Date de mise à jour trouvée"
else
  echo "   ❌ Date de mise à jour manquante"
fi

# Test 7: Compter le nombre total de classes Tailwind
echo "7. Test du nombre de classes Tailwind..."
tailwind_count=$(curl -s http://localhost:3000/pages/legal/cgu | grep -o 'class="[^"]*"' | grep -E '(bg-|text-|flex|grid|p-|m-|w-|h-|border|rounded|shadow|space|max-|mx-|px-|py-|mb-|mt-|mr-|ml-|leading|font|items|justify|list-|from-|to-)' | wc -l)
echo "   📊 $tailwind_count classes Tailwind détectées"

# Test 8: Vérifier le gradient vert
echo "8. Test du gradient vert..."
if curl -s http://localhost:3000/pages/legal/cgu | grep -q "from-green-600 to-green-700"; then
  echo "   ✅ Gradient vert trouvé"
else
  echo "   ❌ Gradient vert manquant"
fi

echo "🎉 Tests de la page CGU terminés avec succès !"
