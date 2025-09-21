import React, { useState } from "react";
import Link from "next/link";

interface UserMenuProps {
  user?: {
    name?: string;
    firstName?: string;
    pkUser?: number;
  };
  isAdmin?: boolean;
  showFactures?: boolean;
}

const UserMenu: React.FC<UserMenuProps> = ({
  user,
  isAdmin = false,
  showFactures = false,
}) => {
  const [isOpen, setIsOpen] = useState(false);

  const displayName =
    user?.name || user?.firstName || `Utilisateur #${user?.pkUser}`;

  return (
    <div className="dropdown user-menu input-group">
      <button
        className="btn btn-primary btn-lg dropdown-toggle hidden-sm hidden-xs"
        type="button"
        onClick={() => setIsOpen(!isOpen)}
      >
        <span className="carett"></span>
        <i className="icon-user"></i>
        {displayName}
      </button>
      <button
        className="btn btn-primary btn-lg dropdown-toggle hidden-lg hidden-md"
        type="button"
        onClick={() => setIsOpen(!isOpen)}
      >
        <i className="fa fa-user"></i>
      </button>
      {isOpen && (
        <ul className="dropdown-menu" role="menu">
          <li role="presentation">
            <Link href="/update-password" role="menuitem" tabIndex={-1}>
              <i className="icon-pen"></i>
              Mon Compte
            </Link>
          </li>

          {isAdmin && (
            <>
              <li role="presentation">
                <Link href="/operators/create" role="menuitem" tabIndex={-1}>
                  Créer un compte
                </Link>
              </li>
              <li role="presentation">
                <Link href="/operators" role="menuitem" tabIndex={-1}>
                  Gérer les comptes
                </Link>
              </li>
              {showFactures && (
                <li role="presentation">
                  <Link href="/factures" role="menuitem" tabIndex={-1}>
                    <i className="icon-pen"></i>
                    Factures
                  </Link>
                </li>
              )}
              <li role="presentation">
                <Link href="/operators/stats" role="menuitem" tabIndex={-1}>
                  <i className="icon-pen"></i>
                  Stats Connexion Occupants
                </Link>
              </li>
            </>
          )}

          <li role="presentation">
            <Link href="/logout" role="menuitem" tabIndex={-1}>
              <i className="icon-lock-open-alt"></i>
              Déconnexion
            </Link>
          </li>
        </ul>
      )}
    </div>
  );
};

export default UserMenu;
