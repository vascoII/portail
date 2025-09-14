"use client";

interface Props {
  name: string;
  address: string;
  numApartments: number;
}

export default function ImmeubleCard({ name, address, numApartments }: Props) {
  return (
    <div className="p-4 border rounded mb-4">
      <h2>{name}</h2>
      <p>{address}</p>
      <p>Nombre d'appartements : {numApartments}</p>
    </div>
  );
}
