"use client";

import React from "react";
import Link from "next/link";

interface OccupantMenuProps {
  logement: {
    Occupant: {
      Ref: string;
    };
  };
  activeTab?: string;
}

const OccupantMenu: React.FC<OccupantMenuProps> = ({ logement, activeTab }) => {
  const menuItems = [
    {
      href: "/occupant",
      icon: "fas fa-home",
      title: `Logement ${logement.Occupant.Ref}`,
      isActive: !activeTab || activeTab === "dashboard",
      showBadge: false,
    },
    {
      href: "/occupant/simulateur",
      icon: "fas fa-calculator",
      title: "Simulateur de consommation",
      isActive: activeTab === "simulateur",
      showBadge: false,
    },
    {
      href: "/occupant/alertes",
      icon: "fas fa-bell",
      title: "Mes alertes",
      isActive: activeTab === "alertes",
      showBadge: false,
    },
    {
      href: "/occupant/interventions",
      icon: "fas fa-wrench",
      title: "Mes dépannages",
      isActive: activeTab === "interventions",
      showBadge: false,
    },
    {
      href: "/occupant/leaks",
      icon: "fas fa-tint",
      title: "Fuites",
      isActive: activeTab === "leaks",
      showBadge: false,
    },
    {
      href: "/occupant/dysfunctions",
      icon: "fas fa-exclamation-triangle",
      title: "Alarmes techniques",
      isActive: activeTab === "dysfunctions",
      showBadge: false,
    },
    {
      href: "/occupant/anomalies",
      icon: "fas fa-chart-line",
      title: "Anomalies de consommation",
      isActive: activeTab === "anomalies",
      showBadge: false,
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
                  ? "text-blue-600 border-b-2 border-blue-600"
                  : "text-gray-500 hover:text-gray-700 hover:border-b-2 hover:border-gray-300"
              }`}
            >
              <i className={`${item.icon} mr-2`}></i>
              <span>{item.title}</span>
              {item.showBadge && (
                <span className="ml-2 bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full">
                  !
                </span>
              )}
            </Link>
          ))}
        </div>
      </div>
    </nav>
  );
};

export default OccupantMenu;
