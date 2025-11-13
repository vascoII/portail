"use client";

import React, { useState, useRef, useEffect } from "react";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { useDataStore } from "@/store/dataStore";

const UserMenu: React.FC = () => {
  const { loginData, clearLoginData } = useDataStore();
  const router = useRouter();
  const [isUserMenuOpen, setIsUserMenuOpen] = useState(false);
  const userMenuRef = useRef<HTMLDivElement>(null);

  // Get user info from data store
  const displayName =
    loginData?.userName || loginData?.firstName || "Utilisateur";
  const isAdmin = loginData?.userType === "A" ? true : false;
  const isSuperAdmin = loginData?.userType === "SA" ? true : false;
  const isClient = loginData?.userType === "C" ? true : false;
  const isGestionnaire = loginData?.userType === "G" ? true : false;
  const isOccupant = loginData?.userType === "O" ? true : false;
  const showFactures = loginData?.showFactures === true ? true : false;

  // Close dropdown when clicking outside
  useEffect(() => {
    const handleClickOutside = (event: MouseEvent) => {
      if (
        userMenuRef.current &&
        !userMenuRef.current.contains(event.target as Node)
      ) {
        setIsUserMenuOpen(false);
      }
    };

    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

  const handleLogout = () => {
    clearLoginData();
    setIsUserMenuOpen(false);
    router.push("/login");
  };

  // Debug: Log loginData
  console.log("UserMenu - loginData:", loginData);

  // Don't render if user is not logged in
  if (!loginData) {
    console.log("UserMenu - No loginData, returning null");
    return <div className="text-xs text-red-500">No loginData</div>;
  }

  console.log("UserMenu - Rendering with loginData:", loginData);
  console.log("UserMenu - displayName:", displayName);

  return (
    <div className="flex items-center space-x-4">
      {/* User Menu */}
      <div className="relative" ref={userMenuRef}>
        <button
          className="flex items-center px-4 py-2 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 text-sm font-medium"
          type="button"
          onClick={() => setIsUserMenuOpen(!isUserMenuOpen)}
          style={{
            backgroundColor: "#606060",
            color: "#fff",
          }}
        >
          <i className="fas fa-user mr-2"></i>
          <span className="truncate max-w-32">{displayName}</span>
          <i className="fas fa-chevron-down ml-2 text-xs"></i>
        </button>

        {/* Mobile User Menu Button */}
        <button
          className="flex items-center justify-center w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200"
          type="button"
          onClick={() => setIsUserMenuOpen(!isUserMenuOpen)}
        >
          <i className="fas fa-user"></i>
        </button>

        {/* User Dropdown Menu */}
        {isUserMenuOpen && (
          <div className="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 z-[9999]">
            <div className="py-2">
              {/* User Info Header */}
              <div className="px-4 py-3 border-b border-gray-100">
                <div className="flex items-center space-x-3">
                  <div className="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <i className="fas fa-user text-blue-600"></i>
                  </div>
                  <div>
                    <p className="text-sm font-medium text-gray-900">
                      {displayName}
                    </p>
                    <p className="text-xs text-gray-500">
                      {isSuperAdmin
                        ? "Super Administrateur"
                        : isAdmin
                        ? "Administrateur"
                        : isClient
                        ? "Client"
                        : isGestionnaire
                        ? "Gestionnaire"
                        : isOccupant
                        ? "Occupant"
                        : "Invité"}
                    </p>
                  </div>
                </div>
              </div>

              {/* Menu Items */}
              <div className="py-1">
                {(isClient || isGestionnaire || isOccupant) && (
                  <Link
                    href="/update-password"
                    className="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200"
                    onClick={() => setIsUserMenuOpen(false)}
                  >
                    <i className="fas fa-edit w-4 h-4 mr-3 text-gray-400"></i>
                    Mon Compte
                  </Link>
                )}
                {isClient && (
                  <Link
                    href="/operators/create"
                    className="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200"
                    onClick={() => setIsUserMenuOpen(false)}
                  >
                    <i className="fas fa-edit w-4 h-4 mr-3 text-gray-400"></i>
                    Créer un compte
                  </Link>
                )}
                {isClient && (
                  <Link
                    href="/operators"
                    className="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200"
                    onClick={() => setIsUserMenuOpen(false)}
                  >
                    <i className="fas fa-edit w-4 h-4 mr-3 text-gray-400"></i>
                    Gérer les comptes
                  </Link>
                )}
                {(isClient || isGestionnaire) && showFactures && (
                  <Link
                    href="/factures"
                    className="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200"
                    onClick={() => setIsUserMenuOpen(false)}
                  >
                    <i className="fas fa-edit w-4 h-4 mr-3 text-gray-400"></i>
                    Factures
                  </Link>
                )}
                {isClient && (
                  <Link
                    href="/operators/stats"
                    className="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200"
                    onClick={() => setIsUserMenuOpen(false)}
                  >
                    <i className="fas fa-edit w-4 h-4 mr-3 text-gray-400"></i>
                    Stats Connexion Occupants
                  </Link>
                )}
                <div className="border-t border-gray-100 my-1"></div>
                <button
                  onClick={handleLogout}
                  className="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200"
                >
                  <i className="fas fa-sign-out-alt w-4 h-4 mr-3"></i>
                  Déconnexion
                </button>
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default UserMenu;
