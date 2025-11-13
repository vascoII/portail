"use client";

import React, { useState } from "react";
import BaseLayout from "./BaseLayout";

const LayoutExample: React.FC = () => {
  const [locale, setLocale] = useState("fr");

  // Mock user data
  const user = {
    userName: "admin",
    firstName: "Jean",
    pkUser: 1,
  };

  const handleSearch = (query: string, type: string) => {
    console.log("Search performed:", { query, type });
    // Implement search logic here
  };

  const handleLocaleChange = (newLocale: string) => {
    setLocale(newLocale);
    console.log("Locale changed to:", newLocale);
    // Implement locale change logic here
  };

  return (
    <BaseLayout
      user={user}
      isAdmin={true}
      showFactures={true}
      locale={locale}
      onLocaleChange={handleLocaleChange}
      onSearch={handleSearch}
    >
      <div className="p-8">
        <h1 className="text-3xl font-bold text-gray-900 mb-4">
          Layout Example
        </h1>
        <p className="text-gray-600">
          This is an example of how to use the updated BaseLayout with the new
          UserMenu and SearchBar components.
        </p>

        <div className="mt-8 space-y-4">
          <div className="bg-white p-6 rounded-lg shadow">
            <h2 className="text-xl font-semibold mb-2">Features</h2>
            <ul className="list-disc list-inside space-y-1 text-gray-600">
              <li>Modern Tailwind CSS styling</li>
              <li>Responsive design</li>
              <li>User menu with admin options</li>
              <li>Language selector</li>
              <li>Advanced search functionality</li>
              <li>Mobile-friendly interface</li>
            </ul>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default LayoutExample;
