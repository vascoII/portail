import React from "react";

interface LoadingSpinnerProps {
  size?: "sm" | "md" | "lg";
  text?: string;
  className?: string;
}

const LoadingSpinner: React.FC<LoadingSpinnerProps> = ({
  size = "md",
  text = "Chargement...",
  className = "",
}) => {
  const sizeClasses = {
    sm: "spinner-border-sm",
    md: "",
    lg: "spinner-border-lg",
  };

  return (
    <div className={`text-center ${className}`}>
      <div className={`spinner-border ${sizeClasses[size]}`} role="status">
        <span className="sr-only">{text}</span>
      </div>
      {text && <div className="mt-2">{text}</div>}
    </div>
  );
};

export default LoadingSpinner;
