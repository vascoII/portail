export interface ApiResponse<T> {
  data: T;
  message?: string;
  success: boolean;
}

export interface PaginatedResponse<T> {
  data: T[];
  pagination: {
    page: number;
    limit: number;
    total: number;
    totalPages: number;
  };
}

export interface SearchResult {
  id: string;
  type: "immeuble" | "occupant" | "logement";
  title: string;
  subtitle: string;
  description?: string;
  url: string;
}

export interface SearchFilters {
  type: "immeuble" | "occupant" | "all";
  ref_numero?: string;
  nom?: string;
  adresse?: string;
  tout?: string;
  ref?: string;
}

export interface BreadcrumbItem {
  label: string;
  href?: string;
}

export interface SelectOption {
  value: string;
  label: string;
  disabled?: boolean;
}

export interface TableColumn {
  key: string;
  label: string;
  sortable?: boolean;
  render?: (value: any, item: any) => React.ReactNode;
}

export interface FilterOption {
  key: string;
  label: string;
  type: "select" | "input" | "date" | "checkbox";
  options?: SelectOption[];
  placeholder?: string;
}

export interface LoadingState {
  loading: boolean;
  error: string | null;
}

export interface PaginationState {
  page: number;
  limit: number;
  total: number;
  totalPages: number;
}

export type SortDirection = "asc" | "desc";

export interface SortState {
  field: string;
  direction: SortDirection;
}
