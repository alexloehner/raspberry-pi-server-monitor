#!/bin/bash

NUM_OF_CPU_CORES=12

apps1="nginx php5-fpm dovecot memcached SCREEN mono"
apps2="master clamd smtpd icinga2 "

#################################################################

distri=$( lsb_release -d | cut -d ":" -f 2 | xargs )
kernel=$( uname -r )
mytop=$( mytop -b --nocolor --resolve )
myadmin=$( mysqladmin status )
top=$( top -b -n 1 | head -n 5 )
topapps=$( top -b -n 1 | grep -A 3 "PID USER" )
uptime=$( uptime -p )
mem=$( free -m | grep "Mem:" | xargs )
swap=$( free -m | grep "Swap:" | xargs )
iotop=$( iotop -b -n 1 | grep "Actual DISK READ" | head -n 1 )
cpus=($( mpstat -P ALL 1 1 | awk '/Average:/ && $2 ~ /[0-9]/ {printf "%d\n",$3}' ))
net=$( tail -n 1 /tmp/netstat.log | xargs )
sensors=$( sensors )
updates=$( cat /var/lib/update-notifier/updates-available | xargs | cut -d " " -f 1 )
if [[ "$updates" = "" ]]; then
        updates=0
fi
out=""

################################################################

num_sleeps=$( echo "$mytop" | grep Sleep | wc -l )
queries=$( echo "$myadmin" | xargs | cut -d " " -f 6 )
qps=$( echo "$myadmin" | xargs | cut -d " " -f 22 )
slowqueries=$( echo "$myadmin" | xargs | cut -d " " -f 9 )
lavg1=$( cat /proc/loadavg | xargs | cut -d " " -f 1 )
lavg5=$( cat /proc/loadavg | xargs | cut -d " " -f 2 )
lavg15=$( cat /proc/loadavg | xargs | cut -d " " -f 3 )
procs=$( echo "$top" | grep "Tasks:" | xargs | cut -d " " -f 2 )
procs_running=$( echo "$top" | head -n 5 | grep "Tasks:" | xargs | cut -d "," -f 2 | xargs | cut -d " " -f 1 )
procs_sleeping=$( echo "$top" | head -n 5 | grep "Tasks:" | xargs | cut -d "," -f 3 | xargs | cut -d " " -f 1 )
procs_zombi=$( echo "$top" | head -n 5 | grep "Tasks:" | xargs | cut -d "," -f 5 | xargs | cut -d " " -f 1 )
rx=$( echo "$net" | cut -d " " -f 1 )
tx=$( echo "$net" | cut -d " " -f 2 )
mem_total=$( echo "$mem" | cut -d " " -f 2 )
mem_used=$( echo "$mem" | cut -d " " -f 3 )
swap_total=$( echo "$swap" | cut -d " " -f 2 )
swap_used=$( echo "$swap" | cut -d " " -f 3 )
disk_read=$( echo "$iotop" | cut -d "|" -f 1 | xargs | cut -d ":" -f 2 | xargs )
disk_write=$( echo "$iotop" | cut -d "|" -f 2 | xargs | cut -d ":" -f 2 | xargs )

systin=$( echo "${sensors}" | grep "SYSTIN" | xargs | cut -d " " -f 2 )
cputin=$( echo "${sensors}" | grep "CPUTIN" | xargs | cut -d " " -f 2 )
auxtin=$( echo "${sensors}" | grep "AUXTIN" | xargs | cut -d " " -f 2 )



appsr1=""
for i in $apps1; do
        pids=$( pidof ${i} | wc -w )
        if [[ "${appsr1}" != "" ]]; then
                appsr1="${appsr1} "
        fi
        appsr1="${appsr1}${i}:${pids}"
done
appsr2=""
for i in $apps2; do
        pids=$( pidof ${i} | wc -w )
        if [[ "${appsr2}" != "" ]]; then
                appsr2="${appsr2} "
        fi
        appsr2="${appsr2}${i}:${pids}"
done

usage=""
c=0
while true; do
        if [[ ${c} -eq ${NUM_OF_CPU_CORES} ]]; then
                break;
        fi
        if [[ "${usage}" != "" ]]; then
                usage="${usage};"
        fi
        usage="${usage}${cpus[$c]}%"
        c=$(( $c + 1 ))
done

date=$( date +"%d.%m.%Y" )
time=$( date +"%H:%M:%S" )
out="${out}                   ~ ~ ~ LiCo - The Linux Counter Project - Server Monitor ~ ~ ~\n"
out="${out}====================================================================================================\n"
out="${out} Today:\t\t${date}\t${time}\n"
out="${out}----------------------------------------------------------------------------------------------------\n"
out="${out} Info:\t\t${distri}\t\t${kernel}\n"
out="${out} \t\t${uptime}\t\tApt Updates: ${updates}\n"
out="${out}----------------------------------------------------------------------------------------------------\n"
out="${out} Perf.:\t\tLoad avg: $lavg1 $lavg5 $lavg15\tProcesses: ${procs} (${procs_running}/${procs_sleeping}/${procs_zombi})\n"
out="${out}----------------------------------------------------------------------------------------------------\n"
out="${out} Mem:\t\tRam total: $mem_total MB\tRam used: $mem_used MB\n"
out="${out} \t\tSwap total: $swap_total MB\tSwap used:  $swap_used MB\n"
out="${out}----------------------------------------------------------------------------------------------------\n"
out="${out} HDD:\t\tCurrent read: $disk_read\tCurrent write: $disk_write\n"
out="${out}----------------------------------------------------------------------------------------------------\n"
out="${out} CPU:\t\t${usage}\n"
out="${out}----------------------------------------------------------------------------------------------------\n"
out="${out} MySQL:\t\tSleeps: $num_sleeps\tQueries: $queries\tqps: $qps\tSlowQueries: $slowqueries\n"
out="${out}----------------------------------------------------------------------------------------------------\n"
out="${out} Net:\t\tIncoming: ${rx} kbps\tOutgoing: ${tx} kbps\n"
out="${out}----------------------------------------------------------------------------------------------------\n"
out="${out} Status:\t${appsr}\n"
out="${out}----------------------------------------------------------------------------------------------------\n"
out="${out}${topapps}\n"
out="${out}===================================================================================================="
outlast="                                             (c) 2015 by Alexander Löhner, The Linux Counter Project"

array="${distri};${kernel};${uptime};${updates};$lavg1;$lavg5;$lavg15;${procs};${procs_running};${procs_sleeping};${procs_zombi};$mem_total;$mem_used;$swap_total;$swap_used;$disk_read;$disk_write;${NUM_OF_CPU_CORES};${usage};$num_sleeps;$queries;$qps;$slowqueries;${rx};${tx};${appsr1};${appsr2};${systin};${cputin};${auxtin}"


echo -n "$array"
exit 0
