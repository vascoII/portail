"use client";

import React, { useState } from "react";
import Header from "./Header";
import Sidebar from "./Sidebar";
import Footer from "./Footer";

interface BaseLayoutProps {
  children: React.ReactNode;
  showHeader?: boolean;
  showSidebar?: boolean;
  className?: string;
  user?: {
    userName?: string;
    firstName?: string;
    pkUser?: number;
  };
  isAdmin?: boolean;
  showFactures?: boolean;
  locale?: string;
  onLocaleChange?: (locale: string) => void;
  onSearch?: (query: string, type: string) => void;
}

const BaseLayout: React.FC<BaseLayoutProps> = ({
  children,
  showHeader = true,
  showSidebar = true,
  className = "",
  user,
  isAdmin = false,
  showFactures = false,
  locale = "fr",
  onLocaleChange,
  onSearch,
}) => {
  const [isSidebarOpen, setIsSidebarOpen] = useState(false);

  const handleSearch = (query: string, type: string) => {
    if (onSearch) {
      onSearch(query, type);
    } else {
      // Default search behavior
      console.log("Search:", { query, type });
    }
  };

  const handleLocaleChange = (newLocale: string) => {
    if (onLocaleChange) {
      onLocaleChange(newLocale);
    } else {
      // Default locale change behavior
      console.log("Locale changed to:", newLocale);
    }
  };

  return (
    <div className={`min-h-screen bg-gray-50 ${className}`}>
      {showHeader && (
        <Header
          user={user}
          isAdmin={isAdmin}
          showFactures={showFactures}
          locale={locale}
          onLocaleChange={handleLocaleChange}
          onSearch={handleSearch}
        />
      )}

      <div className="flex">
        {showSidebar && (
          <Sidebar
            isOpen={isSidebarOpen}
            onToggle={() => setIsSidebarOpen(!isSidebarOpen)}
          />
        )}

        <main className={`flex-1 ${showSidebar ? "lg:ml-64" : ""}`}>
          <div className="min-h-screen">{children}</div>
        </main>
      </div>

      <Footer />
    </div>
  );
};

export default BaseLayout;
