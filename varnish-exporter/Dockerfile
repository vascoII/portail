FROM debian:bullseye-slim

RUN apt-get update && apt-get install -y curl varnish

# Téléchargement du binaire
RUN curl -L https://github.com/jonnenauha/prometheus_varnish_exporter/releases/latest/download/prometheus_varnish_exporter-linux-amd64 \
    -o /usr/local/bin/varnish_exporter && chmod +x /usr/local/bin/varnish_exporter

EXPOSE 9131

CMD ["/usr/local/bin/varnish_exporter", "--listen-address=:9131"]