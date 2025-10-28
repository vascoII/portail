// Configuration for the application
export const config = {
  // API Configuration
  apiUrl: process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000",

  // Environment
  isDevelopment: process.env.NODE_ENV === "development",
  isProduction: process.env.NODE_ENV === "production",

  // Feature flags
  features: {
    demoMode: process.env.NODE_ENV === "development",
    mockData: process.env.NEXT_PUBLIC_USE_MOCK_DATA === "true",
  },
};

export default config;
