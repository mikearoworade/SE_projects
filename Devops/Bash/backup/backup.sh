#!/bin/bash

# Variables
SOURCE_DIR="/home/mike/SE_projects/" 		# Directory to back up
BACKUP_DIR="/mnt/backup" 			# Backup storage location
RETENTION_DAYS=7				# Number of days to keep old backups
CURRENT_DATE=$(date +"%Y-%m-%d_%H-%M-%S")	# Date formate for backup name
ARCHIVE_NAME="SE_Projects_$CURRENT_DATE.tar.gz"	# Backup file name

# Create the backup directory if it doesn't exist
if [ ! -d "$BACKUP_DIR" ]; then
	echo "Creating backup directory at $BACKUP_DIR"
	mkdir -p "$BACKUP_DIR"
fi

# Create a compressed archive of the source directory
tar -czf "$BACKUP_DIR/$ARCHIVE_NAME" -C "$SOURCE_DIR" .

# Check if the backup was successful
if [ $? -eq 0 ]; then
	echo "Backup created successfully: $BACKUP_DIR/$ARCHIVE_NAME"
else
	echo "Backup Failed"
	exit 1
fi

# Delete backups older than the retention period
echo "Deleting backups older than $RETENTION_DAYS days..."
find "$BACKUP_DIR" -type f -name "*.tar.gz" -mtime +$RETENTION_DAYS -exec rm {} \;

# CHeck if old backups were deleted successfully
if [ $? -eq 0 ]; then
	echo "Old backups deleted successfully."
else
	echo "Failed to delete old backups."
fi

echo "Backup process completed."
