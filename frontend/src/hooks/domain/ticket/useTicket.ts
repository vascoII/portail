"use client";

import { useCachedQuery } from "../shared/useCachedQuery";
import { listTicketsApiService } from "@/services/api/Ticket/ListTicketsApiService";
import type { PaginatedResponse } from "@/types/api";
import type { GetTicketsIntersUserRequestDto } from "@/types/api/request/Ticket/GetTicketsIntersUserRequestDto";

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

