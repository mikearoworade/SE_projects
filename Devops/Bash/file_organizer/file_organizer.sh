#!/bin/bash

# Define source directory (where files are located)
SOURCE_DIR="/home/mike/files"	# Set source directory

# DEfine destination directories
IMAGES_DIR="$SOURCE_DIR/Images"
DOCUMENTS_DIR="$SOURCE_DIR/Documents"
VIDEOS_DIR="$SOURCE_DIR/Videos"

# Create destination directories if they do not exist
mkdir -p "$IMAGES_DIR" "$DOCUMENTS_DIR" "$VIDEOS_DIR"

# Move image files (.jpg, .png, .gif) to the Image folder
echo "Organizing image files..."
find "$SOURCE_DIR" -maxdepth 1 \( -iname "*.jpg" -o -iname "*.png" -o -iname "*.gif" \) -exec mv {} "$IMAGES_DIR" \;

# Move document files (.pdf, .doc, .txt) to the Documents folder
echo "Organizing document files..."
find "$SOURCE_DIR" -maxdepth 1 \( -iname "*.pdf" -o -iname "*.doc" -o -iname "*.txt" \) -exec mv {} "$DOCUMENTS_DIR" \;

# Move video files (.mp4, .avi, .mkv) to the Videos folder
echo "Organizing video files..."
find "$SOURCE_DIR" -maxdepth 1 \( -iname "*.mp4" -o -iname "*.avi" -o -iname "*.mkv" \) -exec mv {} "$VIDEOS_DIR" \;

echo "File organization completed."
