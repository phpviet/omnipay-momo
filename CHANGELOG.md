# Changelog

Tất cả lịch sử tiến trình phát triển thư viện

## 1.0.3

- Sửa lỗi parameters bag của notification request tại cổng All In One.

## 1.0.2

- Implement phương thức `isCancelled` ở lớp `\Omnipay\MoMo\Message\AbstractResponse`.
- Throw exception ở concern `\Omnipay\MoMo\Message\Conerns\ResponseSignatureValidation` khi response không tồn tại chữ ký.

## 1.0.1

- Thực thi trả về `self` đối với các phương thức thiết lập parameters ở gateways và requests.
- Khởi tạo các giá trị mặc định tại phương thức `initialize` của requests thay vì `getData`.

