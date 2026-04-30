@extends('layout.tmp')
@section('title,index')

@section('conntent')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<div class="container mt-4">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container mt-4">
        <form action="{{ route('update_cr', ['id' => $craftsman->id]) }}" method="POST"  enctype="multipart/form-data"dir="rtl">
            @csrf  
            @method('PUT') 
            
            <div class="mb-3">
                <label for="name" class="form-label" style="font-size: 25px;">الاسم</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="الاسم" value="{{ $craftsman->name }}">
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label" style="font-size: 25px;">الفئة</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="{{ $craftsman->Category->id ?? '' }}" selected>
                        {{ $craftsman->Category ? $craftsman->Category->name : 'لا يوجد فئة' }}
                    </option>
                    @foreach ($Categories as $Category)
                        <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label" style="font-size: 25px;">رقم الهاتف</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="أدخل رقم الهاتف" value="{{ $craftsman->phone }}">
            </div>


            <div class="mb-3">
                <label for="governorates_id" class="form-label" style="font-size: 25px;">المحافظة</label>
                <select class="form-select" id="governorates_id" name="governorates_id">
                    <option value="{{ $craftsman->Governorate->id ?? '' }}" selected>
                        {{ $craftsman->Governorate ? $craftsman->Governorate->name : 'لا يوجد محافظة' }}
                    </option>
                    @foreach ($Governorates as $Governorate)
                        <option value="{{ $Governorate->id }}">{{ $Governorate->name }}</option>
                    @endforeach
                </select>
            </div>
    
            
            <div class="mb-3">
                <label for="city" class="form-label" style="font-size: 25px;">المدينة</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="أدخل المدينة" value="{{ $craftsman->city }}">
            </div>
         
            
            <div class="mb-3">
                <label for="NationalNumber" class="form-label" style="font-size: 25px;">الرقم القومي</label>
                <input type="text" class="form-control" id="NationalNumber" name="NationalNumber" placeholder="أدخل الرقم القومي" value="{{ old('NationalNumber', $craftsman->NationalNumber) }}" maxlength="14">
                @error('NationalNumber') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="startDate" class="form-label" style="font-size: 25px;">تاريخ الاشتراك</label>
                <input type="text" class="form-control" id="startDate" name="startDate" value="{{ $craftsman->dates()->first() ? $craftsman->dates()->first()->startDate : '' }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label" style="font-size: 25px;">الصورة الحالية</label>
                @if($craftsman->image)
                    <div class="mb-2">
                        <img src="{{ asset($craftsman->image) }}" alt="صورة الحرفي" style="max-width: 200px; max-height: 200px;">
                    </div> 
                @else
                    <p>لا توجد صورة حالياً.</p>
                @endif
                <label for="image" class="form-label" style="font-size: 25px;">تحميل صورة جديدة</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            

        <!-- حقل صورة A -->
        <div class="mb-3">
            <label for="imageA" class="form-label" style="font-size: 25px;">صورة البطاقه</label>
            @if($craftsman->imageA)
                <div class="mb-2">
                    <img src="{{ asset($craftsman->imageA) }}" alt="صورة A" style="max-width: 200px; max-height: 200px;">
                </div>
            @else
                <p>لا توجد صورة A حالياً.</p>
            @endif
            <label for="imageA" class="form-label" style="font-size: 25px;"> تحميل صورة </label>
            <input type="file" class="form-control" id="imageA" name="imageA" accept="image/*">
            @error('imageA')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- حقل صورة B -->
        <div class="mb-3">
            <label for="imageB" class="form-label" style="font-size: 25px;">صورة السجل التجاري (إن وجد)</label>
            @if($craftsman->imageB)
                <div class="mb-2">
                    <img src="{{ asset($craftsman->imageB) }}" alt="صورة B" style="max-width: 200px; max-height: 200px;">
                </div>
            @else
                <p>لا توجد صورة B حالياً.</p>
            @endif
            <label for="imageB" class="form-label" style="font-size: 25px;">تحميل صورة </label>
            <input type="file" class="form-control" id="imageB" name="imageB" accept="image/*">
            @error('imageB')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

            <div id="progressContainer" class="d-none mt-3">
                <div class="progress" style="height: 25px;">
                    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%">0%</div>
                </div>
                <p class="text-center mt-2 fw-bold" id="progressStatus">جاري معالجة البيانات...</p>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg px-5">حفظ التعديلات</button>
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

                progressStatus.innerText = 'جاري حفظ التعديلات الآن...';
                
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
                        window.location.href = "{{ route('category.show', ['id' => $craftsman->category_id]) }}";
                    } else if (xhr.status === 422) {
                        btn.disabled = false;
                        progressContainer.classList.add('d-none');
                        const response = JSON.parse(xhr.responseText);
                        let errorMsg = 'يرجى التأكد من البيانات:\n';
                        for (let field in response.errors) {
                            errorMsg += `- ${response.errors[field][0]}\n`;
                        }
                        alert(errorMsg);
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