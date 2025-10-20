"use client";

import React from "react";
import Link from "next/link";

interface DashboardMenuProps {
  data: {
    NbFuites: number;
    NbDysfonctionnements: number;
    NbAnomalies: number;
    NbDepannages: number;
  };
}

const DashboardMenu: React.FC<DashboardMenuProps> = ({ data }) => {
  const menuItems = [
    {
      href: "/dashboard",
      icon: "fas fa-cog",
      title: "Le Parc",
      isActive: true,
      showBadge: false,
    },
    {
      href: "/immeubles?fuites=1",
      icon: "fas fa-tint",
      title: "Fuites",
      count: data.NbFuites === -1 ? 0 : data.NbFuites,
      showBadge: true,
    },
    {
      href: "/immeubles?dysfonctionnements=1",
      icon: "fas fa-bell",
      title: "Alarmes techniques",
      count: data.NbDysfonctionnements === -1 ? 0 : data.NbDysfonctionnements,
      showBadge: true,
    },
    {
      href: "/immeubles?anomalies=1",
      icon: "fas fa-exclamation-triangle",
      title: "Anomalies de consommation",
      count: data.NbAnomalies === -1 ? 0 : data.NbAnomalies,
      showBadge: true,
    },
    {
      href: "/immeubles?depannages=1",
      icon: "fas fa-wrench",
      title: "Dépannages en cours",
      count: data.NbDepannages === -1 ? 0 : data.NbDepannages,
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

export default DashboardMenu;
