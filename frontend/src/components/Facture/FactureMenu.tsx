"use client";

import React from "react";
import Link from "next/link";

interface FactureMenuProps {
  activeTab?: string;
}

const FactureMenu: React.FC<FactureMenuProps> = ({ activeTab }) => {
  const menuItems = [
    {
      href: "/dashboard",
      icon: "fas fa-cog",
      title: "Le Parc",
      isActive: false,
      showBadge: false,
    },
    {
      href: "/factures",
      icon: "fas fa-file-invoice",
      title: "Liste des factures",
      isActive: !activeTab || activeTab === "list",
      showBadge: false,
    },
    {
      href: "/factures/pending",
      icon: "fas fa-clock",
      title: "Factures en attente",
      isActive: activeTab === "pending",
      showBadge: true,
    },
    {
      href: "/factures/paid",
      icon: "fas fa-check-circle",
      title: "Factures payées",
      isActive: activeTab === "paid",
      showBadge: false,
    },
    {
      href: "/factures/overdue",
      icon: "fas fa-exclamation-triangle",
      title: "Factures en retard",
      isActive: activeTab === "overdue",
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

export default FactureMenu;
