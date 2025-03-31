#!/bin/bash

user="KWAZ"
ludus range abort --user $user
ludus range rm --user $user

#ludus power off -n all --user KWAZ
#scp -r ludus:/home/slizik/ela .