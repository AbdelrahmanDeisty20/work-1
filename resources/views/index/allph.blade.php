@extends('layout.tmp')
@section('title', 'معرض صور: ' . $craftsman->name)

@section('conntent')
<style>
    .image-card {
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        background: #fff;
        border: none;
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        height: 100%;
    }
    .image-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    .image-container {
        height: 350px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        cursor: pointer;
    }
    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .image-card:hover .image-container img {
        transform: scale(1.1);
    }
    .card-title-custom {
        background: linear-gradient(45deg, #525293, #9b9adb);
        color: white;
        padding: 10px;
        margin: 0;
        font-size: 1.1rem;
        font-weight: bold;
    }
    .gallery-header {
        margin-bottom: 40px;
        position: relative;
        padding-bottom: 15px;
    }
    .gallery-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: #525293;
        border-radius: 2px;
    }
</style>

<div class="container mt-4" dir="rtl">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('show-Craftsmen', [$craftsman->id]) }}" class="btn btn-dark rounded-circle shadow">
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="gallery-header text-center">
        <h2 class="fw-bold">معرض الصور للموظف: <span class="text-primary">{{ $craftsman->name }}</span></h2>
        <p class="text-muted">الصور المرفوعة في ملف الموظف</p>
    </div>

    <div class="row g-4 justify-content-center">
        {{-- الصورة الشخصية --}}
        <div class="col-lg-4 col-md-6">
            <div class="card image-card">
                <p class="card-title-custom text-center">الصورة الشخصية</p>
                <div class="image-container" onclick="window.open('{{ asset($craftsman->image) }}', '_blank')">
                    @if($craftsman->image)
                        <img src="{{ asset($craftsman->image) }}" alt="الصورة الشخصية">
                    @else
                        <div class="text-muted">لا توجد صورة شخصية</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- صورة البطاقة --}}
        <div class="col-lg-4 col-md-6">
            <div class="card image-card">
                <p class="card-title-custom text-center">صورة البطاقة</p>
                <div class="image-container" onclick="window.open('{{ asset($craftsman->imageA) }}', '_blank')">
                    @if($craftsman->imageA)
                        <img src="{{ asset($craftsman->imageA) }}" alt="صورة البطاقة">
                    @else
                        <div class="text-muted">لا توجد صورة للبطاقة</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- السجل التجاري --}}
        <div class="col-lg-4 col-md-6">
            <div class="card image-card">
                <p class="card-title-custom text-center">السجل التجاري</p>
                <div class="image-container" onclick="window.open('{{ asset($craftsman->imageB) }}', '_blank')">
                    @if($craftsman->imageB)
                        <img src="{{ asset($craftsman->imageB) }}" alt="السجل التجاري">
                    @else
                        <div class="text-muted">لا يوجد سجل تجاري</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
