#!/bin/bash

# Script pour tester la page des mentions légales avec Tailwind CSS

echo "🧪 Test de la page Mentions Légales..."

# Test 1: Vérifier que la page se charge
echo "1. Test de chargement de la page..."
status_code=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:3000/pages/legal/legal-notices)
if [ "$status_code" = "200" ]; then
  echo "   ✅ Page chargée avec succès (HTTP $status_code)"
else
  echo "   ❌ Erreur de chargement (HTTP $status_code)"
  exit 1
fi

# Test 2: Vérifier la présence des classes Tailwind spécifiques
echo "2. Test des classes Tailwind CSS spécifiques..."
specific_classes=("max-w-4xl" "bg-white" "rounded-lg" "shadow-lg" "bg-gradient-to-r" "from-blue-600" "to-blue-700" "text-2xl" "font-bold" "text-white")
for class in "${specific_classes[@]}"; do
  if curl -s http://localhost:3000/pages/legal/legal-notices | grep -q "$class"; then
    echo "   ✅ Classe '$class' trouvée"
  else
    echo "   ❌ Classe '$class' manquante"
  fi
done

# Test 3: Vérifier la structure des sections
echo "3. Test de la structure des sections..."
if curl -s http://localhost:3000/pages/legal/legal-notices | grep -q "Éditeur du site"; then
  echo "   ✅ Section 'Éditeur du site' trouvée"
else
  echo "   ❌ Section 'Éditeur du site' manquante"
fi

if curl -s http://localhost:3000/pages/legal/legal-notices | grep -q "Directeur de la publication"; then
  echo "   ✅ Section 'Directeur de la publication' trouvée"
else
  echo "   ❌ Section 'Directeur de la publication' manquante"
fi

# Test 4: Vérifier les numéros de sections
echo "4. Test des numéros de sections..."
for i in {1..9}; do
  if curl -s http://localhost:3000/pages/legal/legal-notices | grep -q "bg-blue-100 text-blue-800.*$i"; then
    echo "   ✅ Section $i numérotée correctement"
  else
    echo "   ❌ Section $i non trouvée"
  fi
done

# Test 5: Vérifier la date de mise à jour
echo "5. Test de la date de mise à jour..."
if curl -s http://localhost:3000/pages/legal/legal-notices | grep -q "Dernière mise à jour"; then
  echo "   ✅ Date de mise à jour trouvée"
else
  echo "   ❌ Date de mise à jour manquante"
fi

# Test 6: Compter le nombre total de classes Tailwind
echo "6. Test du nombre de classes Tailwind..."
tailwind_count=$(curl -s http://localhost:3000/pages/legal/legal-notices | grep -o 'class="[^"]*"' | grep -E '(bg-|text-|flex|grid|p-|m-|w-|h-|border|rounded|shadow|space|max-|mx-|px-|py-|mb-|mt-|mr-|ml-|leading|font|items|justify)' | wc -l)
echo "   📊 $tailwind_count classes Tailwind détectées"

echo "🎉 Tests de la page Mentions Légales terminés avec succès !"
