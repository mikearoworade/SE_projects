#!/bin/bash

# Script: enhanced-system-info.log
# Description: Display detailed system information with logging
# Author: Michael Aroworade

LOG_FILE="/var/log/system-info.log"

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

# Function to display network information
function show_network_info {
	echo "Network Information:"
	echo "Hostname: $(hostname)"
	echo "IP Address:"
	ip -4 addr show | grep inet | awk '{print $2}' | cut -d/ -f1
	echo
}

# Function to display kernel version
function show_kernel_version {
	echo "Kernel Version"
	uname -r
	echo
}

# Function to display top 5 processes by memoory usage
function show_top_processes {
	echo "Top 5 processes by Memory Usage:"
	ps -eo pid,ppid,cmd,%mem,%cpu --sort=-%mem | head -n 6
	echo
}

# Function to check the status of a specific service (e.g., sshd)
function check_service_status {
	local service="$1"
	echo "Checking Service Status: $service"
	systemctl is-active $service > /dev/null 2>&1
	if [ $? -eq 0 ]; then
		echo "$service is running"
	else
		echo "$service is not running."
	fi
	echo
}

# Main script execution with logging
{
    echo "=== SYSTEM INFORMATION ==="
    print_system_info
    show_uptime
    show_disk_usage
    show_memory_usage
    show_cpu_load
    show_logged_in_users
    show_network_info
    show_kernel_version
    show_top_processes
    check_service_status sshd
    echo "=========================="
    echo
} >> $LOG_FILE

echo "System information logged to $LOG_FILE."
