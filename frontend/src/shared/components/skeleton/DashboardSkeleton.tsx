const DashboardSkeleton = () => {
  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      {/* Title skeleton */}
      <h2 className="text-2xl font-bold text-dashboard-textPrimary mb-8">
        Aperçu de votre parc
      </h2>

      {/* Bandeau skeleton - Full width */}
      <div className="w-full flex justify-center mb-6">
        <div
          className="flex flex-wrap items-center justify-center gap-4 max-w-7xl mx-auto px-4 rounded-lg py-4 bg-white overflow-hidden relative"
          style={{
            borderColor: "#606060",
            borderStyle: "solid",
            borderWidth: "1px",
            borderRadius: "10px",
            padding: "1%",
            width: "100%",
          }}
        >
          <div className="absolute inset-0 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-50 animate-shimmer bg-[length:200%_100%]" />
          <div className="absolute inset-0 flex items-center justify-center gap-4 z-10">
            {[1, 2, 3, 4].map((i) => (
              <div
                key={i}
                className="flex items-center gap-3 px-4 py-2 rounded-lg border-2 bg-gray-100"
                style={{ borderColor: "#e5e7eb" }}
              >
                <div className="w-5 h-5 rounded bg-gray-300 animate-pulse" />
                <div className="flex flex-col gap-1">
                  <div className="h-3 w-20 bg-gray-300 rounded animate-pulse" />
                  <div className="h-4 w-8 bg-gray-300 rounded animate-pulse" />
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Main Dashboard Grid */}
      <div className="flex flex-col gap-4">
        {/* Ligne 1: Main (2/3) + DepanageGauge (1/3) */}
        <div className="flex flex-col md:flex-row gap-4 w-full">
          {/* Main skeleton - 2/3 width */}
          <div
            className="w-full md:w-2/3 bg-white rounded-lg overflow-hidden relative"
            style={{
              borderColor: "#606060",
              borderStyle: "solid",
              borderWidth: "1px",
              borderRadius: "10px",
              minHeight: "300px",
            }}
          >
            <div className="absolute inset-0 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-50 animate-shimmer bg-[length:200%_100%]" />
            <div className="absolute inset-0 p-4 z-10 flex flex-col gap-4">
              <div className="h-12 w-3/4 bg-gray-300 rounded-lg animate-pulse" />
              <div className="h-8 w-1/2 bg-gray-300 rounded-lg animate-pulse" />
              <div className="grid grid-cols-2 gap-4 mt-4">
                {[1, 2, 3, 4].map((i) => (
                  <div key={i} className="text-center">
                    <div className="h-8 w-16 bg-gray-300 rounded mx-auto mb-2 animate-pulse" />
                    <div className="h-4 w-20 bg-gray-300 rounded mx-auto animate-pulse" />
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* DepanageGauge skeleton - 1/3 width */}
          <div
            className="w-full md:w-1/3 bg-white rounded-lg p-6 overflow-hidden relative"
            style={{
              borderColor: "#606060",
              borderStyle: "solid",
              borderWidth: "1px",
              borderRadius: "10px",
            }}
          >
            <div className="absolute inset-0 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-50 animate-shimmer bg-[length:200%_100%]" />
            <div className="absolute inset-0 flex flex-col items-center justify-center p-6 z-10">
              <div className="h-4 w-32 bg-gray-300 rounded mb-4 animate-pulse" />
              <div className="w-32 h-32 rounded-full bg-gray-300 mb-4 animate-pulse" />
              <div className="h-8 w-16 bg-gray-300 rounded animate-pulse" />
            </div>
          </div>
        </div>

        {/* Ligne 2: Alerte (2/3) + AlarmeGauge (1/3) */}
        <div className="flex flex-col md:flex-row gap-4 w-full">
          {/* Alerte skeleton - 2/3 width */}
          <div
            className="w-full md:w-2/3 bg-white rounded-lg p-4 overflow-hidden relative"
            style={{
              borderColor: "#606060",
              borderStyle: "solid",
              borderWidth: "1px",
              borderRadius: "10px",
            }}
          >
            <div className="absolute inset-0 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-50 animate-shimmer bg-[length:200%_100%]" />
            <div className="absolute inset-0 p-4 z-10 flex flex-col gap-4">
              <div className="h-6 w-40 bg-gray-300 rounded animate-pulse" />
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                {[1, 2].map((i) => (
                  <div
                    key={i}
                    className="flex items-center justify-between p-6 bg-gray-100 rounded-xl"
                  >
                    <div className="flex items-center gap-4">
                      <div className="w-12 h-12 rounded-full bg-gray-300 animate-pulse" />
                      <div className="h-4 w-32 bg-gray-300 rounded animate-pulse" />
                    </div>
                    <div className="w-16 h-16 rounded-full bg-gray-300 animate-pulse" />
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* AlarmeGauge skeleton - 1/3 width */}
          <div
            className="w-full md:w-1/3 bg-white rounded-lg p-6 overflow-hidden relative"
            style={{
              borderColor: "#606060",
              borderStyle: "solid",
              borderWidth: "1px",
              borderRadius: "10px",
            }}
          >
            <div className="absolute inset-0 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-50 animate-shimmer bg-[length:200%_100%]" />
            <div className="absolute inset-0 flex flex-col items-center justify-center p-6 z-10">
              <div className="h-4 w-32 bg-gray-300 rounded mb-4 animate-pulse" />
              <div className="w-32 h-32 rounded-full bg-gray-300 mb-4 animate-pulse" />
              <div className="h-8 w-16 bg-gray-300 rounded animate-pulse" />
            </div>
          </div>
        </div>

        {/* Ligne 3: Chantier (1/3) + Releve (2/3) */}
        <div className="flex flex-col md:flex-row gap-4 w-full">
          {/* Chantier skeleton - 1/3 width */}
          <div
            className="w-full md:w-1/3 bg-white rounded-lg overflow-hidden relative"
            style={{
              backgroundImage: "url('/images/chantier.png')",
              backgroundSize: "cover",
              backgroundPosition: "center",
              backgroundRepeat: "no-repeat",
              borderColor: "#606060",
              borderStyle: "solid",
              borderWidth: "1px",
              borderRadius: "4px",
            }}
          >
            <div className="absolute inset-0 bg-gray-900/20 animate-pulse" />
          </div>

          {/* Releve skeleton - 2/3 width */}
          <div
            className="w-full md:w-2/3 bg-white rounded-lg p-4 overflow-hidden relative"
            style={{
              borderColor: "#606060",
              borderStyle: "solid",
              borderWidth: "1px",
              borderRadius: "10px",
              textAlign: "center",
              justifyContent: "center",
              alignItems: "center",
              display: "flex",
              flexDirection: "column",
              minHeight: "200px",
            }}
          >
            <div className="absolute inset-0 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-50 animate-shimmer bg-[length:200%_100%]" />
            <div className="absolute inset-0 flex flex-col items-center justify-center p-4 z-10">
              <div className="h-6 w-32 bg-gray-300 rounded mb-4 animate-pulse" />
              <div className="w-40 h-40 rounded-full bg-gray-300 mb-4 animate-pulse" />
              <div className="h-6 w-48 bg-gray-300 rounded animate-pulse" />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default DashboardSkeleton;
