# README

Ansible role to provision the victim machine (Debian 12 only) for the Ela CTF.

## Requirements

None.

## Role Variables

Available variables are listed below, along with default values (see `defaults/main.yml`):
```yml
---
php_user: "www-data"
php_group: "www-data"
php_listen: "127.0.0.1:9000"
mysql_root_password: "password123"
db_name: "webapp"
db_user: "webuser"
db_password: "password123"
server_port: "80"
majestic_admin_email: "admin@majestic.local"
majestic_admin_password: "I2VkgtoXtj86gqLymcQvgyNJCa4g5pSU0drbXPHTcapbgJRQrt"
```

## Dependencies

None.

## Example Ludus Range Config
Deploys the vulnerable machine:
```yaml
ludus:
  - vm_name: "{{ range_id }}-apache"
    hostname: "{{ range_id }}-apache"
    template: debian-12-x64-server-template
    vlan: 20
    ip_last_octet: 12
    ram_gb: 4
    cpus: 2
    linux: true
    testing:
      snapshot: true
      block_internet: true
    roles:
      - name: ela-apache
```

## License

GPLv3

## Author Information

xslizik