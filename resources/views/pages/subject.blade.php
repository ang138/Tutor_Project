@extends('layouts.main_template')
@section('title')
    หน้าหลัก
@endsection
@section('content')

<div class="container pt-5">
    <h1>หาติวเตอร์</h1>
    <table>
        <thead>
            <tr>
                <th>วิชา</th>
                <th>สถานที่สอน</th>
                <th>วันเรียน</th>
                <th>รายละเอียด</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>john@example.com</td>
                <td>
                    <small class="text-muted"><center><a href="{{ url('detail') }}" class="btn-subject">รายละเอียด</a></center></small>
                </td>
            </tr>
            <!-- Add more rows with data here -->
        </tbody>
    </table>
</div>

@endsection
