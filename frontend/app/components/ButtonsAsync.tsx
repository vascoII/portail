"use client";

interface Props {
  id: string;
}

export default function ButtonsAsync({ id }: Props) {
  const handlePdf = async () => {
    const res = await fetch(`http://localhost:8000/api/immeubles/${id}/pdf`, {
      method: "POST",
    });
    const json = await res.json();
    alert("PDF: " + JSON.stringify(json));
  };

  const handleSync = async () => {
    const res = await fetch(`http://localhost:8000/api/immeubles/${id}/sync`, {
      method: "POST",
    });
    const json = await res.json();
    alert("Sync ERP: " + JSON.stringify(json));
  };

  return (
    <div className="mt-4 flex gap-4">
      <button
        className="px-4 py-2 bg-green-500 text-white rounded"
        onClick={handlePdf}
      >
        Générer PDF
      </button>
      <button
        className="px-4 py-2 bg-orange-500 text-white rounded"
        onClick={handleSync}
      >
        Sync ERP
      </button>
    </div>
  );
}
