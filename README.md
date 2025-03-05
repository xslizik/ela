# Ela

## Setup Ludus
Follow how to install ludus, add roles, and deploy ranges
https://docs.ludus.cloud/docs/quick-start/install-ludus

### Required Roles
- ela-apache
- ela-beats
- badsectorlabs.ludus_elastic_agent
- badsectorlabs.ludus_elastic_container

## Login to Elastic (second octet is your range_id)
https://10.5.20.11:5601/

```
elastic
S3cur3P@ss?
```

## Topology
<img src="./topology-tests/topology.png" alt="Topology" style="display: block; margin: 0 auto;" />

### Inspiration
- https://www.elastic.co/docs
- https://docs.metasploit.com/
- https://www.exploit-db.com/exploits/50406
- https://www.thehacker.recipes/infra/privilege-escalation/unix/living-off-the-land#case-study-1-privesc-using-tar-and-a-cronjob
- https://pentestlab.blog/2019/10/01/persistence-registry-run-keys/
- https://github.com/gentilkiwi/mimikatz/
- https://learn.microsoft.com/en-us/sysinternals/downloads/psexec
- https://github.com/badsectorlabs/ludus_elastic_container
- https://github.com/badsectorlabs/ludus_elastic_agent