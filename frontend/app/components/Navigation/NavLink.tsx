"use client";
import React from "react";
import Link from "next/link";
import { useRouter } from "next/navigation";

interface NavLinkProps {
  href: string;
  children: React.ReactNode;
  className?: string;
  activeClassName?: string;
  exact?: boolean;
}

const NavLink: React.FC<NavLinkProps> = ({
  href,
  children,
  className = "",
  activeClassName = "active",
  exact = false,
}) => {
  const router = useRouter();
  const isActive = exact
    ? router.asPath === href
    : router.asPath.startsWith(href);

  const linkClassName = `${className} ${
    isActive ? activeClassName : ""
  }`.trim();

  return (
    <Link href={href} className={linkClassName}>
      {children}
    </Link>
  );
};

export default NavLink;
