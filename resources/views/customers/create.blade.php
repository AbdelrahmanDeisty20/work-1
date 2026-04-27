@extends('layout.tmp')
    @section('title', 'إضافة عميل جديد')
    
    @section('conntent')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
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
        <div class="mt-3 text-center">
            <h2>إضافة عميل جديد</h2>
        </div>

        <div class="card p-4 mt-3">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">الاسم</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="الاسم الكامل" required>
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">رقم الهاتف</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="رقم الهاتف" required>
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label for="governorate" class="form-label">المحافظة</label>
                        <select class="form-select" id="governorate" name="governorate" required>
                            <option value="">اختر المحافظة...</option>
                            @foreach($governorates as $gov)
                                <option value="{{ $gov->name }}">{{ $gov->name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">المدينة</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="المدينة" required>
                    </div>
            
                    <div class="col-md-12 mb-3">
                        <label for="service" class="form-label">الخدمة</label>
                        <input type="text" class="form-control" id="service" name="service" placeholder="نوع الخدمة المقدمة" required>
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label for="paid_amount" class="form-label">المبلغ المدفوع</label>
                        <input type="number" class="form-control" id="paid_amount" name="paid_amount" step="0.01" placeholder="0.00" required>
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label for="remaining_amount" class="form-label">المبلغ المتبقي</label>
                        <input type="number" class="form-control" id="remaining_amount" name="remaining_amount" step="0.01" placeholder="0.00">
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5" id="submitBtn">حفظ البيانات</button>
                    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary btn-lg px-5 ms-2">رجوع</a>
                </div>

                <div id="progressContainer" class="d-none mt-3">
                    <div class="progress" style="height: 25px;">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%">0%</div>
                    </div>
                    <p class="text-center mt-2 fw-bold" id="progressStatus">جاري حفظ البيانات...</p>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const btn = document.getElementById('submitBtn');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const progressStatus = document.getElementById('progressStatus');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                btn.disabled = true;
                progressContainer.classList.remove('d-none');
                
                const formData = new FormData(form);
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
                        window.location.href = "{{ route('customers.index') }}";
                    } else {
                        btn.disabled = false;
                        progressContainer.classList.add('d-none');
                        alert('حدث خطأ أثناء الحفظ. يرجى التأكد من البيانات.');
                    }
                };

                xhr.send(formData);
            });
        });
    </script>
    @endsection
