import React from "react";

interface SidebarProps {
  children?: React.ReactNode;
}

const Sidebar: React.FC<SidebarProps> = ({ children }) => {
  return (
    <div className="sidebar-menu offset">
      <ul id="main-menu" className="" style={{}}>
        {children}
      </ul>
    </div>
  );
};

export default Sidebar;
