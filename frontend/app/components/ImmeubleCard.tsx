"use client";

interface Props {
  name: string;
  address: string;
  numApartments: number;
}

export default function ImmeubleCard({ name, address, numApartments }: Props) {
  
  return (
    <div className="p-6 bg-white shadow-md rounded-lg border border-gray-200">
      <h2 className="text-xl font-semibold text-gray-800 mb-2">Résidence Les Tilleuls</h2>
      <p className="text-gray-600">12 rue des Fleurs, Paris</p>
      <p className="text-gray-700 mt-2">
        <span className="font-medium">Nombre d'appartements : 24</span>
      </p>
    </div>
  );
}
