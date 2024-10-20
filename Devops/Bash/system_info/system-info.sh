#!/bin/bash

# Script: system-info.sh
# Description: Display various system information
# Author: Michael Aroworade

# Function to print system information
function print_system_info {
	echo "System Information"
	uname -a
	echo
}

# Function to display system uptime
function show_uptime {
	echo "System Uptime:"
	uptime
	echo
}

# Function to display disk usage
function show_disk_usage {
	echo "Disk Usage:"
	df -h --total | grep -E '^Filesystem|total'
	echo
}

# Function to display memory usage
function show_memory_usage {
	echo "Memory Usage:"
	free -h
	echo
}

# Function to display logged-in users
function show_logged_in_users {
	echo "Logged-in Users"
	who
	echo
}

# Function to display CPU load
function show_cpu_load {
	echo "CPU Load:"
	uptime | awk -F'[a-z]:' '{ print $2 }'
	echo
}

#Function to display network information
function show_network_info {
	echo "Network Information:"
	echo "Hostname: $(hostname)"
	echo "IP Address:"
	ip -4 addr show | grep inet | awk '{print $2}' | cut -d/ -f1
	echo
}

# Main Script Execution
echo "=== SYSTEM INFORMATION ==="
print_system_info
show_uptime
show_disk_usage
show_memory_usage
show_logged_in_users
show_cpu_load
show_network_info
echo "=========================="
