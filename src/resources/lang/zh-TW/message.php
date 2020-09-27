<?php
/**
 * 基本上key的規則就是 '大類別_行為_錯誤內容'
 */

return [
    //http狀態碼固定訊息
    'http_304' => 'Token為黑名單或已過期。',
    'http_401' => '驗證錯誤/驗證已失效，請重新登入驗證。',
    'http_403' => '您無此操作的權限，請聯絡系統管理員。',
    'http_404' => '資料不存在。',
    'http_409' => '狀態未停用/項目仍有其他功能使用中，無法允許刪除。',
    'http_500' => '系統發生內部錯誤，請聯絡系統管理員。',

    //驗證錯誤
    'api_auth_tokenExpired' => '驗證錯誤/驗證已失效，請重新登入驗證。',
    'api_auth_unauthorized' => '未提供token。',
    'api_auth_tokenBlacklisted' => '驗證錯誤/驗證已失效，請重新登入驗證。',
    'api_auth_jwtError' => 'Token錯誤。',
    'api_auth_tokenInvalid' => '驗證錯誤/驗證已失效，請重新登入驗證。',
    'api_auth_throttleRequest' => '請求太頻繁。',

    //基本錯誤
    'api_create_failed' => '新增失敗',
    'api_show_failed' => '取得列表失敗',
    'api_read_failed' => '取得單筆失敗',
    'api_update_failed' => '修改失敗',
    'api_delete_failed' => '刪除失敗',
];
