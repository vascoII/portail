import React from "react";

interface SelectOption {
  value: string;
  label: string;
  disabled?: boolean;
}

interface SelectProps {
  name: string;
  value: string;
  onChange: (e: React.ChangeEvent<HTMLSelectElement>) => void;
  options: SelectOption[];
  placeholder?: string;
  label?: string;
  error?: string;
  disabled?: boolean;
  required?: boolean;
  className?: string;
  selectClassName?: string;
  labelClassName?: string;
  helpText?: string;
  multiple?: boolean;
}

const Select: React.FC<SelectProps> = ({
  name,
  value,
  onChange,
  options,
  placeholder,
  label,
  error,
  disabled = false,
  required = false,
  className = "",
  selectClassName = "",
  labelClassName = "",
  helpText,
  multiple = false,
}) => {
  const selectClasses = `form-control ${
    error ? "is-invalid" : ""
  } ${selectClassName}`.trim();
  const labelClasses = `form-label ${labelClassName}`.trim();

  return (
    <div className={`form-group ${className}`}>
      {label && (
        <label htmlFor={name} className={labelClasses}>
          {label}
          {required && <span className="text-danger ml-1">*</span>}
        </label>
      )}
      <select
        id={name}
        name={name}
        value={value}
        onChange={onChange}
        disabled={disabled}
        required={required}
        multiple={multiple}
        className={selectClasses}
      >
        {placeholder && (
          <option value="" disabled>
            {placeholder}
          </option>
        )}
        {options.map((option) => (
          <option
            key={option.value}
            value={option.value}
            disabled={option.disabled}
          >
            {option.label}
          </option>
        ))}
      </select>
      {helpText && !error && (
        <small className="form-text text-muted">{helpText}</small>
      )}
      {error && <div className="invalid-feedback">{error}</div>}
    </div>
  );
};

export default Select;
