"use client";

import React from "react";
import {
  ExclamationTriangleIcon,
  CheckCircleIcon,
  InformationCircleIcon,
  XCircleIcon,
} from "@heroicons/react/24/outline";

export type AlertType = "success" | "error" | "warning" | "info";

interface AlertProps {
  type: AlertType;
  message: string;
  title?: string;
  onClose?: () => void;
  className?: string;
}

const Alert: React.FC<AlertProps> = ({
  type,
  message,
  title,
  onClose,
  className = "",
}) => {
  const getAlertStyles = () => {
    const baseStyles = "rounded-lg p-4 border";

    switch (type) {
      case "success":
        return `${baseStyles} bg-green-50 border-green-200 text-green-800`;
      case "error":
        return `${baseStyles} bg-red-50 border-red-200 text-red-800`;
      case "warning":
        return `${baseStyles} bg-yellow-50 border-yellow-200 text-yellow-800`;
      case "info":
        return `${baseStyles} bg-blue-50 border-blue-200 text-blue-800`;
      default:
        return `${baseStyles} bg-gray-50 border-gray-200 text-gray-800`;
    }
  };

  const getIcon = () => {
    const iconClass = "h-5 w-5 flex-shrink-0";

    switch (type) {
      case "success":
        return <CheckCircleIcon className={`${iconClass} text-green-400`} />;
      case "error":
        return <XCircleIcon className={`${iconClass} text-red-400`} />;
      case "warning":
        return (
          <ExclamationTriangleIcon className={`${iconClass} text-yellow-400`} />
        );
      case "info":
        return (
          <InformationCircleIcon className={`${iconClass} text-blue-400`} />
        );
      default:
        return (
          <InformationCircleIcon className={`${iconClass} text-gray-400`} />
        );
    }
  };

  return (
    <div className={`${getAlertStyles()} ${className}`}>
      <div className="flex">
        <div className="flex-shrink-0">{getIcon()}</div>
        <div className="ml-3 flex-1">
          {title && <h3 className="text-sm font-medium mb-1">{title}</h3>}
          <p className="text-sm">{message}</p>
        </div>
        {onClose && (
          <div className="ml-auto pl-3">
            <div className="-mx-1.5 -my-1.5">
              <button
                type="button"
                onClick={onClose}
                className="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors"
                aria-label="Fermer"
              >
                <span className="sr-only">Fermer</span>
                <XCircleIcon className="h-4 w-4" />
              </button>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default Alert;
