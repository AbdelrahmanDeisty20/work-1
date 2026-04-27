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
                    <button type="submit" class="btn btn-primary btn-lg px-5" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none" id="loader" role="status" aria-hidden="true"></span>
                        <span id="btnText">حفظ البيانات</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <div id="progressContainer" class="d-none mt-3">
        <div class="progress" style="height: 25px;">
            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%">0%</div>
        </div>
        <p class="text-center mt-2 fw-bold" id="progressStatus">جاري معالجة البيانات...</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#startDate", {
                dateFormat: "Y-m-d",
                defaultDate: "today"
            });

            const form = document.querySelector('form');
            const btn = document.getElementById('submitBtn');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const progressStatus = document.getElementById('progressStatus');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                btn.disabled = true;
                progressContainer.classList.remove('d-none');
                
                const formData = new FormData(form);
                const imageInputs = ['image', 'imageA', 'imageB'];
                
                for (const inputName of imageInputs) {
                    const fileInput = document.getElementById(inputName);
                    if (fileInput && fileInput.files[0]) {
                        progressStatus.innerText = `جاري ضغط الصور لسرعة الرفع...`;
                        const compressedBlob = await compressImage(fileInput.files[0]);
                        formData.set(inputName, compressedBlob, fileInput.files[0].name);
                    }
                }

                progressStatus.innerText = 'جاري الرفع الآن...';
                
                const xhr = new XMLHttpRequest();
                xhr.open('POST', form.action, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        const percent = Math.round((e.loaded / e.total) * 100);
                        progressBar.style.width = percent + '%';
                        progressBar.innerText = percent + '%';
                    }
                };

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        window.location.href = "{{ route('index') }}";
                    } else {
                        btn.disabled = false;
                        progressContainer.classList.add('d-none');
                        alert('حدث خطأ أثناء الحفظ. يرجى التأكد من البيانات أو حجم الصور.');
                    }
                };

                xhr.send(formData);
            });

            async function compressImage(file) {
                return new Promise((resolve) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = (event) => {
                        const img = new Image();
                        img.src = event.target.result;
                        img.onload = () => {
                            const canvas = document.createElement('canvas');
                            let width = img.width;
                            let height = img.height;
                            const MAX_WIDTH = 1000; // صغرنا الحجم أكتر للسرعة
                            const MAX_HEIGHT = 1000;

                            if (width > height) {
                                if (width > MAX_WIDTH) {
                                    height *= MAX_WIDTH / width;
                                    width = MAX_WIDTH;
                                }
                            } else {
                                if (height > MAX_HEIGHT) {
                                    width *= MAX_HEIGHT / height;
                                    height = MAX_HEIGHT;
                                }
                            }

                            canvas.width = width;
                            canvas.height = height;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0, width, height);
                            canvas.toBlob((blob) => resolve(blob), 'image/jpeg', 0.6); // جودة 60% ممتازة جداً للموبايل
                        };
                    };
                });
            }
        });
    </script>
    @endsection
    

