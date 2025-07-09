
// public function login() {
//     if (request()->isPost()) {
//         $username = input('username', '');
//         $password = input('password', '');
        
//         // 移除危险的登录方式
//         // 禁用 col 和 openid 参数登录
        
//         // 1. 验证用户名和密码不为空
//         if (empty($username) || empty($password)) {
//             return json(['code' => 0, 'msg' => '用户名和密码不能为空']);
//         }
        
//         // 2. 防止暴力破解
//         $loginAttempts = cache('login_attempts_' . request()->ip());
//         if ($loginAttempts >= 5) {
//             return json(['code' => 0, 'msg' => '登录尝试次数过多，请稍后再试']);
//         }
        
//         // 3. 验证用户名格式
//         if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
//             return json(['code' => 0, 'msg' => '用户名格式不正确']);
//         }
        
//         // 4. 查询用户（只允许用户名密码登录）
//         $user = db('admin')->where([
//             'admin_name' => $username,
//             'admin_status' => 1
//         ])->find();
        
//         if (!$user) {
//             // 增加失败次数
//             cache('login_attempts_' . request()->ip(), $loginAttempts + 1, 300);
//             return json(['code' => 0, 'msg' => '用户名或密码错误']);
//         }
        
//         // 5. 验证密码
//         if (!password_verify($password, $user['admin_pwd'])) {
//             cache('login_attempts_' . request()->ip(), $loginAttempts + 1, 300);
//             return json(['code' => 0, 'msg' => '用户名或密码错误']);
//         }
        
//         // 6. 登录成功，清除尝试次数
//         cache('login_attempts_' . request()->ip(), null);
        
//         // 7. 设置会话
//         session('admin_id', $user['admin_id']);
//         session('admin_name', $user['admin_name']);
        
//         return json(['code' => 1, 'msg' => '登录成功']);
//     }
// }
public function login() {
    if (request()->isPost()) {
        $username = input('username', '');
        $password = input('password', '');
        
        // 移除危险的登录方式
        // 禁用 col 和 openid 参数登录
        
        // 1. 验证用户名和密码不为空
        if (empty($username) || empty($password)) {
            return json(['code' => 0, 'msg' => '用户名和密码不能为空']);
        }
        
        // 2. 防止暴力破解
        $loginAttempts = cache('login_attempts_' . request()->ip());
        if ($loginAttempts >= 5) {
            return json(['code' => 0, 'msg' => '登录尝试次数过多，请稍后再试']);
        }
        
        // 3. 验证用户名格式
        if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
            return json(['code' => 0, 'msg' => '用户名格式不正确']);
        }
        
        // 4. 查询用户（只允许用户名密码登录）
        $user = db('admin')->where([
            'admin_name' => $username,
            'admin_status' => 1
        ])->find();
        
        if (!$user) {
            // 增加失败次数
            cache('login_attempts_' . request()->ip(), $loginAttempts + 1, 300);
            return json(['code' => 0, 'msg' => '用户名或密码错误']);
        }
        
        // 5. 验证密码
        if (!password_verify($password, $user['admin_pwd'])) {
            cache('login_attempts_' . request()->ip(), $loginAttempts + 1, 300);
            return json(['code' => 0, 'msg' => '用户名或密码错误']);
        }
        
        // 6. 登录成功，清除尝试次数
        cache('login_attempts_' . request()->ip(), null);
        
        // 7. 设置会话
        session('admin_id', $user['admin_id']);
        session('admin_name', $user['admin_name']);
        
        return json(['code' => 1, 'msg' => '登录成功']);
    }
}
