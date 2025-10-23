"use client";

import React, { useState } from "react";
import Link from "next/link";
import UserMenu from "./UserMenu";
import SearchBar from "./SearchBar";

interface HeaderProps {
  onSearch?: (query: string, type: string) => void;
}

const Header: React.FC<HeaderProps> = ({ onSearch }) => {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

  return (
    <header
      className="bg-white shadow-sm border-b border-gray-200 bg-cover bg-center"
      style={{ backgroundImage: "url('/images/login-bg.png')" }}
    >
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Logo */}
          <div className="flex items-center">
            <Link href="/dashboard" className="flex items-center">
              <div className="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                <i className="fas fa-building text-white text-xl"></i>
              </div>
              <div className="block">
                <h1 className="text-xl font-bold text-gray-900">Techem</h1>
                <p className="text-xs text-gray-500">Portail Client</p>
              </div>
            </Link>
          </div>

          {/* Welcome Message - Desktop */}
          <div className="flex-1 flex justify-center">
            <h3 className="text-lg font-medium text-gray-700">
              Bienvenue dans votre espace client
            </h3>
          </div>

          {/* User Menu and Language */}
          <div className="flex items-center space-x-4 relative z-[9998]">
            <UserMenu />
          </div>

          {/* Mobile Menu Button */}
          <div className="lg:hidden">
            <button
              onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
              className="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
            >
              <i className="fas fa-bars text-xl"></i>
            </button>
          </div>
        </div>

        {/* Mobile Menu */}
        {isMobileMenuOpen && (
          <div className="lg:hidden border-t border-gray-200 py-4">
            <div className="space-y-4">
              <div className="text-center">
                <h3 className="text-lg font-medium text-gray-700">
                  Bienvenue dans votre espace client
                </h3>
              </div>
              <SearchBar onSearch={onSearch} />
            </div>
          </div>
        )}

        {/* Search Bar - Desktop */}
        <div className="block border-t border-gray-200 py-4">
          <SearchBar onSearch={onSearch} />
        </div>
      </div>
    </header>
  );
};

export default Header;
