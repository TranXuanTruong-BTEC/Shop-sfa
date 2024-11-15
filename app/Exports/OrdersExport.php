<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }

    public function headings(): array
    {
        return [
            'Mã đơn',
            'Khách hàng',
            'Email',
            'Số điện thoại',
            'Địa chỉ',
            'Tổng tiền',
            'Trạng thái',
            'Ngày đặt',
            'Ghi chú'
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_number,
            $order->customer_name,
            $order->customer_email,
            $order->customer_phone,
            $order->shipping_address,
            number_format($order->total_amount, 0, ',', '.') . 'đ',
            $this->getStatusText($order->status),
            $order->created_at->format('d/m/Y H:i'),
            $order->notes
        ];
    }

    private function getStatusText($status)
    {
        return match($status) {
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',
            default => $status,
        };
    }
}