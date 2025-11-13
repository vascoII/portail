import React from "react";
import ConsumptionPanel from "../Panels/ConsumptionPanel";

interface HeatingData {
  period: string;
  value: number;
  unit: string;
  trend: "up" | "down" | "stable";
  percentage: number;
}

interface HeatingPanelProps {
  title: string;
  data: HeatingData[];
  color: string;
  nbCompteurs: number;
  className?: string;
}

const HeatingPanel: React.FC<HeatingPanelProps> = ({
  title,
  data,
  color,
  nbCompteurs,
  className = "",
}) => {
  return (
    <div className={`heating-panel ${className}`}>
      <div className="panel panel-default">
        <div className="panel-heading">
          <h4 className="panel-title">
            <span className={`icon icon-speedometer10`}></span>
            {title}
          </h4>
          <div className="panel-subtitle">
            {nbCompteurs} compteur{nbCompteurs > 1 ? "s" : ""}
          </div>
        </div>
        <div className="panel-body">
          <ConsumptionPanel
            title={`Consommation ${title.toLowerCase()}`}
            data={data}
            color={color}
          />
          <div className="heating-stats">
            <div className="row">
              <div className="col-md-6">
                <div className="stat-item">
                  <div className="stat-label">Consommation actuelle</div>
                  <div className="stat-value">
                    {data[0]?.value || 0} {data[0]?.unit || "kWh"}
                  </div>
                </div>
              </div>
              <div className="col-md-6">
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

export default HeatingPanel;
