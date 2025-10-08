
const eventSource = new EventSource('http://localhost:3001/.well-known/mercure?topic=https://example.com/my-topic');

eventSource.onmessage = event => {
  const data = JSON.parse(event.data);
  console.log('Received update:', data);
};
