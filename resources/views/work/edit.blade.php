@extends('layout.tmp')
@section('title', 'تعديل بيانات صاحب الحرفة')

@section('conntent')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
    .form-label {
        font-weight: bold;
        color: #333;
    }
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .current-img {
        max-width: 150px;
        border-radius: 10px;
        border: 2px solid #eee;
        margin-bottom: 10px;
    }
</style>

<div class="container mt-4" dir="rtl">
    <form action="{{ route('update', ['id' => $craftsman->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mt-3 d-flex align-items-center">
            <a href="{{ route('index') }}" class="btn btn-outline-secondary me-3">
                <i class="fa-solid fa-angles-right"></i>
            </a>
            <h2 class="mb-0">تعديل: {{ $craftsman->name }}</h2>
        </div>

        <div class="card p-4">
            <div class="row">
                <!-- المعلومات الأساسية -->
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="الاسم الكامل" value="{{ $craftsman->name }}" required>
                </div>
        
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="أدخل رقم الهاتف" value="{{ $craftsman->phone }}" required>
                </div>
        
                <div class="col-md-4 mb-3">
                    <label for="governorates_id" class="form-label">المحافظة</label>
                    <select class="form-select" id="governorates_id" name="governorates_id" required>
                        @foreach ($Governorates as $Governorate)
                            <option value="{{ $Governorate->id }}" {{ ($craftsman->governorates_id == $Governorate->id) ? 'selected' : '' }}>
                                {{ $Governorate->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <div class="col-md-4 mb-3">
                    <label for="city" class="form-label">المدينة</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="أدخل المدينة" value="{{ $craftsman->city }}" required>
                </div>
        
                <div class="col-md-4 mb-3">
                    <label for="category_id" class="form-label">الفئة</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        @foreach ($Categories as $Category)
                            <option value="{{ $Category->id }}" {{ ($craftsman->category_id == $Category->id) ? 'selected' : '' }}>
                                {{ $Category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <div class="col-md-6 mb-3">
                    <label for="NationalNumber" class="form-label">الرقم القومي</label>
                    <input type="text" class="form-control" id="NationalNumber" name="NationalNumber" placeholder="أدخل 14 رقم" value="{{ $craftsman->NationalNumber }}" required maxlength="14">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="subscription_status" class="form-label">حالة الاشتراك</label>
                    <select class="form-select" id="subscription_status" name="subscription_status">
                        <option value="مشترك" {{ $craftsman->subscription_status == 'مشترك' ? 'selected' : '' }}>مشترك</option>
                        <option value="غير مشترك" {{ $craftsman->subscription_status == 'غير مشترك' ? 'selected' : '' }}>غير مشترك</option>
                    </select>
                </div>
        
                <div class="col-md-6 mb-3">
                    <label for="startDate" class="form-label">تاريخ الاشتراك</label>
                    @php
                        $subscription = $craftsman->dates->first();
                    @endphp
                    <input type="text" class="form-control" id="startDate" name="startDate" 
                           value="{{ $subscription ? \Carbon\Carbon::parse($subscription->startDate)->format('Y-m-d') : '' }}" required>
                </div>

                <hr class="my-4">
                <h4 class="mb-3">الصور والوثائق</h4>

                <div class="col-md-4 mb-3">
                    <label class="form-label d-block">الصورة الشخصية</label>
                    @if($craftsman->image)
                        <img src="{{ asset($craftsman->image) }}" class="current-img d-block">
                    @endif
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
        
                <div class="col-md-4 mb-3">
                    <label class="form-label d-block">صورة البطاقة</label>
                    @if($craftsman->imageA)
                        <img src="{{ asset($craftsman->imageA) }}" class="current-img d-block">
                    @endif
                    <input type="file" class="form-control" id="imageA" name="imageA" accept="image/*">
                </div>
        
                <div class="col-md-4 mb-3">
                    <label class="form-label d-block">السجل التجاري (اختياري)</label>
                    @if($craftsman->imageB)
                        <img src="{{ asset($craftsman->imageB) }}" class="current-img d-block">
                    @endif
                    <input type="file" class="form-control" id="imageB" name="imageB" accept="image/*">
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg px-5" id="submitBtn">
                    <span class="spinner-border spinner-border-sm d-none" id="loader" role="status" aria-hidden="true"></span>
                    <span id="btnText">حفظ التعديلات</span>
                </button>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#startDate", {
            dateFormat: "Y-m-d"
        });

        const form = document.querySelector('form');
        const btn = document.getElementById('submitBtn');
        const loader = document.getElementById('loader');
        const btnText = document.getElementById('btnText');

        form.addEventListener('submit', function() {
            btn.disabled = true;
            loader.classList.remove('d-none');
            btnText.innerText = 'جاري الحفظ...';
        });
    });
</script>
@endsection
