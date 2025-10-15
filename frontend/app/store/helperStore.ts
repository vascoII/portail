// Helper function to get end of day timestamp (23:59:59)
export const getEndOfCurrentDayTimestamp = (): number => {
  const now = new Date();
  const endOfDay = new Date(
    now.getFullYear(),
    now.getMonth(),
    now.getDate(),
    23,
    59,
    59,
    999
  );
  return endOfDay.getTime();
};

export const getEndOfCurrentWeekTimestamp = (): number => {
  const now = new Date();
  const dayOfWeek = now.getDay(); // 0 (dimanche) à 6 (samedi)
  const daysUntilEndOfWeek = 7 - dayOfWeek; // dimanche = fin de semaine
  const endOfWeek = new Date(
    now.getFullYear(),
    now.getMonth(),
    now.getDate() + daysUntilEndOfWeek,
    23,
    59,
    59,
    999
  );
  return endOfWeek.getTime();
};

export const getEndOfCurrentMonthTimestamp = (): number => {
  const now = new Date();
  const endOfMonth = new Date(
    now.getFullYear(),
    now.getMonth() + 1, // mois suivant
    0, // jour 0 du mois suivant = dernier jour du mois courant
    23,
    59,
    59,
    999
  );
  return endOfMonth.getTime();
};

export const getBeginningOfNextDayTimestamp = (): number => {
  const now = new Date();
  const nextDay = new Date(
    now.getFullYear(),
    now.getMonth(),
    now.getDate() + 1,
    0, 0, 0, 0
  );
  return nextDay.getTime();
};

export const getBeginningOfNextWeekTimestamp = (): number => {
  const now = new Date();
  const dayOfWeek = now.getDay();
  const daysUntilNextWeek = 7 - dayOfWeek;
  const nextWeekStart = new Date(
    now.getFullYear(),
    now.getMonth(),
    now.getDate() + daysUntilNextWeek,
    0, 0, 0, 0
  );
  return nextWeekStart.getTime();
};

export const getBeginningOfNextMonthTimestamp = (): number => {
  const now = new Date();
  const nextMonthStart = new Date(
    now.getFullYear(),
    now.getMonth() + 1,
    1,
    0, 0, 0, 0
  );
  return nextMonthStart.getTime();
};