import React from "react";

interface ConsumptionData {
  period: string;
  value: number;
  unit: string;
  trend: "up" | "down" | "stable";
  percentage: number;
}

interface ConsumptionPanelProps {
  title: string;
  data: ConsumptionData[];
  color: string;
  className?: string;
}

const ConsumptionPanel: React.FC<ConsumptionPanelProps> = ({
  title,
  data,
  color,
  className = "",
}) => {
  const getTrendIcon = (trend: string) => {
    switch (trend) {
      case "up":
        return "fa fa-arrow-up text-danger";
      case "down":
        return "fa fa-arrow-down text-success";
      case "stable":
        return "fa fa-minus text-muted";
      default:
        return "fa fa-minus text-muted";
    }
  };

  const getTrendClass = (trend: string) => {
    switch (trend) {
      case "up":
        return "text-danger";
      case "down":
        return "text-success";
      case "stable":
        return "text-muted";
      default:
        return "text-muted";
    }
  };

  return (
    <div className={`panel panel-default consumption-panel ${className}`}>
      <div className="panel-heading">
        <h4 className="panel-title">{title}</h4>
      </div>
      <div className="panel-body">
        <div className="consumption-chart">
          <canvas
            id={`chart-${title.toLowerCase().replace(/\s+/g, "-")}`}
            width="400"
            height="200"
          ></canvas>
        </div>
        <div className="consumption-stats">
          {data.map((item, index) => (
            <div key={index} className="consumption-item">
              <div className="period">{item.period}</div>
              <div className="value">
                {item.value} {item.unit}
              </div>
              <div className={`trend ${getTrendClass(item.trend)}`}>
                <i className={getTrendIcon(item.trend)}></i>
                {item.percentage}%
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default ConsumptionPanel;
