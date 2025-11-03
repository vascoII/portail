vcl 4.1;

backend default {
    .host = "backend";
    .port = "8000";
}

sub vcl_recv {
    if (req.method == "PURGE") {
        return (purge);
    }
}