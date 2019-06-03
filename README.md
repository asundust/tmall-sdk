# 介绍
天猫商家相关的sdk

# 安装
composer require asundust/tmall-sdk

# 接口查找
查询当前sdk里是否含有需要的api搜索接口名字请全局搜索去掉开头的`taobao.`。

如查询`taobao.items.onsale.get`，全局搜关键字`items.onsale.get`即可。

Api方法上的类注释上都放了接口文档地址。

PS：部分接口可能实际使用中涉及不到，暂时没删除接口。也别问我为什么接口不列出来。

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

接口命名规则：如`taobao.qimen.storeinventory.itemupdate`，调用方式为单词名的驼峰式，
即`Tmall::qimen($config)->storeInventory->itemUpdate(['xxx' => 'xxx']);`

只有三段式的接口会多一个`index`方法，如`taobao.refund.get`的请求方式为`Tmall::refund($config)->get->index(['xxx' => 'xxx']);`

超过标准四段式的接口会使用驼峰的方法，如`taobao.rdc.aligenius.sendgoods.cancel`的请求方式为`Tmall::rdc($config)->aliGenius->sendGoodsCancel(['xxx' => 'xxx']);`

# 传参
奇门接口用的是xml格式入参的，如果入参需要入重复参数，由于PHP不支持同键数组，目前妥协办法为：键值拼上数字，在转成xml的时候自动去掉。
关于这个，如有更好建议请提出。
如：入参规则为
```
<?xml version="1.0" encoding="UTF-8"?>
<request> 
	<userId>淘宝账号ID，long ，必填</userId>
	<operationTime>操作时间，string (19) , YYYY-MM-DD HH:MM:SS，必填</operationTime>
	<stores>
		<store>
			<warehouseType>库存来源的类型，string(50)，WAREHOUSE=电商仓，STORE=门店，必填</warehouseType>
			<warehouseId>门店ID（商户中心） 或 电商仓ID，string(50)，必填</warehouseId>	
			<storeInventories>
				<storeInventory>
					<billNum>单据流水号，用于幂等操作，string(50) ，必填</billNum>
					<itemId>淘宝前端商品id，long，必填</itemId>
					<outerId>ISV系统中商品SKU外部编码（一定要和itemid，skuid一致，不然会认为是一个新的商品，且保证唯一），string(50) ，必填</outerId>
					<skuId>商品的SKU编码，long,有sku的必填</skuId>
					<inventoryType>库存类型，string(50)，CERTAINTY=确定性库存，UNCERTAINTY=不确定性库存，必填</inventoryType>
					<quantity>对应类型的库存数量（正数），int，必填</quantity>
				</storeInventory>
			</storeInventories>
		</store>
	</stores>
</request>
```
入参数组
```
[
    'userId' => '000000',
    'stores' => [
        'store0' => [
            'warehouseType' => 'STORE',
            'warehouseId' => '111111',
            'storeInventories' => [
                'storeInventory' => [
                    'itemId' => '222222',
                    'outerId' => '333333',
                    'skuId' => '444444',
                ]
            ],
        ],
        'store1' => [
            'warehouseType' => 'STORE',
            'warehouseId' => '555555',
            'storeInventories' => [
                'storeInventory' => [
                    'itemId' => '666666',
                    'outerId' => '777777',
                    'skuId' => '888888',
                ]
            ],
        ]
    ],
]
```
上述的`store0`和`store1`在转成xml后会自动变回`store`。

# Auth用户授权
执行`(new Auth($config))->auth($redirectUri);`

传入回调地址，拿到code去执行`(new Auth($config))->getAccessToken($code);`。

相关文档 [https://open.taobao.com/doc.htm?docId=102635&docType=1](https://open.taobao.com/doc.htm?docId=102635&docType=1)

# 其他
如果遇到错误之处还请各位指出

需要增加接口请告知

# License
[MIT license](https://opensource.org/licenses/MIT)