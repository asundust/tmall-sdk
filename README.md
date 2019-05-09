# 介绍
天猫商家相关的sdk

# 接口查找
查询当前sdk里是否含有需要的api搜索接口名字请全局搜索去掉开头的`taobao.`。

如查询`taobao.items.onsale.get`，全局搜关键字`items.onsale.get`即可。

api方法上的类注释上都放了接口文档地址。

# 使用
```
$config = [
        'app_key' => '111111',
        'secret' => 'abcdefg12345678',
        'customerId' => '222222222',
    ];
Tmall::qimen($config)->store->query(['storeId' => 12345678]);
```
一般必传`app_key`、`secret`，像`customerId`属于特殊接口选传。

# Auth用户授权
执行`(new Auth($config))->auth($redirectUri);`，传入回调地址，拿到code去执行`(new Auth($config))->getAccessToken($code)`。

相关文档https://open.taobao.com/doc.htm?docId=102635&docType=1