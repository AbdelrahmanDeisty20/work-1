@extends('layout.tmp')
@section('title', 'تفاصيل العميل: ' . $customer->name)

@section('conntent')
<style>
    .customer-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        background: #fff;
    }
    .customer-header {
        background: linear-gradient(135deg, #2c3e50, #4ca1af);
        color: white;
        padding: 30px;
        text-align: center;
    }
    .info-item {
        padding: 15px;
        border-bottom: 1px solid #f1f1f1;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .info-item:last-child {
        border-bottom: none;
    }
    .info-icon {
        width: 40px;
        height: 40px;
        background: #f8f9fa;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4ca1af;
        font-size: 1.2rem;
    }
    .info-label {
        color: #888;
        font-size: 0.9rem;
        margin: 0;
    }
    .info-value {
        color: #333;
        font-weight: bold;
        margin: 0;
        font-size: 1.1rem;
    }
    .amount-badge {
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
    }
</style>

<div class="container mt-5" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="customer-card">
                <div class="customer-header">
                    <i class="fas fa-user-tie fa-3x mb-3"></i>
                    <h2 class="mb-0">{{ $customer->name }}</h2>
                    <p class="mb-0 opacity-75">عميل مخصص لـ: {{ $customer->service }}</p>
                </div>
                
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-phone"></i></div>
                                <div>
                                    <p class="info-label">رقم الهاتف</p>
                                    <p class="info-value text-primary">{{ $customer->phone }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div>
                                    <p class="info-label">المحافظة / المدينة</p>
                                    <p class="info-value">{{ $customer->governorate }} / {{ $customer->city }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="info-item">
                                <div class="info-icon"><i class="fas fa-tools"></i></div>
                                <div>
                                    <p class="info-label">الخدمة المطلوبة</p>
                                    <p class="info-value">{{ $customer->service }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-item bg-light">
                                <div class="info-icon bg-white"><i class="fas fa-money-bill-wave text-success"></i></div>
                                <div>
                                    <p class="info-label">المبلغ المدفوع</p>
                                    <p class="info-value text-success">{{ number_format($customer->paid_amount, 2) }} ج.م</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item bg-light">
                                <div class="info-icon bg-white"><i class="fas fa-exclamation-circle text-danger"></i></div>
                                <div>
                                    <p class="info-label">المبلغ المتبقي</p>
                                    <p class="info-value text-danger">{{ number_format($customer->remaining_amount ?? 0, 2) }} ج.م</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 mb-5">
                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary btn-lg px-5">رجوع للقائمة</a>
                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary btn-lg px-5 ms-2">تعديل البيانات</a>
            </div>
        </div>
    </div>
</div>
@endsection
