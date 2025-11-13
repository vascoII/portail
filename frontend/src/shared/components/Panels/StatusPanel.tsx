import React from "react";
import Link from "next/link";

interface StatusPanelProps {
  title: string;
  value: number;
  maxValue?: number;
  icon: string;
  color: string;
  href?: string;
  className?: string;
}

const StatusPanel: React.FC<StatusPanelProps> = ({
  title,
  value,
  maxValue = 100,
  icon,
  color,
  href,
  className = "",
}) => {
  const percentage = maxValue > 0 ? (value / maxValue) * 100 : 0;
  const isActive = value > 0;

  const panelContent = (
    <div className={`panel ${className}`}>
      <div className={`canvas ${isActive ? "active" : ""}`}>
        <canvas
          width="139"
          height="113"
          data-options={JSON.stringify({
            value: percentage / 100,
            fillGaugeStyle: color,
          })}
        ></canvas>
        <div className="icons">
          <i className={`icon ${icon}`}></i>
        </div>
      </div>
      <div className="number">{value}</div>
      <div className="text">
        <span>{title}</span>
      </div>
    </div>
  );

  if (href) {
    return (
      <div className="panel-default">
        <Link href={href} className="status-link">
          {panelContent}
        </Link>
      </div>
    );
  }

  return <div className="panel-default">{panelContent}</div>;
};

export default StatusPanel;
