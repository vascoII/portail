"use client";

import React from "react";
import Link from "next/link";

interface BreadcrumbItem {
  label: string;
  href?: string;
}

interface BreadcrumbProps {
  items: BreadcrumbItem[];
  className?: string;
}

const Breadcrumb: React.FC<BreadcrumbProps> = ({ items, className = "" }) => {
  return (
    <nav
      aria-label="breadcrumb"
      className={`flex items-center gap-2 flex-wrap ${className}`}
    >
      {items.map((item, index) => {
        const isLast = index === items.length - 1;
        const isActive = !item.href || isLast;

        return (
          <React.Fragment key={index}>
            {isActive ? (
              <div
                className="px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 text-gray-700 font-medium"
                style={{
                  borderColor: "#606060",
                  borderStyle: "solid",
                  borderWidth: "1px",
                  borderRadius: "10px",
                }}
              >
                <span>{item.label}</span>
              </div>
            ) : (
              <Link
                href={item.href!}
                className="px-4 py-2 rounded-lg bg-white border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 hover:border-gray-400 transition-all duration-200"
                style={{
                  borderColor: "#606060",
                  borderStyle: "solid",
                  borderWidth: "1px",
                  borderRadius: "10px",
                }}
              >
                {item.label}
              </Link>
            )}
            {!isLast && (
              <span
                className="text-gray-400 mx-1"
                aria-hidden="true"
                style={{ fontSize: "0.875rem" }}
              >
                <i className="fas fa-chevron-right"></i>
              </span>
            )}
          </React.Fragment>
        );
      })}
    </nav>
  );
};

export default Breadcrumb;
