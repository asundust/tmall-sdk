# 介绍
天猫商家相关的sdk

# 使用
```
$config = [
        'app_key' => '111111',
        'secret' => 'abcdefg12345678',
        'customerId' => '222222222',
        'session' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxx',
    ];
Tmall::qimen($config)->store->query(['storeId' => 12345678]);
```