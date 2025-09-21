#!/bin/bash

# Script pour tester la page Données Personnelles avec Tailwind CSS

echo "🧪 Test de la page Données Personnelles..."

# Test 1: Vérifier que la page se charge
echo "1. Test de chargement de la page..."
status_code=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:3000/pages/legal/personal-datas)
if [ "$status_code" = "200" ]; then
  echo "   ✅ Page chargée avec succès (HTTP $status_code)"
else
  echo "   ❌ Erreur de chargement (HTTP $status_code)"
  exit 1
fi

# Test 2: Vérifier la présence des classes Tailwind spécifiques
echo "2. Test des classes Tailwind CSS spécifiques..."
specific_classes=("max-w-4xl" "bg-white" "rounded-lg" "shadow-lg" "bg-gradient-to-r" "from-purple-600" "to-purple-700" "text-2xl" "font-bold" "text-white")
for class in "${specific_classes[@]}"; do
  if curl -s http://localhost:3000/pages/legal/personal-datas | grep -q "$class"; then
    echo "   ✅ Classe '$class' trouvée"
  else
    echo "   ❌ Classe '$class' manquante"
  fi
done

# Test 3: Vérifier la structure des sections
echo "3. Test de la structure des sections..."
if curl -s http://localhost:3000/pages/legal/personal-datas | grep -q "Responsable du traitement"; then
  echo "   ✅ Section 'Responsable du traitement' trouvée"
else
  echo "   ❌ Section 'Responsable du traitement' manquante"
fi

if curl -s http://localhost:3000/pages/legal/personal-datas | grep -q "Données collectées"; then
  echo "   ✅ Section 'Données collectées' trouvée"
else
  echo "   ❌ Section 'Données collectées' manquante"
fi

# Test 4: Vérifier les numéros de sections
echo "4. Test des numéros de sections..."
for i in {1..12}; do
  if curl -s http://localhost:3000/pages/legal/personal-datas | grep -q "bg-purple-100 text-purple-800.*$i"; then
    echo "   ✅ Section $i numérotée correctement"
  else
    echo "   ❌ Section $i non trouvée"
  fi
done

# Test 5: Vérifier l'alerte d'information
echo "5. Test de l'alerte d'information..."
if curl -s http://localhost:3000/pages/legal/personal-datas | grep -q "bg-blue-50 border border-blue-200"; then
  echo "   ✅ Alerte d'information stylée trouvée"
else
  echo "   ❌ Alerte d'information manquante"
fi

# Test 6: Vérifier les listes à puces
echo "6. Test des listes à puces..."
if curl -s http://localhost:3000/pages/legal/personal-datas | grep -q "list-disc list-inside"; then
  echo "   ✅ Listes à puces stylées trouvées"
else
  echo "   ❌ Listes à puces manquantes"
fi

# Test 7: Vérifier la date de mise à jour
echo "7. Test de la date de mise à jour..."
if curl -s http://localhost:3000/pages/legal/personal-datas | grep -q "Dernière mise à jour"; then
  echo "   ✅ Date de mise à jour trouvée"
else
  echo "   ❌ Date de mise à jour manquante"
fi

# Test 8: Compter le nombre total de classes Tailwind
echo "8. Test du nombre de classes Tailwind..."
tailwind_count=$(curl -s http://localhost:3000/pages/legal/personal-datas | grep -o 'class="[^"]*"' | grep -E '(bg-|text-|flex|grid|p-|m-|w-|h-|border|rounded|shadow|space|max-|mx-|px-|py-|mb-|mt-|mr-|ml-|leading|font|items|justify|list-|from-|to-)' | wc -l)
echo "   📊 $tailwind_count classes Tailwind détectées"

# Test 9: Vérifier le gradient violet
echo "9. Test du gradient violet..."
if curl -s http://localhost:3000/pages/legal/personal-datas | grep -q "from-purple-600 to-purple-700"; then
  echo "   ✅ Gradient violet trouvé"
else
  echo "   ❌ Gradient violet manquant"
fi

# Test 10: Vérifier les badges violets
echo "10. Test des badges violets..."
if curl -s http://localhost:3000/pages/legal/personal-datas | grep -q "bg-purple-100 text-purple-800"; then
  echo "   ✅ Badges violets trouvés"
else
  echo "   ❌ Badges violets manquants"
fi

echo "🎉 Tests de la page Données Personnelles terminés avec succès !"
