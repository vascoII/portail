"use client";

import React from "react";
import Link from "next/link";

interface LogementMenuProps {
  logement: {
    Logement: {
      PkLogement: number;
    };
    Immeuble: {
      PkImmeuble: number;
      Ref: string;
    };
    Occupant: {
      Ref: string;
    };
    NbFuites: number;
    NbAnomalies: number;
    NbDysfonctionnements: number;
    NbDepannages: number;
    NbDepannagesTotal: number;
    LogementEF: {
      NbFuites: number;
      NbAnomalies: number;
    };
    LogementEC: {
      NbFuites: number;
      NbAnomalies: number;
    };
  };
  activeTab?: string;
}

const LogementMenu: React.FC<LogementMenuProps> = ({ logement, activeTab }) => {
  const totalFuites =
    (logement.LogementEF?.NbFuites || 0) + (logement.LogementEC?.NbFuites || 0);
  const totalAnomalies =
    (logement.LogementEF?.NbAnomalies || 0) +
    (logement.LogementEC?.NbAnomalies || 0);

  const menuItems = [
    {
      href: "/dashboard",
      icon: "fas fa-cog",
      title: "Le Parc",
      isActive: false,
      showBadge: false,
    },
    {
      href: `/immeubles/${logement.Immeuble.PkImmeuble}`,
      icon: "fas fa-building",
      title: `Immeuble ${logement.Immeuble.Ref}`,
      isActive: false,
      showBadge: false,
    },
    {
      href: `/logements/${logement.Logement.PkLogement}`,
      icon: "fas fa-home",
      title: `Logement ${logement.Occupant.Ref}`,
      isActive: !activeTab,
      showBadge: false,
    },
    {
      href: `/logements/${logement.Logement.PkLogement}/leaks`,
      icon: "fas fa-tint",
      title: "Fuites",
      count: totalFuites,
      isActive: activeTab === "fui",
      showBadge: true,
    },
    {
      href: `/logements/${logement.Logement.PkLogement}/dysfunctions`,
      icon: "fas fa-bell",
      title: "Alarmes techniques",
      count:
        logement.NbDysfonctionnements === -1
          ? 0
          : logement.NbDysfonctionnements,
      isActive: activeTab === "dys",
      showBadge: true,
    },
    {
      href: `/logements/${logement.Logement.PkLogement}/anomalies`,
      icon: "fas fa-exclamation-triangle",
      title: "Anomalies de consommation",
      count: totalAnomalies,
      isActive: activeTab === "ano",
      showBadge: true,
    },
    {
      href:
        logement.NbDepannages > 0
          ? `/logements/${logement.Logement.PkLogement}/interventions?statut=ouvert`
          : `/logements/${logement.Logement.PkLogement}/interventions`,
      icon: "fas fa-wrench",
      title: logement.NbDepannages > 0 ? "Dépannages en cours" : "Dépannages",
      count:
        logement.NbDepannages > 0
          ? logement.NbDepannages
          : logement.NbDepannagesTotal || 0,
      isActive: activeTab === "dep",
      showBadge: true,
    },
  ];

  return (
    <nav className="bg-white shadow-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex space-x-8 overflow-x-auto">
          {menuItems.map((item, index) => (
            <Link
              key={index}
              href={item.href}
              className={`flex items-center px-3 py-4 text-sm font-medium transition-colors duration-200 whitespace-nowrap ${
                item.isActive
                  ? "text-green-600 border-b-2 border-green-600"
                  : "text-gray-500 hover:text-gray-700 hover:border-b-2 hover:border-gray-300"
              }`}
            >
              <i className={`${item.icon} mr-2`}></i>
              <span>{item.title}</span>
              {item.showBadge && item.count > 0 && (
                <span className="ml-2 bg-gray-200 text-gray-800 text-xs font-medium px-2 py-1 rounded-full">
                  {item.count}
                </span>
              )}
            </Link>
          ))}
        </div>
      </div>
    </nav>
  );
};

export default LogementMenu;
