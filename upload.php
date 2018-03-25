<?php
require_once __DIR__ . '/php-sdk-master/autoload.php'; 

use Qiniu\Storage\UploadManager;
use Qiniu\Auth;

$accessKey = "Ce1D8ifktjnbymQb9jS_VIx-cIFEMknopYOS8seS";
$secretKey = "SYVtq_AGI830hVTBWjTkgD6L_hK6d0nfKooIhT7t";
$bucketName = "aishan-vedio";

$upManager = new UploadManager();
$auth = new Auth($accessKey, $secretKey);
$token = $auth->uploadToken($bucketName);
list($ret, $error) = $upManager->put($token, 'formput', 'hello world');
echo $token;