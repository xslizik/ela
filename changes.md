1. set uac to default
2. restart pc
3. disable firewall
```
netsh advfirewall set allprofiles state off
```
4. disable antivirus - disable all antivirus in settings and then
```
wget https://github.com/pgkt04/defender-control/releases/download/v1.5/disable-defender.exe -o uwu.exe; .\uwu.exe;
```
5. run edge (for Credentialkatz scenario)
6. install Packetbeat
```
cd C:\Users\localuser\Desktop; .\install_packetbeat.ps1
```
7. move Secret Goulash Recipe to "C:\Users\domainuser\Documents"
8. Add "ludus\domainadmin" to Local Security Policy > Security Settings > Local Policies > User Rights Assignment > "Log on as a service"
9. install unquoted.ps1 on domainmember