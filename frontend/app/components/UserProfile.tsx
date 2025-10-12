"use client";

import React from "react";
import { useDataStore } from "../store/dataStore";

const UserProfile: React.FC = () => {
  const { loginData } = useDataStore();

  if (!loginData) {
    return (
      <div className="p-4 bg-gray-100 rounded-lg">
        <p className="text-gray-600">No login data available</p>
      </div>
    );
  }

  return (
    <div className="p-4 bg-white rounded-lg shadow">
      <h2 className="text-lg font-semibold text-gray-800 mb-4">User Profile</h2>

      <div className="space-y-2">
        <div>
          <span className="font-medium text-gray-600">Name:</span>
          <span className="ml-2 text-gray-800">
            {loginData.firstName || loginData.userName || "N/A"}
          </span>
        </div>

        <div>
          <span className="font-medium text-gray-600">Email:</span>
          <span className="ml-2 text-gray-800">{loginData.email || "N/A"}</span>
        </div>

        <div>
          <span className="font-medium text-gray-600">User Type:</span>
          <span className="ml-2 text-gray-800">
            {loginData.userType || "N/A"}
          </span>
        </div>

        <div>
          <span className="font-medium text-gray-600">Client:</span>
          <span className="ml-2 text-gray-800">
            {loginData.clientName || "N/A"}
          </span>
        </div>

        <div>
          <span className="font-medium text-gray-600">Buildings:</span>
          <span className="ml-2 text-gray-800">
            {loginData.nbImmeubles || 0}
          </span>
        </div>

        <div>
          <span className="font-medium text-gray-600">Address:</span>
          <span className="ml-2 text-gray-800">
            {loginData.adresse
              ? `${loginData.adresse}, ${loginData.cp} ${loginData.ville}`
              : "N/A"}
          </span>
        </div>

        <div>
          <span className="font-medium text-gray-600">Phone:</span>
          <span className="ml-2 text-gray-800">
            {loginData.phoneNumber || "N/A"}
          </span>
        </div>
      </div>

      <div className="mt-4 pt-4 border-t border-gray-200">
        <h3 className="text-sm font-medium text-gray-600 mb-2">Permissions:</h3>
        <div className="flex flex-wrap gap-2">
          {loginData.showImmeublesArc && (
            <span className="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">
              Buildings
            </span>
          )}
          {loginData.showFactures && (
            <span className="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">
              Invoices
            </span>
          )}
          {loginData.showChgtOccupant && (
            <span className="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded">
              Occupant Changes
            </span>
          )}
          {loginData.showChantiers && (
            <span className="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">
              Construction Sites
            </span>
          )}
        </div>
      </div>
    </div>
  );
};

export default UserProfile;
