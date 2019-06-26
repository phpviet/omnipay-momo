QRCode Gateway
---------------

Để nắm sơ lược về khái niệm và cách sử dụng các **Omnipay** gateways bạn hãy truy cập vào [đây](https://omnipay.thephpleague.com/) 
để kham khảo.

## Khởi tạo gateway:

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('MoMo_QRCode');
$gateway->setAccessKey('Do MoMo cấp.');
$gateway->setPartnerCode('Do MoMo cấp.');
$gateway->setSecretKey('Do MoMo cấp.');
```

## Kiểm tra thông tin `notifyUrl` do MoMo gửi sang:

```php
$response = $gateway->notification()->send();

if ($response->isSuccessful()) {
    // TODO: xử lý kết quả và confirm giao dịch với MoMo.
    
    print $response->amount;
    print $response->partnerRefId;
    
    var_dump($response->getData()); // toàn bộ data do MoMo gửi sang.
    
} else {

    print $response->getMessage();
}
```

Kham khảo thêm các tham trị khi MoMo gửi sang tại [đây](https://developers.momo.vn/#/docs/qr_payment?id=x%e1%bb%ad-l%c3%bd-thanh-to%c3%a1n).

## Confirm giao dịch:

```php
$response = $gateway->payConfirm([
    "partnerRefId" => "Merchant123556666",
    "requestType" => "capture",
    "requestId" => "1512529262248",
    "momoTransId" => "12436514111",
    "customerNumber" => "0963181714",
])->send();

if ($response->isSuccessful()) {
    // TODO: trả về response cho MoMo
    
    print $response->amount;
    
    var_dump($response->getData()); // Trả về toàn bộ dữ liệu do MoMo trả về.
} else {

    print $response->getMessage();
}
```

Kham khảo thêm các tham trị khi tạo yêu cầu và MoMo trả về tại [đây](https://developers.momo.vn/#/docs/qr_payment?id=x%c3%a1c-nh%e1%ba%adn-giao-d%e1%bb%8bch).

## Phương thức hổ trợ debug:

Một số phương thức chung hổ trợ debug khi `isSuccessful()` trả về `FALSE`:

```php
    print $response->getCode(); // mã báo lỗi do MoMo gửi sang.
    print $response->getMessage(); // câu thông báo lỗi do MoMo gửi sang.
```

Kham khảo bảng báo lỗi `getCode()` chi tiết tại [đây](https://developers.momo.vn/#/docs/aio/?id=b%e1%ba%a3ng-m%c3%a3-l%e1%bb%97i).
