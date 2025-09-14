"use client";

import { useRouter } from "next/navigation";

export default function HomePage() {
  const router = useRouter();

  const goToImmeuble = () => {
    router.push("/immeubles/1234"); // id fake pour le POC
  };

  return (
    <main className="p-8">
      <h1>Bienvenue sur le POC Immeuble</h1>
      <button
        className="mt-4 px-4 py-2 bg-blue-500 text-white rounded"
        onClick={goToImmeuble}
      >
        Immeuble
      </button>
    </main>
  );
}
