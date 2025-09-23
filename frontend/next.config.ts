import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  webpackDevMiddleware: (config: any) => {
    // @ts-ignore
    config.watchOptions = {
      poll: 1000,
      aggregateTimeout: 300,
    };
    return config;
  },
};

export default nextConfig;
