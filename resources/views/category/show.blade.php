@extends('layout.tmp')
@section('conntent')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- css style file !!!--}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> 
</head>
<div class="container mt-1">
    <div class="my-4">
        <a href="{{route('index_category') }}">
        <button class="btn-dark btn">
            <i class="fa-solid fa-angles-left"></i>
        </button>
    </a>
    </div>
<div class="container mt-1">
    <div dir="rtl">
        <h1 style="color: #3e4144;">المهنة: {{ $category->name }}</h1>
        <br>
        <div class="container mt-1">
            <a href="{{ route('create_cr',[$category->id]) }}"> 
                <button class="btn btn-secondary btn-sm">إنشاء</button>
            </a>
        </div>

        @if ($category->employees->isEmpty())
            <p style="color: #1b1a1a;">لا يوجد موظفون يعملون في هذه المهنة.</p>
        @else
            <table class="table table-bordered table-striped" style="width: 90%; color: #131316; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #6f87c2; color: #fff;">
                        <th class="text-center" style="padding: 10px;">العمليات</th>
                        <th class="text-center" style="padding: 10px;">هاتف الموظف</th>
                        <th class="text-center" style="padding: 10px;">تاريخ انتهاء الاشتراك</th>
                        <th class="text-center" style="padding: 10px;">تاريخ بداية الاشتراك</th>
                        <th class="text-center" style="padding: 10px;">التخصص</th>
                        <th class="text-center" style="padding: 10px;">اسم الموظف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->employees as $employee)
                        <tr>
                            <td class="text-center" style="padding: 10px;">
                                <a href="{{ route('show-Craftsmen', [$employee->id]) }}" style="text-decoration: none; margin: 0;">
                                    <button class="btn btn-secondary btn-sm" style="margin: 0; padding: 5px 10px;">عرض</button>
                                </a>
                                <a href="{{ route('edit_cr', [$employee->id]) }}" style="text-decoration: none; margin: 0;">
                                    <button class="btn btn-success btn-sm" style="margin: 0; padding: 5px 10px;">تعديل</button>
                                </a>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $employee->id }}" data-name="{{ $employee->name }}">حذف</button>
                            </td>
                            <td class="text-center" style="padding: 10px;">{{ $employee->phone }}</td>
                            <td class="text-center" style="padding: 10px;">{{ $employee->dates()->first() ? $employee->dates()->first()->endDate : '---' }}</td>
                            <td class="text-center" style="padding: 10px;">{{ $employee->dates()->first() ? $employee->dates()->first()->startDate : '---' }}</td>
                            <td class="text-center" style="padding: 10px;">{{ $category->name }}</td>
                            <td class="text-center" style="padding: 10px;">{{ $employee->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                
                if (confirm(`هل أنت متأكد من حذف الموظف "${name}"؟`)) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('DELETE', `/destroy-cr/${id}`, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    
                    xhr.onload = function() {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            location.reload();
                        } else {
                            alert('حدث خطأ أثناء الحفظ.');
                        }
                    };
                    
                    xhr.send();
                }
            });
        });
    });
</script>

@endsection
