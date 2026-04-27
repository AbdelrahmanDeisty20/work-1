@extends('layout.tmp')
    @section('title', 'إضافة صاحب حرفة')
    
    @section('conntent')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    
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
    </style>

    <div class="container mt-4" dir="rtl">
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
        <div class="mt-3 text-center">
            <h2>إضافة صاحب حرفة جديد</h2>
        </div>

            <div class="card p-4">
                <div class="row">
                    <!-- المعلومات الأساسية -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">الاسم</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="الاسم الكامل" required>
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">رقم الهاتف</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="أدخل رقم الهاتف" required>
                    </div>
            
                    <div class="col-md-4 mb-3">
                        <label for="governorates_id" class="form-label">المحافظة</label>
                        <select class="form-select" id="governorates_id" name="governorates_id" required>
                            <option value="" selected>اختر المحافظة</option>
                            @foreach ($Governorates as $Governorate)
                                <option value="{{ $Governorate->id }}">{{ $Governorate->name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="col-md-4 mb-3">
                        <label for="city" class="form-label">المدينة</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="أدخل المدينة" required>
                    </div>
            
                    <div class="col-md-4 mb-3">
                        <label for="category_id" class="form-label">الفئة</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" selected>اختر الفئة</option>
                            @foreach ($Categories as $Category)
                                <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label for="NationalNumber" class="form-label">الرقم القومي</label>
                        <input type="text" class="form-control" id="NationalNumber" name="NationalNumber" placeholder="أدخل 14 رقم" required maxlength="14">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="subscription_status" class="form-label">حالة الاشتراك</label>
                        <select class="form-select" id="subscription_status" name="subscription_status">
                            <option value="مشترك">مشترك</option>
                            <option value="غير مشترك" selected>غير مشترك</option>
                        </select>
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label for="startDate" class="form-label">تاريخ الاشتراك</label>
                        <input type="text" class="form-control" id="startDate" name="startDate" placeholder="اختر تاريخ الاشتراك" required>
                    </div>

                    <hr class="my-4">
                    <h4 class="mb-3">الصور والوثائق</h4>

                    <div class="col-md-4 mb-3">
                        <label for="image" class="form-label">الصورة الشخصية</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
            
                    <div class="col-md-4 mb-3">
                        <label for="imageA" class="form-label">صورة البطاقة</label>
                        <input type="file" class="form-control" id="imageA" name="imageA" accept="image/*">
                        @error('imageA') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
            
                    <div class="col-md-4 mb-3">
                        <label for="imageB" class="form-label">السجل التجاري (اختياري)</label>
                        <input type="file" class="form-control" id="imageB" name="imageB" accept="image/*">
                        @error('imageB') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">حفظ البيانات</button>
                </div>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#startDate", {
                dateFormat: "Y-m-d",
                defaultDate: "today"
            });
        });
    </script>
    @endsection
    

