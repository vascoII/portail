"use client";

import React, { useState } from "react";
import Link from "next/link";
import Image from "next/image";

const sections = [
  {
    title: "1. Périmètre",
    content: `Cette déclaration de protection des données s'applique au portail client de Techem France...`,
  },
  {
    title: "2. Protection des données",
    content: `Techem France prend très au sérieux la protection de ses données personnelles...`,
  },
  {
    title: "3. Autorité responsable",
    content: `Techem FRANCE\nEric CHAUMONT\n378-380 avenue de la division Leclerc\n92290 CHATENAY MALABRY...`,
  },
  // ... ajoute les autres sections ici jusqu'à 17
];

const RgpdPage: React.FC = () => {
  const [openSections, setOpenSections] = useState<boolean[]>(
    sections.map(() => false)
  );
  const toggleSection = (index: number) => {
    setOpenSections((prev) =>
      prev.map((isOpen, i) => (i === index ? !isOpen : isOpen))
    );
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div
        className="absolute top-0 left-0 right-0 w-full h-64 bg-top bg-no-repeat bg-cover pointer-events-none"
        style={{
          backgroundImage: "url('/images/login-bg.png')",
          zIndex: 1,
        }}
      />
      <div className="sm:mx-auto sm:w-full sm:max-w-md" style={{ zIndex: 1 }}>
        {/* Logo */}
        <div className="flex justify-center">
          <Link href="/pages/dashboard" className="flex items-center">
            <div className="flex-shrink-0">
              <Image
                width={0}
                height={0}
                className="h-20 w-auto"
                src="/images/logo.svg"
                alt="Techem"
                onError={(e) => {
                  // Fallback si l'image n'existe pas
                  e.currentTarget.style.display = "none";
                  e.currentTarget.nextElementSibling?.classList.remove(
                    "hidden"
                  );
                }}
              />
              <div className="hidden h-12 w-32 bg-blue-600 rounded-lg flex items-center justify-center">
                <span className="text-white font-bold text-xl">TECHEM</span>
              </div>
            </div>
          </Link>
        </div>

        {/* Titre */}
        <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
          RGPD – Protection des données
        </h2>
        <p className="mt-2 text-center text-sm text-gray-600">
          Informations relatives à la collecte et au traitement de vos données
          personnelles
        </p>
      </div>

      <div
        className="mt-8 mx-auto w-full lg:w-3/4 max-w-5xl"
        style={{ zIndex: 1 }}
      >
        <div className="bg-white py-8 px-4 shadow-xl sm:rounded-lg sm:px-10">
          {sections.map((section, index) => (
            <div key={index} className="border rounded">
              <button
                onClick={() => toggleSection(index)}
                className="w-full text-left px-4 py-3 bg-gray-100 hover:bg-gray-200 font-semibold text-gray-800 flex justify-between items-center"
              >
                <span>{section.title}</span>
                <span>{openSections[index] ? "−" : "+"}</span>
              </button>
              {openSections[index] && (
                <div className="px-4 py-3 text-gray-700 whitespace-pre-line">
                  {section.content}
                </div>
              )}
            </div>
          ))}
        </div>

        {/* Footer */}
        <div className="mt-8 text-center">
          <p className="mt-2 text-xs text-gray-400">
            © 2025 Techem France. Tous droits réservés.
          </p>
        </div>
      </div>
    </div>
  );
};

export default RgpdPage;
