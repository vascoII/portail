const ImmeubleListSkeleton = () => {
  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-pulse">
        <h2 className="text-2xl font-bold text-dashboard-textPrimary mb-8">
          Aperçu des immeubles
        </h2>

        <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: '16px', width: '100%', maxWidth: '800px', margin: '0 auto' }}>
    
            <div style={{ width: '100%', height: '100px', border: '1px solid black', backgroundColor: '#ccc' }}></div>
            <div style={{ width: '100%', height: '100px', border: '1px solid black', backgroundColor: '#ccc' }}></div>
            <div style={{ width: '100%', height: '100px', border: '1px solid black', backgroundColor: '#ccc' }}></div>
            <div style={{ width: '100%', height: '100px', border: '1px solid black', backgroundColor: '#ccc' }}></div>
            <div style={{ width: '100%', height: '100px', border: '1px solid black', backgroundColor: '#ccc' }}></div>
        </div>
    </div>
  );
};

export default ImmeubleListSkeleton;