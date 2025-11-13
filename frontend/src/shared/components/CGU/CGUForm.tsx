"use client";

import { useState } from "react";

interface CGUFormProps {
  onSubmit: (email: string, emailConfirm: string, acceptedCGU: boolean) => void;
  loading: boolean;
}

export function CGUForm({ onSubmit, loading }: CGUFormProps) {
  const [email, setEmail] = useState("");
  const [emailConfirm, setEmailConfirm] = useState("");
  const [acceptedCGU, setAcceptedCGU] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    onSubmit(email, emailConfirm, acceptedCGU);
  };

  return (
    <form
      onSubmit={handleSubmit}
      className="bg-white shadow rounded-lg p-6 space-y-6"
    >
      <div>
        <label
          htmlFor="email"
          className="block text-sm font-medium text-gray-700"
        >
          Email
        </label>
        <input
          id="email"
          type="email"
          required
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          placeholder="Votre adresse email"
          className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border"
          disabled={loading}
        />
      </div>

      <div>
        <label
          htmlFor="email_confirm"
          className="block text-sm font-medium text-gray-700"
        >
          Confirmation de l'email
        </label>
        <input
          id="email_confirm"
          type="email"
          required
          value={emailConfirm}
          onChange={(e) => setEmailConfirm(e.target.value)}
          placeholder="Confirmez votre adresse email"
          className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border"
          disabled={loading}
        />
      </div>

      <div className="flex items-start">
        <input
          id="valid_cgu"
          type="checkbox"
          checked={acceptedCGU}
          onChange={(e) => setAcceptedCGU(e.target.checked)}
          className="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
          disabled={loading}
        />
        <label htmlFor="valid_cgu" className="ml-2 block text-sm text-gray-700">
          J'accepte les Conditions Générales d'Utilisation
        </label>
      </div>

      <button
        type="submit"
        disabled={loading}
        className="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:bg-gray-400 disabled:cursor-not-allowed"
      >
        {loading ? "Traitement en cours..." : "Continuer"}
      </button>
    </form>
  );
}
