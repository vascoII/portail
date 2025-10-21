"use client";
import React from "react";
import { useRouter } from "next/navigation";
import NavLink from "./NavLink";
import { ROUTES } from "@/config/routes";

interface BreadcrumbItem {
  label: string;
  href?: string;
  isActive?: boolean;
}

interface BreadcrumbNavProps {
  items: BreadcrumbItem[];
  className?: string;
  separator?: string;
}

const BreadcrumbNav: React.FC<BreadcrumbNavProps> = ({
  items,
  className = "",
  separator = "/",
}) => {
  const router = useRouter();

  return (
    <nav aria-label="breadcrumb" className={`breadcrumb-nav ${className}`}>
      <ol className="breadcrumb">
        {items.map((item, index) => {
          const isLast = index === items.length - 1;
          const isActive = item.isActive || isLast;

          return (
            <li
              key={index}
              className={`breadcrumb-item ${isActive ? "active" : ""}`}
            >
              {isActive || !item.href ? (
                <span>{item.label}</span>
              ) : (
                <NavLink href={item.href}>{item.label}</NavLink>
              )}
              {!isLast && (
                <span className="breadcrumb-separator" aria-hidden="true">
                  {separator}
                </span>
              )}
            </li>
          );
        })}
      </ol>
    </nav>
  );
};

export default BreadcrumbNav;
