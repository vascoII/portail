import React, { useState } from "react";

interface PasswordFormProps {
  onSubmit: (passwords: {
    currentPassword: string;
    newPassword: string;
    confirmPassword: string;
  }) => void;
  loading?: boolean;
  error?: string;
  success?: string;
}

const PasswordForm: React.FC<PasswordFormProps> = ({
  onSubmit,
  loading = false,
  error,
  success,
}) => {
  const [passwords, setPasswords] = useState({
    currentPassword: "",
    newPassword: "",
    confirmPassword: "",
  });
  const [errors, setErrors] = useState<{ [key: string]: string }>({});

  const validateForm = () => {
    const newErrors: { [key: string]: string } = {};

    if (!passwords.currentPassword) {
      newErrors.currentPassword = "Le mot de passe actuel est requis";
    }

    if (!passwords.newPassword) {
      newErrors.newPassword = "Le nouveau mot de passe est requis";
    } else if (passwords.newPassword.length < 8) {
      newErrors.newPassword =
        "Le mot de passe doit contenir au moins 8 caractères";
    }

    if (passwords.newPassword !== passwords.confirmPassword) {
      newErrors.confirmPassword = "Les mots de passe ne correspondent pas";
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (validateForm()) {
      onSubmit(passwords);
    }
  };

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setPasswords({
      ...passwords,
      [e.target.name]: e.target.value,
    });
    // Clear error when user starts typing
    if (errors[e.target.name]) {
      setErrors({
        ...errors,
        [e.target.name]: "",
      });
    }
  };

  return (
    <form onSubmit={handleSubmit} className="form-horizontal">
      {error && (
        <div className="alert alert-danger" role="alert">
          {error}
        </div>
      )}

      {success && (
        <div className="alert alert-success" role="alert">
          {success}
        </div>
      )}

      <div className="form-group">
        <label htmlFor="currentPassword" className="control-label">
          Mot de passe actuel
        </label>
        <input
          type="password"
          id="currentPassword"
          name="currentPassword"
          className="form-control"
          value={passwords.currentPassword}
          onChange={handleChange}
          required
        />
        {errors.currentPassword && (
          <span className="help-block text-danger">
            {errors.currentPassword}
          </span>
        )}
      </div>

      <div className="form-group">
        <label htmlFor="newPassword" className="control-label">
          Nouveau mot de passe
        </label>
        <input
          type="password"
          id="newPassword"
          name="newPassword"
          className="form-control"
          value={passwords.newPassword}
          onChange={handleChange}
          required
        />
        {errors.newPassword && (
          <span className="help-block text-danger">{errors.newPassword}</span>
        )}
      </div>

      <div className="form-group">
        <label htmlFor="confirmPassword" className="control-label">
          Confirmer le nouveau mot de passe
        </label>
        <input
          type="password"
          id="confirmPassword"
          name="confirmPassword"
          className="form-control"
          value={passwords.confirmPassword}
          onChange={handleChange}
          required
        />
        {errors.confirmPassword && (
          <span className="help-block text-danger">
            {errors.confirmPassword}
          </span>
        )}
      </div>

      <div className="form-group">
        <button type="submit" className="btn btn-primary" disabled={loading}>
          {loading ? "Modification..." : "Modifier le mot de passe"}
        </button>
      </div>
    </form>
  );
};

export default PasswordForm;
