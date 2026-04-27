@extends('layout.tmp')
@section('title,index')

@section('conntent')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-4">
    <div class="container mt-4 text-end">
        <form action="{{ route('store_cr') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 w-100">
                <label for="name" class="form-label W-100 text-end fs-3 fw-bold">الاسم</label>
                <input type="text" class="form-control text-end" id="name" name="name" placeholder="الاسم" required>
            </div>
    
            <div class="mb-3">
                <label for="phone" class="form-label fs-3 fw-bold">رقم الهاتف</label>
                <input type="text" class="form-control text-end" id="phone" name="phone" placeholder="أدخل رقم الهاتف" required>
            </div>
    
                <div class="mb-3">
                <label for="governorates_id" class="form-label fs-3 fw-bold">المحافظة</label>

                <select class="form-select text-end" id="governorates_id" name="governorates_id" required>
                    <option value="" selected>اختر المحافظة</option>
                    @foreach ($Governorates as $Governorate)
                        <option value="{{ $Governorate->id }}">{{ $Governorate->name }}</option>
                    @endforeach
                </select>
            </div>
            

            {{-- <div class="mb-3">
                <label for="governorates_id" class="form-label" style="font-size: 25px;">المحافظة</label>

                <input list="governorates_list" name="governorates_id" id="governorates_id" class="form-control" 
                    value="{{ $craftsman->Governorate->name ?? '' }}" placeholder="ابحث عن محافظة">
                
                <datalist id="governorates_list">
                    @foreach ($Governorates as $Governorate)
                        <option value="{{ $Governorate->name }}">
                    @endforeach
                </datalist>
            </div>
            --}}



            <div class="mb-3">
                <label for="city" class="form-label fs-3 fw-bold">المدينة</label>
                <input type="text" class="form-control text-end" id="city" name="city" placeholder="أدخل المدينة" required>
            </div>
    
            <div class="mb-3">
                <label for="category_id" class="form-label fs-3 fw-bold">الفئة</label>
                <select class="form-select text-end " id="category_id" name="category_id" required>
                    <option value="" selected>اختر الفئة</option>
                        <option value="{{ $Categories->id }}">{{ $Categories->name }}</option>
                </select>
            </div>
    
            <div class="mb-3">
                <label for="NationalNumber" class="form-label fs-3 fw-bold">الرقم القومي</label>
                <input type="text" class="form-control text-end " id="NationalNumber" name="NationalNumber" placeholder="أدخل الرقم القومي" required>
            </div>
    
            <div class="mb-3">
                <label for="startDate" class="form-label fs-3 fw-bold">تاريخ البدء</label>
                <input type="date" class="form-control text-end " id="startDate" name="startDate" required>
            </div>
    
            <div class="mb-3">
                <label for="image" class="form-label" style="font-size: 25px;">صوره </label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="imageA" class="form-label" style="font-size: 20px;"><strong>صوره البطاقه</strong> </label>
                <input type="file" class="form-control" id="imageA" name="imageA" accept="image/*">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>



            <div class="mb-3">
                <label for="imageB" class="form-label" style="font-size: 20px;"><strong>صوره السجل التجاري (إن وجد)</strong> </label>
                <input type="file" class="form-control" id="imageB" name="imageB" accept="image/*">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">إرسال</button>
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
            const btn = document.querySelector('button[type="submit"]');
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
                        progressStatus.innerText = `جاري ضغط الصور...`;
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
                        window.location.href = "{{ route('category.show', ['id' => $Categories->id]) }}";
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
                            const MAX_WIDTH = 1000;
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
                            canvas.toBlob((blob) => resolve(blob), 'image/jpeg', 0.6);
                        };
                    };
                });
            }
        });
    </script>

@endsection