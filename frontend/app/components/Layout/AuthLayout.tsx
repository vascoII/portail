import React from "react";
import Link from "next/link";

interface AuthLayoutProps {
  children: React.ReactNode;
  title?: string;
  subtitle?: string;
  className?: string;
}

const AuthLayout: React.FC<AuthLayoutProps> = ({
  children,
  title,
  subtitle,
  className = "",
}) => {
  return (
    <div className={`auth-page ${className}`}>
      <div className="main-content">
        <Link href="/pages/dashboard" className="logo">
          <img src="/images/logo.svg" alt="Techem" />
        </Link>

        <div className="auth-form-container">
          {title && <h2>{title}</h2>}
          {subtitle && <p className="text-muted">{subtitle}</p>}
          {children}
        </div>
      </div>
    </div>
  );
};

export default AuthLayout;
