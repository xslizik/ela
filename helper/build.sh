#!/bin/bash

user="KWAZ"
template="./topology-tests/3_win_test.yml"

role_location="./roles/"
roles=(
    "ela-apache"
    "ela-beats"
    "ela-attacker"
)
hosts=(
    "localhost"
    "$user-kali"
    "$user-ela"
    "$user-apache"
    #"$user-win11"
)

echo -ne "| ludus range status --user "$user"\n\n"

for role in "${roles[@]}"; do
    ludus ansible role add -d "$role_location""$role" -f --user "$user"
done

if [ "$1" == "-t" ]; then
    # don't forget to snapshot it without roles beforehand
    ludus range deploy -t user-defined-roles --limit "$(IFS=,; echo "${hosts[*]}")" --only-roles "$(IFS=,; echo "${roles[*]}")" --user "$user" && ludus range logs -f --user "$user"
else
    ludus range config set -f $template --user $user
    ludus range deploy --user $user
fi

ludus range logs -f --user $user

# if new user do this before the script starts
# ludus range wireguard get --user $user > $user.conf
# ludus ansible roles add badsectorlabs.ludus_elastic_container --user "$user"
# ludus ansible roles add badsectorlabs.ludus_elastic_agent --user "$user"

#ludus range abort --user KWAZ
#ludus ansible role add -d "./roles/ela-beats" -f --user "KWAZ" && ludus range deploy -t user-defined-roles --limit "localhost, KWAZ-win11" --only-roles "ela-beats" --user "KWAZ" && ludus range logs -f --user "KWAZ"