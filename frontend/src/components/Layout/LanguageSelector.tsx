"use client";
import React, { useState } from "react";
import { useRouter } from "next/navigation";

const LanguageSelector: React.FC = () => {
  const [isOpen, setIsOpen] = useState(false);
  const router = useRouter();
  const currentLocale = router.locale || "fr";

  const changeLanguage = (locale: string) => {
    router.push(router.asPath, router.asPath, { locale });
    setIsOpen(false);
  };

  return (
    <div className="dropdown language-menu input-group">
      <button
        className="btn btn-primary btn-lg dropdown-toggle -sm -xs"
        type="button"
        onClick={() => setIsOpen(!isOpen)}
      >
        {currentLocale.toUpperCase()}
        <span className="carett"></span>
      </button>
      {isOpen && (
        <ul className="dropdown-menu" role="menu">
          <li role="presentation">
            <button
              role="menuitem"
              tabIndex={-1}
              onClick={() => changeLanguage("fr")}
            >
              FR
            </button>
          </li>
          <li role="presentation">
            <button
              role="menuitem"
              tabIndex={-1}
              onClick={() => changeLanguage("en")}
            >
              EN
            </button>
          </li>
        </ul>
      )}
    </div>
  );
};

export default LanguageSelector;
