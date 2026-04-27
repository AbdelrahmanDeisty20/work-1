@extends('layout.tmp')
@section('title', 'قائمة العملاء')

@section('conntent')
<div class="container mt-4" dir="rtl">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">قائمة العملاء</h2>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ms-1"></i> إضافة عميل جديد
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>الاسم</th>
                            <th>المحافظة</th>
                            <th>المدينة</th>
                            <th>الخدمة</th>
                            <th>رقم الهاتف</th>
                            <th>المدفوع</th>
                            <th>المتبقي</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td class="fw-bold text-dark">{{ $customer->name }}</td>
                                <td>{{ $customer->governorate }}</td>
                                <td>{{ $customer->city }}</td>
                                <td>{{ $customer->service }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td class="text-success fw-bold">{{ number_format($customer->paid_amount, 2) }}</td>
                                <td class="text-danger fw-bold">{{ number_format($customer->remaining_amount, 2) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-sm btn-info text-white" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-success" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger delete-customer" data-id="{{ $customer->id }}" data-name="{{ $customer->name }}" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-4 text-muted">لا يوجد عملاء مضافين حالياً.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-customer');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                
                if (confirm(`هل أنت متأكد من حذف العميل "${name}"؟`)) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('DELETE', `/customers/${id}`, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    
                    xhr.onload = function() {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            location.reload();
                        } else {
                            alert('حدث خطأ أثناء الحذف.');
                        }
                    };
                    
                    xhr.send();
                }
            });
        });
    });
</script>
@endsection
