# README

Ansible role to provision victim machines (Debian 12, Win11, Win-Server) for the Ela CTF.

## Requirements

None.

## Dependencies

Active Elastic Server

## Example Ludus Range Config
Deploys the vulnerable machine:
```yaml
ludus:
  # SIEM SERVER
  - vm_name: "{{ range_id }}-ela"
    hostname: "{{ range_id }}-ela"
    template: ubuntu-22.04-x64-server-template
    vlan: 20
    ip_last_octet: 11
    ram_gb: 16
    cpus: 4
    linux: true
    testing:
      snapshot: true
      block_internet: true
    roles:
      - name: badsectorlabs.ludus_elastic_container
    role_vars:
      ludus_elastic_password: "S3cur3P@ss?"

  # LINUX SERVER
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
      - name: ela-beats
        depends_on:
          - vm_name: "{{ range_id }}-ela"
            role: badsectorlabs.ludus_elastic_container
```

## License

GPLv3

## Author Information

xslizik