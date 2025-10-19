"use client";

import React from "react";
import Link from "next/link";

interface ImmeubleMenuProps {
  immeuble: {
    Immeuble: {
      PkImmeuble: number;
      Ref: string;
    };
    NbFuites: number;
    NbAnomalies: number;
    NbDysfonctionnements: number;
    NbDepannages: number;
    NbDepannagesTotal: number;
    ImmeubleEF: {
      NbFuites: number;
    };
    ImmeubleEC: {
      NbFuites: number;
    };
    ImmeubleEF: {
      NbAnomalies: number;
    };
    ImmeubleEC: {
      NbAnomalies: number;
    };
  };
  activeTab?: string;
}

const ImmeubleMenu: React.FC<ImmeubleMenuProps> = ({ immeuble, activeTab }) => {
  const totalFuites =
    (immeuble.ImmeubleEF?.NbFuites || 0) + (immeuble.ImmeubleEC?.NbFuites || 0);
  const totalAnomalies =
    (immeuble.ImmeubleEF?.NbAnomalies || 0) +
    (immeuble.ImmeubleEC?.NbAnomalies || 0);

  const menuItems = [
    {
      href: "/dashboard",
      icon: "fas fa-cog",
      title: "Le Parc",
      isActive: false,
      showBadge: false,
    },
    {
      href: `/pages/immeubles/${immeuble.Immeuble.PkImmeuble}`,
      icon: "fas fa-building",
      title: `Immeuble ${immeuble.Immeuble.Ref}`,
      isActive: !activeTab,
      showBadge: false,
    },
    {
      href: `/pages/immeubles/${immeuble.Immeuble.PkImmeuble}/leaks`,
      icon: "fas fa-tint",
      title: "Fuites",
      count: totalFuites,
      isActive: activeTab === "fui",
      showBadge: true,
    },
    {
      href: `/pages/immeubles/${immeuble.Immeuble.PkImmeuble}/dysfunctions`,
      icon: "fas fa-bell",
      title: "Alarmes techniques",
      count:
        immeuble.NbDysfonctionnements === -1
          ? 0
          : immeuble.NbDysfonctionnements,
      isActive: activeTab === "dys",
      showBadge: true,
    },
    {
      href: `/pages/immeubles/${immeuble.Immeuble.PkImmeuble}/anomalies`,
      icon: "fas fa-exclamation-triangle",
      title: "Anomalies de consommation",
      count: totalAnomalies,
      isActive: activeTab === "ano",
      showBadge: true,
    },
    {
      href:
        immeuble.NbDepannages > 0
          ? `/pages/immeubles/${immeuble.Immeuble.PkImmeuble}/interventions?statut=ouvert`
          : `/pages/immeubles/${immeuble.Immeuble.PkImmeuble}/interventions`,
      icon: "fas fa-wrench",
      title: immeuble.NbDepannages > 0 ? "Dépannages en cours" : "Dépannages",
      count:
        immeuble.NbDepannages > 0
          ? immeuble.NbDepannages
          : immeuble.NbDepannagesTotal || 0,
      isActive: activeTab === "dep",
      showBadge: true,
    },
  ];

  return (
    <nav className="bg-white shadow-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex space-x-8">
          {menuItems.map((item, index) => (
            <Link
              key={index}
              href={item.href}
              className={`flex items-center px-3 py-4 text-sm font-medium transition-colors duration-200 ${
                item.isActive
                  ? "text-blue-600 border-b-2 border-blue-600"
                  : "text-gray-500 hover:text-gray-700 hover:border-b-2 hover:border-gray-300"
              }`}
            >
              <i className={`${item.icon} mr-2`}></i>
              <span className="whitespace-nowrap">{item.title}</span>
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

export default ImmeubleMenu;
