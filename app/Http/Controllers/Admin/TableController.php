<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Hiển thị danh sách bàn
     */
    public function index()
    {
        $tables = Table::all();
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Hiển thị form tạo bàn mới
     */
    public function create()
    {
        return view('admin.tables.create');
    }

    /**
     * Lưu bàn mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'is_vip' => 'boolean',
            'is_available' => 'boolean',
        ]);

        Table::create($validated);

        return redirect()->route('admin.tables.index')
            ->with('success', 'Thêm bàn mới thành công!');
    }

    /**
     * Xem chi tiết bàn
     */
    public function show(Table $table)
    {
        return view('admin.tables.show', compact('table'));
    }

    /**
     * Hiển thị form chỉnh sửa bàn
     */
    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    /**
     * Cập nhật thông tin bàn
     */
    public function update(Request $request, Table $table)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'is_vip' => 'boolean',
            'is_available' => 'boolean',
        ]);

        $table->update($validated);

        return redirect()->route('admin.tables.index')
            ->with('success', 'Cập nhật bàn thành công!');
    }

    /**
     * Xóa bàn
     */
    public function destroy(Table $table)
    {
        // Kiểm tra xem bàn có đang được đặt không
        if ($table->bookings()->where('status', '!=', 'completed')->exists()) {
            return back()->with('error', 'Không thể xóa bàn đang được đặt!');
        }

        $table->delete();

        return redirect()->route('admin.tables.index')
            ->with('success', 'Xóa bàn thành công!');
    }
}