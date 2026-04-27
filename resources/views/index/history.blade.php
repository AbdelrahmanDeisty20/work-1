@extends('layout.tmp')
@section('title', 'سجل اشتراكات: ' . $craftsman->name)

@section('conntent')
<style>
    .status-card {
        border-radius: 20px;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 40px;
    }
    .status-header {
        background: #525293;
        color: white;
        padding: 20px;
    }
    .timeline-container {
        position: relative;
        padding: 20px 0;
    }
    .timeline-item {
        position: relative;
        padding-right: 40px;
        margin-bottom: 30px;
        border-right: 3px solid #e9ecef;
    }
    .timeline-marker {
        position: absolute;
        right: -9px;
        top: 0;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: #525293;
        border: 3px solid #fff;
        box-shadow: 0 0 0 3px #525293;
    }
    .timeline-content {
        background: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }
    .timeline-content:hover {
        transform: scale(1.02);
    }
    .date-badge {
        background: #f1f1ff;
        color: #525293;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 0.9rem;
    }
    .subscription-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        display: block;
    }
</style>

<div class="container mt-4" dir="rtl">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('show-Craftsmen', [$craftsman->id]) }}" class="btn btn-dark rounded-circle shadow">
            <i class="fa-solid fa-arrow-right"></i>
        </a>
        <h2 class="fw-bold mb-0">سجل الاشتراكات</h2>
        <div style="width: 40px;"></div>
    </div>

    <!-- كارت الحالة الحالية -->
    <div class="card status-card">
        <div class="status-header text-center">
            <h4 class="mb-0">الموظف: {{ $craftsman->name }}</h4>
        </div>
        <div class="card-body text-center p-4">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <span class="subscription-icon">
                        @if($craftsman->subscription_status == 'مشترك') 🛡️ @else ⚠️ @endif
                    </span>
                    <h5 class="fw-bold">حالة الاشتراك</h5>
                    <span class="badge {{ $craftsman->subscription_status == 'مشترك' ? 'bg-success' : 'bg-danger' }} fs-6 px-4 py-2">
                        {{ $craftsman->subscription_status ?? 'غير محدد' }}
                    </span>
                </div>
                <div class="col-md-8 border-start">
                    <h5 class="fw-bold text-muted mb-3">تفاصيل الاشتراك الحالي</h5>
                    @if($currentSubscription)
                        <div class="d-flex justify-content-around align-items-center">
                            <div>
                                <p class="text-muted mb-1">من تاريخ</p>
                                <span class="date-badge">{{ $currentSubscription->startDate }}</span>
                            </div>
                            <i class="fas fa-arrow-left text-muted"></i>
                            <div>
                                <p class="text-muted mb-1">إلى تاريخ</p>
                                <span class="date-badge bg-primary text-white">{{ $currentSubscription->endDate }}</span>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-light border">لا يوجد اشتراك ساري حالياً</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- جدول سجل التواريخ -->
    <div class="mt-5">
        <h4 class="fw-bold mb-4"><i class="fas fa-history ms-2"></i>التسلسل الزمني للاشتراكات</h4>
        <div class="timeline-container">
            @forelse($subscriptions as $sub)
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-2">فترة اشتراك مكتملة</h6>
                                <p class="mb-0 text-muted">
                                    <i class="far fa-calendar-alt ms-1"></i>
                                    من: <strong>{{ $sub->startDate }}</strong> إلى: <strong>{{ $sub->endDate }}</strong>
                                </p>
                            </div>
                            <span class="badge bg-light text-dark border">
                                مدة الاشتراك: {{ \Carbon\Carbon::parse($sub->startDate)->diffInDays($sub->endDate) }} يوم
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-folder-open fs-1 mb-3 d-block"></i>
                    لا يوجد سجلات اشتراك سابقة.
                </div>
            @endforelse
        </div>
    </div>

    <div class="text-center mt-5 mb-5">
        <a href="{{ route('show-Craftsmen', [$craftsman->id]) }}" class="btn btn-outline-secondary px-5">العودة لملف الموظف</a>
    </div>
</div>
@endsection