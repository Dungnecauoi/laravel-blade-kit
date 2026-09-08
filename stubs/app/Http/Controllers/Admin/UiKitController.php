<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class UiKitController extends Controller
{
    public function __invoke(Request $request): View|JsonResponse
    {
        $ajaxPaginator = $this->paginate(
            collect(range(1, 40))->map(fn (int $i) => __('Mục AJAX #:number', ['number' => $i])),
            perPage: 8,
            pageName: 'ajax_page',
        );

        if ($request->boolean('ajax')) {
            return response()->json([
                'rows' => view('admin.partials.ajax-demo-rows', compact('ajaxPaginator'))->render(),
                'pagination' => view('admin.partials.ajax-demo-pagination', compact('ajaxPaginator'))->render(),
            ]);
        }

        return view('admin.ui-kit', [
            'demoPaginator' => $this->paginate(
                collect(range(1, 42))->map(fn (int $i) => __('Mục demo #:number', ['number' => $i])),
                perPage: 8,
            ),
            'ajaxPaginator' => $ajaxPaginator,
            'demoRows' => [
                ['id' => 1, 'name' => 'Nguyễn Văn An', 'email' => 'an.nguyen@example.com'],
                ['id' => 2, 'name' => 'Trần Thị Bình', 'email' => 'binh.tran@example.com'],
                ['id' => 3, 'name' => 'Lê Hoàng Cường', 'email' => 'cuong.le@example.com'],
            ],
            'demoNotifications' => [
                ['title' => __('Đơn hàng #1082 vừa được tạo'), 'time' => __(':n phút trước', ['n' => 5]), 'read' => false],
                ['title' => __('Nguyễn Văn An đã bình luận vào ticket #43'), 'time' => __(':n giờ trước', ['n' => 2]), 'read' => false],
                ['title' => __('Sao lưu hệ thống hoàn tất'), 'time' => __('Hôm qua'), 'read' => true],
            ],
        ]);
    }

    private function paginate(Collection $items, int $perPage, string $pageName = 'page'): LengthAwarePaginator
    {
        $page = LengthAwarePaginator::resolveCurrentPage($pageName);

        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query(), 'pageName' => $pageName],
        );
    }
}
