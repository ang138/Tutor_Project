@extends('layouts.tutor_template')
@section('title')
    ติดต่อเรา
@endsection
@section('content')
<div class="container pt-5">
    <h1 style="text-align: center; font-weight: bold;">รายชื่อผู้ลงทะเบียนในวิชา</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>อีเมล</th>
                    <!-- Add more user-related columns here -->
                </tr>
            </thead>
            <tbody>
                @foreach ($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->cus_name }}</td>
                        <td>{{ $enrollment->cus_surname }}</td>
                        <td>{{ $enrollment->cus_email }}</td>
                        <!-- Add more user-related data here -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
