"use client";
import React, { useState } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";
import Alert from "../../components/UI/Alert";
import Button from "../../components/UI/Button";
import Input from "../../components/UI/Input";

const ResetPasswordPage: React.FC = () => {
  const [email, setEmail] = useState("");
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState(false);
  const router = useRouter();

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setError(null);

    try {
      const response = await fetch("/api/auth/reset-password", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ email }),
      });

      if (response.ok) {
        setSuccess(true);
      } else {
        const errorData = await response.json();
        setError(errorData.message || "Erreur lors de la réinitialisation");
      }
    } catch (err) {
      setError("Une erreur est survenue. Veuillez réessayer.");
    } finally {
      setLoading(false);
    }
  };

  if (success) {
    return (
      <div className="reset-password-page">
        <div className="main-content">
          <Link href="/dashboard" className="logo">
            <img src="/images/logo.svg" alt="Techem" />
          </Link>

          <div className="success-message">
            <div className="alert alert-success">
              <h4>Email envoyé !</h4>
              <p>
                Si un compte existe avec cette adresse email, vous recevrez un
                lien de réinitialisation de mot de passe.
              </p>
            </div>
            <Link href="/login" className="btn btn-primary">
              Retour à la connexion
            </Link>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="reset-password-page">
      <div className="main-content">
        <Link href="/dashboard" className="logo">
          <img src="/images/logo.svg" alt="Techem" />
        </Link>

        <div className="reset-form-container">
          <h2>Mot de passe oublié</h2>
          <p className="text-muted">
            Entrez votre adresse email pour recevoir un lien de réinitialisation
          </p>

          {error && <Alert type="danger" message={error} />}

          <form onSubmit={handleSubmit} className="form">
            <Input
              type="email"
              name="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Adresse email"
              label="Adresse email"
              required
            />

            <Button
              type="submit"
              variant="primary"
              loading={loading}
              className="w-100"
            >
              {loading ? "Envoi en cours..." : "Envoyer le lien"}
            </Button>
          </form>

          <div className="form-footer">
            <Link href="/login" className="text-muted">
              ← Retour à la connexion
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ResetPasswordPage;
