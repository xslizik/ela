## Changes
1. set uac to default
2. restart pc
3. disable firewall
```
netsh advfirewall set allprofiles state off
```
4. disable antivirus - disable all antivirus in settings and then (in newest ludus it is done through topology.yml)
```
wget https://github.com/pgkt04/defender-control/releases/download/v1.5/disable-defender.exe -o uwu.exe; .\uwu.exe;
```
5. run edge (for Credentialkatz scenario) and Teams
6. install Packetbeat
```
cd C:\Users\localuser\Desktop; .\install_packetbeat.ps1
```
7. move Secret Goulash Recipe to "C:\Users\domainuser\Documents"
8. Add "ludus\domainadmin" to Local Security Policy > Security Settings > Local Policies > User Rights Assignment > "Log on as a service"
9. install unquoted.ps1 on domainmember
10. install druva on domainmember

## Interesting Dashboards

### Alerts Dashboard

### Linux Dashboards
- `"[Filebeat Apache] Access and error logs ECS"`
- `"[Auditbeat System] System Overview ECS"`
- `"[Auditbeat Auditd] Overview ECS"`
- `"[Auditbeat Auditd] Executions ECS"`
- `"[Filebeat MySQL] Overview ECS"`

### Linux Queries
- `"Apache access logs [Filebeat Apache] ECS"`
- `"Apache errors log [Filebeat Apache] ECS"`
- `"Login Events [Auditbeat System] ECS"`
- `"Package Documents [Auditbeat System] ECS"`
- `"Process Events [Auditbeat System] ECS"`
- `"Process Executions [Auditbeat Auditd] ECS"`


### Win Dashboards
- `"[Winlogbeat] Overview"`
- `"[Winlogbeat powershell] Overview"`
- `"[Packetbeat] Overview ECS"`

### Other
- `"Details [Winlogbeat powershell]"`
- `"DNS Protocol [Packetbeat] ECS"`
- `"Flow Records [Filebeat Netflow]"`
- `"Flows Search [Packetbeat] ECS"`
- `"HTTP Transactions Search [Packetbeat] ECS"`
- `"Packetbeat Search ECS"`