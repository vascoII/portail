import { useRouter } from "next/navigation";
import { ROUTES } from "../config/routes";

export const useNavigation = () => {
  const router = useRouter();

  const navigateTo = (path: string) => {
    router.push(path);
  };

  const navigateToImmeuble = (id: string) => {
    router.push(ROUTES.IMMEUBLES.DETAIL(id));
  };

  const navigateToLogement = (id: string) => {
    router.push(ROUTES.LOGEMENTS.DETAIL(id));
  };

  const navigateToIntervention = (id: string) => {
    router.push(ROUTES.INTERVENTIONS.DETAIL(id));
  };

  const navigateToFacture = (id: string) => {
    router.push(ROUTES.FACTURES.DETAIL(id));
  };

  const goBack = () => {
    router.back();
  };

  const goHome = () => {
    router.push(ROUTES.DASHBOARD);
  };

  return {
    navigateTo,
    navigateToImmeuble,
    navigateToLogement,
    navigateToIntervention,
    navigateToFacture,
    goBack,
    goHome,
    currentPath: router.asPath,
    isReady: router.isReady,
  };
};
