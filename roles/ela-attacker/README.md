# README

Ansible role to provision the victim machine (Kali only) for the Ela CTF.

## Requirements

None.

## Role Variables

Available variables are listed below, along with default values (see `defaults/main.yml`):
```yml
---

```

## Dependencies

None.

## Example Ludus Range Config
Deploys the vulnerable machine:
```yaml
ludus:
  - vm_name: "{{ range_id }}-kali"
    hostname: "kali"
    template: kali-x64-desktop-template
    vlan: 10
    ip_last_octet: 50
    ram_gb: 4
    cpus: 2
    linux: true
    testing:
      snapshot: true
      block_internet: true
    roles:
      - name: ela-attacker
```

## License

GPLv3

## Author Information

xslizik