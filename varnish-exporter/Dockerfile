FROM debian:bullseye-slim

RUN apt-get update && apt-get install -y \
    varnish \
    ca-certificates
# Copie du binaire déjà téléchargé
COPY prometheus_varnish_exporter /usr/local/bin/varnish_exporter

RUN chmod +x /usr/local/bin/varnish_exporter

EXPOSE 9131

CMD ["/usr/local/bin/varnish_exporter", "-web.listen-address=:9131"]