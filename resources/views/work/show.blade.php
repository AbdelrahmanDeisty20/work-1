@extends('layout.tmp')
@section('title', 'ملف: ' . $craftsman->name)

@section('conntent')
<style>
    .profile-header {
        background: linear-gradient(135deg, #525293, #9b9adb);
        height: 150px;
        border-radius: 0 0 50px 50px;
        position: relative;
        margin-bottom: 80px;
    }
    .profile-img-container {
        position: absolute;
        bottom: -60px;
        left: 50%;
        transform: translateX(-50%);
        padding: 5px;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    .profile-img-container img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
    }
    .info-card {
        background: #fff;
        border-radius: 20px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        padding: 20px;
        height: 100%;
        transition: transform 0.3s ease;
    }
    .info-card:hover {
        transform: translateY(-5px);
    }
    .info-label {
        color: #888;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }
    .info-value {
        color: #333;
        font-weight: bold;
        font-size: 1.1rem;
    }
    .action-btn {
        border-radius: 15px;
        padding: 15px 30px;
        font-weight: bold;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .btn-documents {
        background: #525293;
        color: #fff;
    }
    .btn-history {
        background: #f8f9fa;
        color: #525293;
        border: 2px solid #525293;
    }
    .btn-documents:hover {
        background: #3f3f7a;
        color: #fff;
        transform: scale(1.05);
    }
    .btn-history:hover {
        background: #525293;
        color: #fff;
        transform: scale(1.05);
    }
</style>

<div class="container pb-5" dir="rtl">
    <div class="my-3">
        <a href="{{ route('index') }}" class="btn btn-outline-light text-dark border-0">
            <i class="fa-solid fa-arrow-right"></i> رجوع للرئيسية
        </a>
    </div>

    <!-- رأس الصفحة -->
    <div class="profile-header">
        <div class="profile-img-container">
            @if($craftsman->image)
                <img src="{{ asset($craftsman->image) }}" alt="Profile Photo">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($craftsman->name) }}&background=525293&color=fff" alt="Default Avatar">
            @endif
        </div>
    </div>

    <div class="text-center mt-2 mb-5">
        <h2 class="fw-bold mb-1">{{ $craftsman->name }}</h2>
        <span class="badge {{ $craftsman->subscription_status == 'مشترك' ? 'bg-success' : 'bg-danger' }} px-3 py-2 rounded-pill">
            <i class="fas {{ $craftsman->subscription_status == 'مشترك' ? 'fa-check-circle' : 'fa-times-circle' }} ms-1"></i>
            {{ $craftsman->subscription_status ?? 'غير مشترك' }}
        </span>
    </div>

    <!-- شبكة المعلومات -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="info-card">
                <p class="info-label"><i class="fas fa-briefcase ms-1"></i> المهنة</p>
                <p class="info-value">{{ $craftsman->Category ? $craftsman->Category->name : 'غير موجود' }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-card">
                <p class="info-label"><i class="fas fa-phone ms-1"></i> رقم الهاتف</p>
                <p class="info-value text-primary">{{ $craftsman->phone }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-card">
                <p class="info-label"><i class="fas fa-map-marker-alt ms-1"></i> المحافظة / المدينة</p>
                <p class="info-value">{{ $craftsman->Governorate->name ?? '---' }} / {{ $craftsman->city }}</p>
            </div>
        </div>
        <div class="col-md-12">
            <div class="info-card">
                <p class="info-label"><i class="fas fa-id-card ms-1"></i> رقم الهوية (الرقم القومي)</p>
                <p class="info-value" style="letter-spacing: 2px;">{{ $craftsman->NationalNumber }}</p>
            </div>
        </div>
    </div>

    <!-- أزرار العمليات -->
    <div class="row g-3 justify-content-center">
        <div class="col-md-5">
            <a href="{{ route('index.allph', ['id'=>$craftsman->id]) }}" class="action-btn btn-documents shadow">
                <i class="fas fa-file-invoice"></i> عرض الأوراق الشخصية
            </a>
        </div>
        <div class="col-md-5">
            <a href="{{ route('subscription.history', ['id' => $craftsman->id]) }}" class="action-btn btn-history shadow">
                <i class="fas fa-history"></i> عرض سجل الاشتراكات
            </a>
        </div>
    </div>
</div>
@endsection
