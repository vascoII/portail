"use client";

import React from "react";
import BaseLayout from "@/components/Layout/BaseLayout";
import Breadcrumb from "@/components/Layout/Breadcrumb";
import { useAuth } from "@/hooks/useAuth";
import Alert from "@/components/UI/Alert";

const ProfilePage: React.FC = () => {
  const { user, isLoading, error } = useAuth();

  const breadcrumbItems = [{ label: "Mon compte", href: "/profile" }];

  if (isLoading) {
    return (
      <BaseLayout>
        <div className="text-center">
          <div className="spinner-border" role="status">
            <span className="sr-only">Chargement...</span>
          </div>
        </div>
      </BaseLayout>
    );
  }

  if (error || !user) {
    return (
      <BaseLayout>
        <div className="alert alert-danger">
          Erreur : {error || "Utilisateur non trouvé"}
        </div>
      </BaseLayout>
    );
  }

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Mon profil</h2>

      <div className="row">
        <div className="col-md-8">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Informations personnelles</h3>
            </div>
            <div className="panel-body">
              <div className="row">
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Nom</label>
                    <p className="form-control-static">
                      {user.name || "Non renseigné"}
                    </p>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Prénom</label>
                    <p className="form-control-static">
                      {user.firstName || "Non renseigné"}
                    </p>
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Email</label>
                    <p className="form-control-static">
                      {user.email || "Non renseigné"}
                    </p>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Téléphone</label>
                    <p className="form-control-static">
                      {user.phone || "Non renseigné"}
                    </p>
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Rôle</label>
                    <p className="form-control-static">
                      {user.role || "Utilisateur"}
                    </p>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Date de création</label>
                    <p className="form-control-static">
                      {user.createdAt
                        ? new Date(user.createdAt).toLocaleDateString("fr-FR")
                        : "Non renseigné"}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="col-md-4">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Actions</h3>
            </div>
            <div className="panel-body">
              <div className="list-group">
                <a href="/auth/update-password" className="list-group-item">
                  <i className="fa fa-key"></i> Modifier le mot de passe
                </a>
                <a href="/legal/personal-datas" className="list-group-item">
                  <i className="fa fa-shield"></i> Données personnelles
                </a>
                <a href="/legal/cgu" className="list-group-item">
                  <i className="fa fa-file-text"></i> Conditions générales
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default ProfilePage;
