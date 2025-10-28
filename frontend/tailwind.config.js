/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/**/*.{js,ts,jsx,tsx,mdx}",
    "./pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./components/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  safelist: [
    "bg-blue-600",
    "text-white",
    "hover:bg-blue-700",
    "focus:ring-blue-500",
  ],
  theme: {
    extend: {
      colors: {
        // Original Techem colors from old CSS
        primary: {
          50: "#eff6ff",
          100: "#dbeafe",
          200: "#bfdbfe",
          300: "#93c5fd",
          400: "#60a5fa",
          500: "#3b82f6",
          600: "#2563eb",
          700: "#1d4ed8",
          800: "#1e40af",
          900: "#1e3a8a",
        },
        techem: {
          50: "#f0f9ff",
          100: "#e0f2fe",
          200: "#bae6fd",
          300: "#7dd3fc",
          400: "#38bdf8",
          500: "#0ea5e9",
          600: "#0284c7",
          700: "#0369a1",
          800: "#075985",
          900: "#0c4a6e",
        },
        // Dashboard specific colors from old CSS
        dashboard: {
          background: "#e8e8e9",
          panel: "#f4f5f9",
          panelBorder: "#d3d7db",
          panelShadow: "#d3d7db",
          textPrimary: "#333333",
          textSecondary: "#626b79",
          textMuted: "#8e98a2",
          accent: "#ff6633",
          danger: "#ff0000",
          warning: "#ff6633",
        },
        // Status gauge colors
        gauge: {
          active: "#ff6633",
          inactive: "#8e98a2",
          fuites: "#8e98a2",
          anomalies: "#ff6633",
          depannages: "#8e98a2",
          dysfonctionnements: "#8e98a2",
        },
      },
      fontFamily: {
        sans: ["Inter", "system-ui", "sans-serif"],
        // Original font from old CSS
        lucida: ["Lucida Grande", "Arial", "Verdana", "sans-serif"],
      },
      spacing: {
        // Dashboard specific spacing
        panel: "20px",
        "panel-sm": "15px",
        "panel-lg": "25px",
        gauge: "132px",
        "gauge-lg": "190px",
      },
      minHeight: {
        panel: "310px",
        "panel-sm": "195px",
        gauge: "195px",
        chantier: "295px",
      },
      boxShadow: {
        panel: "0px 0px 6px #d3d7db",
        "panel-hover": "none",
      },
      animation: {
        "fade-in": "fadeIn 0.5s ease-in-out",
        "slide-up": "slideUp 0.3s ease-out",
        "bounce-subtle": "bounceSubtle 2s infinite",
        // Loading animation from old CSS
        rotation: "rotation 3s linear infinite",
        "rotation-fast": "rotation 1s linear infinite",
      },
      keyframes: {
        fadeIn: {
          "0%": { opacity: "0" },
          "100%": { opacity: "1" },
        },
        slideUp: {
          "0%": { transform: "translateY(10px)", opacity: "0" },
          "100%": { transform: "translateY(0)", opacity: "1" },
        },
        bounceSubtle: {
          "0%, 100%": { transform: "translateY(0)" },
          "50%": { transform: "translateY(-5px)" },
        },
        rotation: {
          "0%": { transform: "rotate(0deg)" },
          "50%": { transform: "rotate(180deg)" },
          "100%": { transform: "rotate(360deg)" },
        },
      },
      // Custom utilities for dashboard components
      backgroundImage: {
        "gauge-fuites-on": "url('../images/fidesio/fuite_on.jpg')",
        "gauge-fuites-off": "url('../images/fidesio/fuite_off.jpg')",
        "gauge-anomalies-on": "url('../images/fidesio/anno_on.jpg')",
        "gauge-anomalies-off": "url('../images/fidesio/anno_off.jpg')",
        "gauge-alarm-on": "url('../images/fidesio/alarm_fui_on.jpg')",
        "gauge-alarm-off": "url('../images/fidesio/alarm_off.png')",
        "gauge-depannages": "url('../images/fidesio/bg-gauge-depannages.png')",
        "gauge-dysfonctionnements":
          "url('../images/fidesio/bg-gauge-dysfonctionnements.png')",
      },
    },
  },
  plugins: [
    require("@tailwindcss/forms"),
    // Custom plugin for dashboard utilities
    function ({ addUtilities }) {
      const newUtilities = {
        ".panel-primary": {
          minHeight: "310px",
          overflow: "hidden",
          padding: "20px",
          borderBottom: "1px solid #c3c3c3",
          borderRadius: "0",
        },
        ".panel-default": {
          minHeight: "195px",
          background: "#f4f5f9",
          border: "1px solid #d3d7db",
          boxShadow: "0px 0px 6px #d3d7db",
        },
        ".panel-default:hover": {
          boxShadow: "none",
        },
        ".status-gauge": {
          position: "relative",
        },
        ".status-gauge .canvas": {
          height: "132px",
          textAlign: "center",
        },
        ".status-gauge .intitule": {
          height: "36px",
          lineHeight: "36px",
        },
        ".status-gauge .taux": {
          position: "absolute",
          right: "4%",
          top: "7px",
        },
        ".performance-gauge .canvas": {
          textAlign: "center",
        },
        ".chantier": {
          height: "295px",
        },
        ".chantier .panel-body": {
          padding: "0",
        },
        ".transfert .panel-body": {
          padding: "0",
        },
        ".performance .panel-body": {
          padding: "0",
        },
      };
      addUtilities(newUtilities);
    },
  ],
};
