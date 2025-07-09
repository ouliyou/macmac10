#!/bin/bash
# MacCMS10 文件权限修复脚本

echo "开始修复MacCMS10文件权限..."

# 设置基本权限
find /path/to/maccms10 -type f -exec chmod 644 {} \;
find /path/to/maccms10 -type d -exec chmod 755 {} \;

# 设置特殊权限
chmod 666 /path/to/maccms10/application/data/config/database.php
chmod 666 /path/to/maccms10/application/data/config/site.php
chmod 777 /path/to/maccms10/runtime/
chmod 777 /path/to/maccms10/upload/

# 保护重要文件
chmod 600 /path/to/maccms10/application/data/install/install.lock
chmod 644 /path/to/maccms10/.htaccess

echo "文件权限修复完成！"
