# Ela

## Setup Ludus
Follow how to install ludus, add roles, and deploy ranges
https://docs.ludus.cloud/docs/quick-start/install-ludus

### Required Roles
- ela-attacker
- ela-apache
- ela-beats
- badsectorlabs.ludus_elastic_container

## Login to Elastic (second octet is your range_id)
https://10.5.20.11:5601/login?next=%2Fapp%2Fhome

```
elastic
S3cur3P@ss?
```

## Login to Attacker 
https://10.5.30.50:8444/

```
# vnc creds
kali
kaliuser
# user creds
kali
kali
```

### Win11 packetbeat has to be installed manually

```
# open powershell as administrator 
cd Desktop
.\install_packetbeat.ps1
```

## Topology
<img src="./topology-tests/topology.png" alt="Topology" style="display: block; margin: 0 auto;" />

### Inspiration
- https://github.com/badsectorlabs/ludus_elastic_container
- https://github.com/SwiftOnSecurity/sysmon-config
- https://github.com/olafhartong/sysmon-modular
- https://www.elastic.co/docs
- https://docs.metasploit.com/
- https://www.exploit-db.com/exploits/50406
- https://www.thehacker.recipes/infra/privilege-escalation/unix/living-off-the-land#case-study-1-privesc-using-tar-and-a-cronjob
- https://pentestlab.blog/2019/10/01/persistence-registry-run-keys/
- https://github.com/gentilkiwi/mimikatz/
- https://learn.microsoft.com/en-us/sysinternals/downloads/psexec
