"use client";

import React from "react";

const Chantier: React.FC = () => {
  return (
    <div
      className="border-2 border-black rounded-lg p-4"
      style={{
        backgroundImage: "url('/images/chantier.png')",
        backgroundSize: "cover",
        backgroundPosition: "center",
        backgroundRepeat: "no-repeat",
        border: "1px solid #606060",
        borderRadius: 4,
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        color: "#1A1A1A",
        fontWeight: "bold",
        minHeight: "200px",
        position: "relative",
        padding: "47%",
      }}
    ></div>
  );
};

export default Chantier;
