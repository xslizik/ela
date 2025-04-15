# README

Ansible role to provision the victim machine (Win 11) for the Ela CTF.

## Requirements

None.

## Dependencies

None.

## Example Ludus Range Config
Deploys the vulnerable machine:
```yaml
ludus:
  # WIN DC
  - vm_name: "{{ range_id }}-win-server"
    hostname: "{{ range_id }}-win-server"
    template: win2022-server-x64-template
    vlan: 20
    ip_last_octet: 13
    ram_gb: 16
    cpus: 4
    windows:
      sysprep: true
      install_additional_tools: false
    domain:
      fqdn: ludus.domain
      role: primary-dc
    testing:
      snapshot: true
      block_internet: true
    roles:
      - name: ela-win

  # WIN
  - vm_name: "{{ range_id }}-win11"
    hostname: "{{ range_id }}-win11"
    template: win11-22h2-x64-enterprise-template
    vlan: 20
    ip_last_octet: 14
    ram_gb: 16
    cpus: 4
    windows:
      sysprep: true
      install_additional_tools: false
    domain:
      fqdn: ludus.domain
      role: member
    testing:
      snapshot: true
      block_internet: true
    roles:
      - name: ela-win
```

## License

GPLv3

## Author Information

xslizik