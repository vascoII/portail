import React from "react";

const Footer: React.FC = () => {
  return (
    <nav
      id="footer"
      className="navbar footer"
      style={{
        backgroundColor: "#606060",
        borderStyle: "solid",
        color: "#fff",
        textAlign: "center",
        justifyContent: "center",
        alignItems: "center",
        display: "flex",
        flexDirection: "column",
        flexWrap: "wrap",
        flexGrow: 1,
        flexShrink: 1,
        flexBasis: "100%",
        padding: "10px",
      }}
    >
      <div className="container">
        <div className="row">
          <div className="mt-8 text-center">
            <p className="mt-2 text-xs">
              © 2025 Techem France. Tous droits réservés.
            </p>
          </div>
        </div>
      </div>
    </nav>
  );
};

export default Footer;
