"use client";

import { useCachedQuery } from "@/src/shared/hooks/useCachedQuery";
import { listTicketsApiService } from "@/src/features/ticket/services/ListTicketsApiService";
import type { PaginatedResponse } from "@/src/shared/types/api";
import type { GetTicketsIntersUserRequestDto } from "@/src/features/ticket/types/request/GetTicketsIntersUserRequestDto";

export interface UseTicketReturn {
  // Tickets list data
  tickets: PaginatedResponse<any> | null;
  ticketsLoading: boolean;
  ticketsError: string | null;
  refetchTickets: (force?: boolean) => Promise<void>;

  // Combined states
  loading: boolean;
  error: string | null;
}

export interface UseTicketOptions {
  enabled?: boolean;
  filters?: GetTicketsIntersUserRequestDto;
  cacheKey?: string;
}

/**
 * Hook pour récupérer la liste des tickets
 * Utilise le cache pour éviter les requêtes inutiles
 * @param options Options de configuration du hook
 */
export function useTicket(options?: UseTicketOptions): UseTicketReturn {
  const {
    enabled = true,
    filters,
    cacheKey = "tickets-list",
  } = options || {};

  // Default filters if not provided
  const requestDto: GetTicketsIntersUserRequestDto = filters || {
    paramsFiltres: "",
  };

  const {
    data: tickets,
    loading: ticketsLoading,
    error: ticketsError,
    refetch: refetchTickets,
  } = useCachedQuery<PaginatedResponse<any>>(
    () => listTicketsApiService.listTickets(requestDto),
    {
      cacheKey: `${cacheKey}-${requestDto.paramsFiltres}`,
      enabled,
    }
  );

  return {
    tickets,
    ticketsLoading,
    ticketsError,
    refetchTickets,
    loading: ticketsLoading,
    error: ticketsError,
  };
}

