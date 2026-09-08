<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                ['label' => __('Người dùng'), 'value' => '1,204', 'change' => '+4.3% '.__('so với tháng trước'), 'trend' => 'up', 'icon' => 'users'],
                ['label' => __('Doanh thu'), 'value' => '$48,200', 'change' => '+12.5% '.__('so với tháng trước'), 'trend' => 'up', 'icon' => 'chart-bar'],
                ['label' => __('Đơn hàng'), 'value' => '356', 'change' => '-2.1% '.__('so với tháng trước'), 'trend' => 'down', 'icon' => 'folder'],
                ['label' => __('Tỉ lệ chuyển đổi'), 'value' => '3.2%', 'change' => '+0.4% '.__('so với tháng trước'), 'trend' => 'up', 'icon' => 'check-circle'],
            ],
            'recentUsers' => [
                ['name' => 'Nguyễn Văn An', 'email' => 'an.nguyen@example.com', 'role' => __('Quản trị viên'), 'status' => 'active'],
                ['name' => 'Trần Thị Bình', 'email' => 'binh.tran@example.com', 'role' => __('Biên tập viên'), 'status' => 'active'],
                ['name' => 'Lê Hoàng Cường', 'email' => 'cuong.le@example.com', 'role' => __('Thành viên'), 'status' => 'inactive'],
                ['name' => 'Phạm Thu Dung', 'email' => 'dung.pham@example.com', 'role' => __('Thành viên'), 'status' => 'active'],
                ['name' => 'Vũ Minh Đức', 'email' => 'duc.vu@example.com', 'role' => __('Biên tập viên'), 'status' => 'inactive'],
            ],
        ]);
    }
}
