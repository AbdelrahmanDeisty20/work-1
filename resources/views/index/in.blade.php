@extends('layout.tmp')

@section('conntent')
<div class="container mt-5">
    <h2 class="mb-4 text-center">📊 لوحة التحكم</h2>

    <div class="row g-4">
        <!-- عدد المحافظات -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow rounded-4">
                <div class="card-body text-center">
                    <h1>🗺️</h1>
                    <h5 class="card-title">عدد المحافظات</h5>
                    <p class="card-text fs-4">{{ $allGovernorates }}</p>
                </div>
            </div>
        </div>

        <!-- عدد الأقسام -->
        <div class="col-md-4">
            <div class="card text-white bg-success shadow rounded-4">
                <div class="card-body text-center">
                    <h1>🏢</h1>
                    <h5 class="card-title">عدد الأقسام</h5>
                    <p class="card-text fs-4">{{ $allCategories }}</p>
                </div>
            </div>
        </div>

        <!-- عدد الموظفين -->
        <div class="col-md-4">
            <div class="card text-white bg-info shadow rounded-4">
                <div class="card-body text-center">
                    <h1>👥</h1>
                    <h5 class="card-title">عدد الموظفين</h5>
                    <p class="card-text fs-4">{{ $allEmployees }}</p>
                </div>
            </div>
        </div>

        <!-- الاشتراكات المنتهية -->
        <div class="col-md-6">
            <div class="card text-white bg-danger shadow rounded-4">
                <div class="card-body text-center">
                    <h1>⛔</h1>
                    <h5 class="card-title">الاشتراكات المنتهية</h5>
                    <p class="card-text fs-4">{{ $expiredEmployeesCount }}</p>
                    <small>آخر تحديث: {{ now()->format('Y-m-d H:i') }}</small>
                </div>
            </div>
        </div>

        <!-- الاشتراكات التي ستنتهي خلال أسبوع -->
        <div class="col-md-6">
            <div class="card text-white bg-warning shadow rounded-4">
                <div class="card-body text-center">
                    <h1>⌛</h1>
                    <h5 class="card-title">ستنتهي خلال أسبوع</h5>
                    <p class="card-text fs-4">{{ $expiringInOneWeek }}</p>
                    <small>آخر تحديث: {{ now()->format('Y-m-d H:i') }}</small>
                </div>
            </div>
        </div>

        <!-- عدد العملاء -->
        <div class="col-md-12">
            <div class="card text-white bg-dark shadow rounded-4">
                <div class="card-body text-center">
                    <h1>💳</h1>
                    <h5 class="card-title">إجمالي العملاء</h5>
                    <p class="card-text fs-4">{{ $allCustomers }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection