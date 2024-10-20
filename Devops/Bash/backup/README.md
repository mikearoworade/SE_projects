# Backup Script
Automate the backup of a directory to a specified location.

## Overview
- Create a compressed archive of the directory
- Name the archive with the current date and time
- store the archive in a backup directory
- delete backups olderthan a certain number of days

## Skills
- tar
- gzip
- find
- cp

## Usage
```
$ sudo chmod 777 /mnt
$ chmod +x backup.sh
$ ./backup.sh
``` 
