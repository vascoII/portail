"use client";

import React, { useState } from "react";
import { useForm } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import DatePicker from "react-datepicker";
import { motion, AnimatePresence } from "framer-motion";
import "react-datepicker/dist/react-datepicker.css";

interface InterventionModalProps {
  isOpen: boolean;
  onClose: () => void;
}

interface InterventionFormData {
  docType: "synthese-inte" | "detail-inte" | "detail-excel-inte";
  dateBegin: Date;
  dateEnd: Date;
}

const schema = yup.object({
  docType: yup
    .string()
    .oneOf(["synthese-inte", "detail-inte", "detail-excel-inte"])
    .required("Type de document requis"),
  dateBegin: yup
    .date()
    .required("Date de début requise")
    .max(new Date(), "La date de début ne peut pas être dans le futur"),
  dateEnd: yup
    .date()
    .required("Date de fin requise")
    .min(
      yup.ref("dateBegin"),
      "La date de fin doit être après la date de début"
    )
    .max(new Date(), "La date de fin ne peut pas être dans le futur"),
});

const InterventionModal: React.FC<InterventionModalProps> = ({
  isOpen,
  onClose,
}) => {
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [submitError, setSubmitError] = useState<string | null>(null);

  const {
    register,
    handleSubmit,
    formState: { errors },
    setValue,
    watch,
    reset,
  } = useForm<InterventionFormData>({
    resolver: yupResolver(schema),
    defaultValues: {
      docType: "synthese-inte",
      dateBegin: new Date(Date.now() - 30 * 24 * 60 * 60 * 1000), // 30 days ago
      dateEnd: new Date(),
    },
  });

  const watchedDateBegin = watch("dateBegin");
  const watchedDocType = watch("docType");

  const onSubmit = async (data: InterventionFormData) => {
    setIsSubmitting(true);
    setSubmitError(null);

    try {
      // Format dates for backend
      const dateBeginFormatted = data.dateBegin.toLocaleDateString("fr-FR");
      const dateEndFormatted = data.dateEnd.toLocaleDateString("fr-FR");

      // TODO: Replace with actual backend endpoint when available
      const endpoint = `/api/intervention?doc-type=${data.docType}&date-begin=${dateBeginFormatted}&date-end=${dateEndFormatted}`;

      console.log("Generating intervention report:", {
        docType: data.docType,
        dateBegin: dateBeginFormatted,
        dateEnd: dateEndFormatted,
        endpoint,
      });

      // Simulate API call
      await new Promise((resolve) => setTimeout(resolve, 2000));

      // For now, just show success message
      alert(
        `Rapport ${data.docType} généré avec succès pour la période ${dateBeginFormatted} - ${dateEndFormatted}`
      );

      onClose();
      reset();
    } catch (error) {
      setSubmitError(
        "Erreur lors de la génération du rapport. Veuillez réessayer."
      );
    } finally {
      setIsSubmitting(false);
    }
  };

  const handleClose = () => {
    if (!isSubmitting) {
      onClose();
      reset();
      setSubmitError(null);
    }
  };

  if (!isOpen) return null;

  return (
    <AnimatePresence>
      <motion.div
        className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        transition={{ duration: 0.2 }}
      >
        <motion.div
          className="bg-white rounded-lg p-6 w-full max-w-md mx-4"
          initial={{ scale: 0.8, opacity: 0, y: 20 }}
          animate={{ scale: 1, opacity: 1, y: 0 }}
          exit={{ scale: 0.8, opacity: 0, y: 20 }}
          transition={{ duration: 0.3, ease: "easeOut" }}
        >
          <motion.div
            className="flex justify-between items-center mb-6"
            initial={{ opacity: 0, y: -10 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.1 }}
          >
            <h3 className="text-lg font-semibold text-gray-900">
              Livret d&apos;intervention
            </h3>
            <motion.button
              onClick={handleClose}
              disabled={isSubmitting}
              className="text-gray-400 hover:text-gray-600 disabled:opacity-50"
              whileHover={{ scale: 1.1 }}
              whileTap={{ scale: 0.9 }}
            >
              <i className="fas fa-times text-xl"></i>
            </motion.button>
          </motion.div>

          <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
            {/* Document Type */}
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">
                Type de document
              </label>
              <select
                {...register("docType")}
                className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                <option value="synthese-inte">Synthèse intervention</option>
                <option value="detail-inte">Détail intervention (PDF)</option>
                <option value="detail-excel-inte">
                  Détail intervention (Excel)
                </option>
              </select>
              {errors.docType && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.docType.message}
                </p>
              )}
            </div>

            {/* Date Begin */}
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">
                Date de début
              </label>
              <DatePicker
                selected={watchedDateBegin}
                onChange={(date) => setValue("dateBegin", date || new Date())}
                dateFormat="dd/MM/yyyy"
                className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                maxDate={new Date()}
                showMonthDropdown
                showYearDropdown
                dropdownMode="select"
              />
              {errors.dateBegin && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.dateBegin.message}
                </p>
              )}
            </div>

            {/* Date End */}
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">
                Date de fin
              </label>
              <DatePicker
                selected={watch("dateEnd")}
                onChange={(date) => setValue("dateEnd", date || new Date())}
                dateFormat="dd/MM/yyyy"
                className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                minDate={watchedDateBegin}
                maxDate={new Date()}
                showMonthDropdown
                showYearDropdown
                dropdownMode="select"
              />
              {errors.dateEnd && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.dateEnd.message}
                </p>
              )}
            </div>

            {/* Submit Error */}
            {submitError && (
              <div className="bg-red-50 border border-red-200 rounded-md p-3">
                <p className="text-red-600 text-sm">{submitError}</p>
              </div>
            )}

            {/* Action Buttons */}
            <div className="flex justify-end space-x-3 pt-4">
              <button
                type="button"
                onClick={handleClose}
                disabled={isSubmitting}
                className="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors duration-200 disabled:opacity-50"
              >
                Annuler
              </button>
              <button
                type="submit"
                disabled={isSubmitting}
                className="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200 disabled:opacity-50 flex items-center"
              >
                {isSubmitting ? (
                  <>
                    <i className="fas fa-spinner fa-spin mr-2"></i>
                    Génération...
                  </>
                ) : (
                  <>
                    <i className="fas fa-download mr-2"></i>
                    Générer
                  </>
                )}
              </button>
            </div>
          </form>
        </motion.div>
      </motion.div>
    </AnimatePresence>
  );
};

export default InterventionModal;
