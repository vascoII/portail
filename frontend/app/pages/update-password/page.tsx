"use client";
import React, { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";
import PasswordForm from "../../components/Forms/PasswordForm";
import Alert from "../../components/UI/Alert";
import { useAuth } from "../../hooks/useAuth";

const UpdatePasswordPage: React.FC = () => {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<string | null>(null);
  const { user } = useAuth();
  const router = useRouter();

  useEffect(() => {
    if (user) {
      router.push("pages/login");
    }
  }, [user, router]);

  const handlePasswordUpdate = async (passwords: {
    currentPassword: string;
    newPassword: string;
    confirmPassword: string;
  }) => {
    setLoading(true);
    setError(null);
    setSuccess(null);

    try {
      const response = await fetch("/api/auth/update-password", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${localStorage.getItem("authToken")}`,
        },
        body: JSON.stringify({
          currentPassword: passwords.currentPassword,
          newPassword: passwords.newPassword,
        }),
      });

      if (response.ok) {
        setSuccess("Mot de passe modifié avec succès !");
        // Optionally redirect after a delay
        setTimeout(() => {
          router.push("/pages/dashboard");
        }, 2000);
      } else {
        const errorData = await response.json();
        setError(errorData.message || "Erreur lors de la modification");
      }
    } catch (err) {
      setError("Une erreur est survenue. Veuillez réessayer.");
    } finally {
      setLoading(false);
    }
  };

  if (user) {
    return <div>Chargement...</div>;
  }

  const breadcrumbItems = [
    { label: "Mon compte", href: "/pages/account" },
    { label: "Modifier le mot de passe" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <div className="row">
        <div className="col-md-8 col-md-offset-2">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Modifier le mot de passe</h3>
            </div>
            <div className="panel-body">
              {error && <Alert type="danger" message={error} />}
              {success && <Alert type="success" message={success} />}

              <PasswordForm onSubmit={handlePasswordUpdate}/>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default UpdatePasswordPage;
