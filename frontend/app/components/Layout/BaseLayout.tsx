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
  onSearch?: (query: string, type: string) => void;
}

const BaseLayout: React.FC<BaseLayoutProps> = ({
  children,
  showHeader = true,
  showSidebar = true,
  className = "",
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

  return (
    <div className={`min-h-screen bg-gray-50 ${className}`}>
      {showHeader && <Header onSearch={handleSearch} />}

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
