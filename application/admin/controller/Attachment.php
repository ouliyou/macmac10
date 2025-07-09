public function del() {
    $ids = input('ids/a', []);
    
    foreach ($ids as $id) {
        $attachment = db('attachment')->where(['id' => $id])->find();
        
        if ($attachment) {
            $filePath = $attachment['file_path'];
            
            // 1. 验证文件路径安全性
            $realPath = realpath($filePath);
            $allowedPath = realpath(MAC_ROOT_PATH . 'upload/');
            
            // 确保文件在允许的目录内
            if ($realPath && strpos($realPath, $allowedPath) === 0) {
                // 2. 检查文件是否为重要系统文件
                $protectedFiles = [
                    'install.lock',
                    'config.php',
                    '.htaccess',
                    'index.php'
                ];
                
                $filename = basename($filePath);
                if (!in_array($filename, $protectedFiles)) {
                    // 3. 安全删除文件
                    if (file_exists($realPath)) {
                        unlink($realPath);
                    }
                    
                    // 4. 删除数据库记录
                    db('attachment')->where(['id' => $id])->delete();
                }
            }
        }
    }
    
    return json(['code' => 1, 'msg' => '删除成功']);
}
public function del() {
    $ids = input('ids/a', []);
    
    foreach ($ids as $id) {
        $attachment = db('attachment')->where(['id' => $id])->find();
        
        if ($attachment) {
            $filePath = $attachment['file_path'];
            
            // 1. 验证文件路径安全性
            $realPath = realpath($filePath);
            $allowedPath = realpath(MAC_ROOT_PATH . 'upload/');
            
            // 确保文件在允许的目录内
            if ($realPath && strpos($realPath, $allowedPath) === 0) {
                // 2. 检查文件是否为重要系统文件
                $protectedFiles = [
                    'install.lock',
                    'config.php',
                    '.htaccess',
                    'index.php'
                ];
                
                $filename = basename($filePath);
                if (!in_array($filename, $protectedFiles)) {
                    // 3. 安全删除文件
                    if (file_exists($realPath)) {
                        unlink($realPath);
                    }
                    
                    // 4. 删除数据库记录
                    db('attachment')->where(['id' => $id])->delete();
                }
            }
        }
    }
    
    return json(['code' => 1, 'msg' => '删除成功']);
}
