# Podman-Apache-PHP-MariaDB-Stack (PAPM Stack)

PAPM stack setup with podman-compose.
Execute it by running:
```
podman-compose up
```
Requires root privileges to access port 80.
Alternatively, you can use port forwarding or a reverse proxy by configuring a different port in the `compose.yml' file.

## As a service

Did you know that you can set up podman-compose projects as a systemd service?
```
# podman-compose --help
...
systemd   create systemd unit file and register its compose stacks
            
              When first installed type `sudo podman-compose systemd -a create-unit`
              later you can add a compose stack by running `podman-compose systemd -a register`
              then you can start/stop your stack with `systemctl --user start podman-compose@<PROJ>`
...
```

## Dev

Includes a development environment for VS-Code with phpMyAdmin.
Just 'run in container' with VS-Code with the Devcontainer extention.
Web can be accessed via port 8080, phpMyAdmin via URL path `/pma`.
