"use client";

import React, { useState } from "react";

interface FormValidationProps {
  onSubmit: (data: any) => void;
  children: React.ReactNode;
}

interface ValidationError {
  field: string;
  message: string;
}

const FormValidation: React.FC<FormValidationProps> = ({
  onSubmit,
  children,
}) => {
  const [errors, setErrors] = useState<ValidationError[]>([]);
  const [isSubmitting, setIsSubmitting] = useState(false);

  const validateForm = (formData: any): ValidationError[] => {
    const validationErrors: ValidationError[] = [];

    // Date validation
    if (formData.dateBegin && formData.dateEnd) {
      const beginDate = new Date(formData.dateBegin);
      const endDate = new Date(formData.dateEnd);

      if (beginDate > endDate) {
        validationErrors.push({
          field: "dateEnd",
          message: "La date de fin doit être après la date de début",
        });
      }

      if (beginDate > new Date()) {
        validationErrors.push({
          field: "dateBegin",
          message: "La date de début ne peut pas être dans le futur",
        });
      }

      if (endDate > new Date()) {
        validationErrors.push({
          field: "dateEnd",
          message: "La date de fin ne peut pas être dans le futur",
        });
      }
    }

    // Required field validation
    if (!formData.docType) {
      validationErrors.push({
        field: "docType",
        message: "Type de document requis",
      });
    }

    if (!formData.dateBegin) {
      validationErrors.push({
        field: "dateBegin",
        message: "Date de début requise",
      });
    }

    if (!formData.dateEnd) {
      validationErrors.push({
        field: "dateEnd",
        message: "Date de fin requise",
      });
    }

    return validationErrors;
  };

  const handleSubmit = async (formData: any) => {
    setIsSubmitting(true);
    setErrors([]);

    const validationErrors = validateForm(formData);

    if (validationErrors.length > 0) {
      setErrors(validationErrors);
      setIsSubmitting(false);
      return;
    }

    try {
      await onSubmit(formData);
    } catch (error) {
      setErrors([
        {
          field: "general",
          message: "Erreur lors de la soumission du formulaire",
        },
      ]);
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className="form-validation">
      {children}
      {errors.length > 0 && (
        <div className="mt-4 space-y-2">
          {errors.map((error, index) => (
            <div
              key={index}
              className="bg-red-50 border border-red-200 rounded-md p-3"
            >
              <p className="text-red-600 text-sm">{error.message}</p>
            </div>
          ))}
        </div>
      )}
    </div>
  );
};

export default FormValidation;
