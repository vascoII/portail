"use client";

import React, { useState } from "react";
import Link from "next/link";

interface MobileMenuProps {
  data: {
    NbFuites: number;
    NbDysfonctionnements: number;
    NbAnomalies: number;
    NbDepannages: number;
    isDemo?: boolean;
  };
}

const MobileMenu: React.FC<MobileMenuProps> = ({ data }) => {
  const [isOpen, setIsOpen] = useState(false);

  const menuItems = [
    {
      href: "/dashboard",
      icon: "fas fa-home",
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
      badgeColor: "bg-blue-500",
    },
    {
      href: "/immeubles?dysfonctionnements=1",
      icon: "fas fa-bell",
      title: "Alarmes techniques",
      count: data.NbDysfonctionnements === -1 ? 0 : data.NbDysfonctionnements,
      showBadge: true,
      badgeColor: "bg-orange-500",
    },
    {
      href: "/immeubles?anomalies=1",
      icon: "fas fa-exclamation-triangle",
      title: "Anomalies de consommation",
      count: data.NbAnomalies === -1 ? 0 : data.NbAnomalies,
      showBadge: true,
      badgeColor: "bg-red-500",
    },
    {
      href: "/immeubles?depannages=1",
      icon: "fas fa-wrench",
      title: "Dépannages en cours",
      count: data.NbDepannages === -1 ? 0 : data.NbDepannages,
      showBadge: true,
      badgeColor: "bg-yellow-500",
    },
  ];

  return (
    <>
      {/* Mobile Menu Button */}
      <div className="lg:hidden bg-white shadow-sm border-b border-gray-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center py-4">
            <h1 className="text-lg font-semibold text-gray-900">Le Parc</h1>
            <button
              onClick={() => setIsOpen(!isOpen)}
              className="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700"
            >
              <i
                className={`fas ${isOpen ? "fa-times" : "fa-bars"} text-xl`}
              ></i>
            </button>
          </div>
        </div>
      </div>

      {/* Mobile Menu Dropdown */}
      {isOpen && (
        <div className="lg:hidden bg-white shadow-lg border-b border-gray-200">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="py-4 space-y-2">
              {menuItems.map((item, index) => (
                <Link
                  key={index}
                  href={item.href}
                  onClick={() => setIsOpen(false)}
                  className={`flex items-center justify-between px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200 ${
                    item.isActive
                      ? "bg-blue-50 text-blue-600"
                      : "text-gray-700 hover:bg-gray-50"
                  }`}
                >
                  <div className="flex items-center">
                    <i className={`${item.icon} mr-3`}></i>
                    <span>{item.title}</span>
                  </div>
                  {item.showBadge && item.count > 0 && (
                    <span
                      className={`${item.badgeColor} text-white text-xs font-bold px-2 py-1 rounded-full min-w-[20px] text-center`}
                    >
                      {item.count}
                    </span>
                  )}
                </Link>
              ))}

              {/* Demo Mode Indicator */}
              {data.isDemo && (
                <div className="flex items-center justify-between px-3 py-3 text-sm font-medium text-purple-600 bg-purple-50 rounded-lg">
                  <div className="flex items-center">
                    <i className="fas fa-flask mr-3"></i>
                    <span>Mode Démo</span>
                  </div>
                  <span className="bg-purple-100 text-purple-800 text-xs font-bold px-2 py-1 rounded-full">
                    DEMO
                  </span>
                </div>
              )}
            </div>
          </div>
        </div>
      )}
    </>
  );
};

export default MobileMenu;
