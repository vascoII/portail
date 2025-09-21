import React from "react";

interface TemperatureData {
  period: string;
  temperature: number;
  humidity: number;
  trend: "up" | "down" | "stable";
  percentage: number;
}

interface TemperaturePanelProps {
  title: string;
  data: TemperatureData[];
  color: string;
  className?: string;
}

const TemperaturePanel: React.FC<TemperaturePanelProps> = ({
  title,
  data,
  color,
  className = "",
}) => {
  return (
    <div className={`temperature-panel ${className}`}>
      <div className="panel panel-default">
        <div className="panel-heading">
          <h4 className="panel-title">
            <span className={`icon icon-temperature`}></span>
            {title}
          </h4>
        </div>
        <div className="panel-body">
          <div className="temperature-chart">
            <canvas
              id={`chart-temperature-${title
                .toLowerCase()
                .replace(/\s+/g, "-")}`}
              width="400"
              height="200"
            ></canvas>
          </div>
          <div className="temperature-stats">
            <div className="row">
              <div className="col-md-6">
                <div className="stat-item">
                  <div className="stat-label">Température actuelle</div>
                  <div className="stat-value">
                    {data[0]?.temperature || 0}°C
                  </div>
                </div>
              </div>
              <div className="col-md-6">
                <div className="stat-item">
                  <div className="stat-label">Humidité actuelle</div>
                  <div className="stat-value">{data[0]?.humidity || 0}%</div>
                </div>
              </div>
            </div>
            <div className="row">
              <div className="col-md-12">
                <div className="stat-item">
                  <div className="stat-label">Évolution</div>
                  <div
                    className={`stat-value ${
                      data[0]?.trend === "up"
                        ? "text-danger"
                        : data[0]?.trend === "down"
                        ? "text-success"
                        : "text-muted"
                    }`}
                  >
                    <i
                      className={`fa fa-arrow-${
                        data[0]?.trend === "up"
                          ? "up"
                          : data[0]?.trend === "down"
                          ? "down"
                          : "minus"
                      }`}
                    ></i>
                    {data[0]?.percentage || 0}%
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default TemperaturePanel;
