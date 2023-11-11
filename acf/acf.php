<?php
// Get the current directory path
$current_dir_path = __DIR__;

// Automatically require PHP files in first-level directories with names matching the directory names
tt4c_require_first_level_directory_named_like_files_automatically($current_dir_path);
