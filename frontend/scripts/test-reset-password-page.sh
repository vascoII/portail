#!/bin/bash

# Script pour tester la page Reset Password harmonisée avec Login

echo "🧪 Test de la page Reset Password harmonisée..."

# Test 1: Vérifier que la page se charge
echo "1. Test de chargement de la page..."
status_code=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:3000/pages/reset-password)
if [ "$status_code" = "200" ]; then
  echo "   ✅ Page chargée avec succès (HTTP $status_code)"
else
  echo "   ❌ Erreur de chargement (HTTP $status_code)"
  exit 1
fi

# Test 2: Vérifier la présence des classes Tailwind spécifiques (cohérence avec login)
echo "2. Test des classes Tailwind CSS spécifiques..."
specific_classes=("min-h-screen" "bg-gradient-to-br" "from-blue-50" "to-indigo-100" "flex" "justify-center" "py-12" "sm:px-6" "lg:px-8" "bg-white" "shadow-xl" "rounded-lg")
for class in "${specific_classes[@]}"; do
  if curl -s http://localhost:3000/pages/reset-password | grep -q "$class"; then
    echo "   ✅ Classe '$class' trouvée"
  else
    echo "   ❌ Classe '$class' manquante"
  fi
done

# Test 3: Vérifier la structure du formulaire
echo "3. Test de la structure du formulaire..."
if curl -s http://localhost:3000/pages/reset-password | grep -q "Mot de passe oublié"; then
  echo "   ✅ Titre 'Mot de passe oublié' trouvé"
else
  echo "   ❌ Titre manquant"
fi

if curl -s http://localhost:3000/pages/reset-password | grep -q "Adresse email"; then
  echo "   ✅ Champ email trouvé"
else
  echo "   ❌ Champ email manquant"
fi

if curl -s http://localhost:3000/pages/reset-password | grep -q "Envoyer le lien de réinitialisation"; then
  echo "   ✅ Bouton d'envoi trouvé"
else
  echo "   ❌ Bouton d'envoi manquant"
fi

# Test 4: Vérifier le logo et fallback
echo "4. Test du logo et fallback..."
if curl -s http://localhost:3000/pages/reset-password | grep -q "TECHEM"; then
  echo "   ✅ Logo/fallback TECHEM trouvé"
else
  echo "   ❌ Logo/fallback manquant"
fi

# Test 5: Vérifier les liens de navigation
echo "5. Test des liens de navigation..."
if curl -s http://localhost:3000/pages/reset-password | grep -q "Retour à la connexion"; then
  echo "   ✅ Lien retour connexion trouvé"
else
  echo "   ❌ Lien retour connexion manquant"
fi

if curl -s http://localhost:3000/pages/reset-password | grep -q "Mentions légales"; then
  echo "   ✅ Footer avec mentions légales trouvé"
else
  echo "   ❌ Footer manquant"
fi

# Test 6: Vérifier les états de chargement
echo "6. Test des états de chargement..."
if curl -s http://localhost:3000/pages/reset-password | grep -q "animate-spin"; then
  echo "   ✅ Animation de chargement trouvée"
else
  echo "   ❌ Animation de chargement manquante"
fi

# Test 7: Vérifier les messages d'erreur stylés
echo "7. Test des messages d'erreur stylés..."
if curl -s http://localhost:3000/pages/reset-password | grep -q "bg-red-50 border border-red-200"; then
  echo "   ✅ Messages d'erreur stylés trouvés"
else
  echo "   ❌ Messages d'erreur stylés manquants"
fi

# Test 8: Compter le nombre total de classes Tailwind
echo "8. Test du nombre de classes Tailwind..."
tailwind_count=$(curl -s http://localhost:3000/pages/reset-password | grep -o 'class="[^"]*"' | grep -E '(bg-|text-|flex|grid|p-|m-|w-|h-|border|rounded|shadow|space|max-|mx-|px-|py-|mb-|mt-|mr-|ml-|leading|font|items|justify|from-|to-|sm:|lg:|hover:|focus:|transition|duration|animate|opacity|disabled)' | wc -l)
echo "   📊 $tailwind_count classes Tailwind détectées"

# Test 9: Vérifier la cohérence avec la page login
echo "9. Test de cohérence avec la page login..."
login_classes=("min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100" "bg-white py-8 px-4 shadow-xl sm:rounded-lg" "text-3xl font-extrabold text-gray-900")
for class_combo in "${login_classes[@]}"; do
  if curl -s http://localhost:3000/pages/reset-password | grep -q "$class_combo"; then
    echo "   ✅ Classe combo '$class_combo' trouvée (cohérence login)"
  else
    echo "   ❌ Classe combo '$class_combo' manquante"
  fi
done

# Test 10: Vérifier la responsivité
echo "10. Test de la responsivité..."
responsive_classes=("sm:mx-auto" "sm:w-full" "sm:max-w-md" "sm:px-6" "lg:px-8" "sm:rounded-lg" "sm:px-10")
for class in "${responsive_classes[@]}"; do
  if curl -s http://localhost:3000/pages/reset-password | grep -q "$class"; then
    echo "   ✅ Classe responsive '$class' trouvée"
  else
    echo "   ❌ Classe responsive '$class' manquante"
  fi
done

echo "🎉 Tests de la page Reset Password harmonisée terminés avec succès !"
