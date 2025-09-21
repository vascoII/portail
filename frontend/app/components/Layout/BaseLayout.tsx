import React from "react";
import Header from "./Header";
import Sidebar from "./Sidebar";
import Footer from "./Footer";

interface BaseLayoutProps {
  children: React.ReactNode;
  showHeader?: boolean;
  showSidebar?: boolean;
  className?: string;
}

const BaseLayout: React.FC<BaseLayoutProps> = ({
  children,
  showHeader = true,
  showSidebar = true,
  className = "",
}) => {
  return (
    <div className={`page-container horizontal-menu with-sidebar ${className}`}>
      {showHeader && <Header />}
      {showSidebar && <Sidebar />}
      <div className="main-content">{children}</div>
      <Footer />
    </div>
  );
};

export default BaseLayout;
