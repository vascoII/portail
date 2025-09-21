import React from "react";

interface InputProps {
  type?: "text" | "email" | "password" | "number" | "tel" | "url" | "search";
  name: string;
  value: string;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
  placeholder?: string;
  label?: string;
  error?: string;
  disabled?: boolean;
  required?: boolean;
  className?: string;
  inputClassName?: string;
  labelClassName?: string;
  helpText?: string;
}

const Input: React.FC<InputProps> = ({
  type = "text",
  name,
  value,
  onChange,
  placeholder,
  label,
  error,
  disabled = false,
  required = false,
  className = "",
  inputClassName = "",
  labelClassName = "",
  helpText,
}) => {
  const inputClasses = `form-control ${
    error ? "is-invalid" : ""
  } ${inputClassName}`.trim();
  const labelClasses = `form-label ${labelClassName}`.trim();

  return (
    <div className={`form-group ${className}`}>
      {label && (
        <label htmlFor={name} className={labelClasses}>
          {label}
          {required && <span className="text-danger ml-1">*</span>}
        </label>
      )}
      <input
        type={type}
        id={name}
        name={name}
        value={value}
        onChange={onChange}
        placeholder={placeholder}
        disabled={disabled}
        required={required}
        className={inputClasses}
      />
      {helpText && !error && (
        <small className="form-text text-muted">{helpText}</small>
      )}
      {error && <div className="invalid-feedback">{error}</div>}
    </div>
  );
};

export default Input;
