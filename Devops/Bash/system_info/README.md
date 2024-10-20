# System Information Script
The goal is to write a Bash scrippt that gathersand displays essential system information.
You can run this script anytime to get an overview of your system current state.

## Script Overview
- Display system uptime
- Show Disk Usage for all mounted filesystems
- Show Memory Usage
- Display CPU load over the last 1, 5, and 15 minutes.
- List the users currently Logged-in
- Show network information (IP addresses, hostname)

## Skill
- uptime
- df
- free
- top
- who
- ifconfig/ip and ip -4 addr show

## Usage
```
$ sudo touch /var/log/system-info.log
$ sudo chmod 777 /var/log/system-info.log
$ chmod +x enhanced-system-info.sh
$ ./enhanced-system-info.sh
```
