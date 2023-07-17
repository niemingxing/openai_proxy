<?php
// 目标网址
$targetUrl = 'https://api.openai.com';
// 获取原始请求数据
$requestData = file_get_contents('php://input');
// 获取原始请求头
$requestHeaders = getallheaders();
// 构建目标 URL
$targetUrl .= $_SERVER['REQUEST_URI'];
// 处理查询参数
$queryString = $_SERVER['QUERY_STRING'];
if (!empty($queryString)) {
    $targetUrl .= '?' . $queryString;
}
// 创建 cURL 句柄
$ch = curl_init();

// 设置 cURL 选项
curl_setopt($ch, CURLOPT_URL, $targetUrl); // 设置目标网址
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 将返回结果保存到变量而不直接输出
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $_SERVER['REQUEST_METHOD']); // 使用与原始请求相同的方法
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData); // 设置请求数据
curl_setopt($ch, CURLOPT_HTTPHEADER, formatRequestHeaders($requestHeaders)); // 设置请求头

// 执行 cURL 请求
$response = curl_exec($ch);
// 检查是否有错误发生
if(curl_errno($ch)) {
    $error = curl_error($ch);
    http_response_code(500);
    // 处理错误
    echo 'cURL Error: ' . $error;
}
else
{
    // 获取响应的 HTTP 状态码
    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // 设置响应的 HTTP 状态码
    http_response_code($httpStatus);
    // 输出响应内容
    echo $response;
}
// 关闭 cURL 句柄
curl_close($ch);

/**
 * 格式化请求头，将关联数组转换为字符串数组
 *
 * @param array $headers 关联数组的请求头
 * @return array 字符串数组的请求头
 */
function formatRequestHeaders($headers) {
    $formattedHeaders = [];
    foreach ($headers as $key => $value) {
        if (in_array(strtolower($key),['authorization','content-type'])) {
            $formattedHeaders[] = $key . ': ' . $value;
        }
    }
    return $formattedHeaders;
}

