@extends('layouts.admin_template')

@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">ข้อมูลรูปภาพ</h1>

        <!-- แสดงข้อความแจ้งเตือน -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <!-- Add an "onclick" event to trigger the add data form -->
            <button class="btn" onclick="toggleAddForm()"><i class="fa fa-plus"></i> เพิ่มข้อมูลรูปภาพ</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ชื่อรูป</th>
                    <th>รูป</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($images as $image)
                    <tr>
                        <td>{{ $image->image_name }}</td>
                        <td><img src="{{ asset($image->image_path) }}" alt="{{ $image->image_name }}" width="150"></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="First group">
                                <!-- Add an "onclick" event to trigger the edit form -->
                                <button class="btn btn-sm"
                                    onclick="toggleEditForm('{{ $image->id }}', '{{ $image->image_name }}', '{{ $image->image_path }}')"><i
                                        class="fa fa-edit"></i></button>
                            </div>
                            <div class="btn-group" role="group" aria-label="Second group">
                                <form action="{{ route('admin.image.delete', ['id' => $image->id]) }}" method="POST"
                                    onsubmit="return confirm('ยืนยันการลบรูปภาพ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background-color: red"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <!-- Edit form for each image (initially hidden) -->
                            <div id="editForm{{ $image->id }}" style="display: none;">
                                <div class="card mb-6">
                                    <div class="card-header">
                                        <h5 class="card-title center">แก้ไขข้อมูลรูปภาพ</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="card col-md-8 mx-auto" style="border: 1;">
                                            <form action="{{ route('admin.image.update', ['id' => $image->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <!-- Edit fields for image details -->
                                                <div class="form-group">
                                                    <label for="edit_image_name{{ $image->id }}">ชื่อรูปภาพ:</label>
                                                    <input type="text" class="form-control"
                                                        id="edit_image_name{{ $image->id }}" name="image_name"
                                                        value="{{ $image->image_name }}" required>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="current_image{{ $image->id }}">รูปปัจจุบัน:</label>
                                                    <img src="{{ asset($image->image_path) }}" alt="{{ $image->image_name }}"
                                                        width="100">
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="image_file">อัปโหลดรูปภาพใหม่ (หากต้องการแทนที่):</label>
                                                    <input type="file" class="form-control-file" id="image_file"
                                                        name="image_path" value="{{ $image->image_path }}"
                                                        accept="image/*">
                                                </div>

                                                <!-- You can add more fields for editing other image details here -->

                                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>

        <!-- Edit form for each image (initially hidden) -->
        {{-- @foreach ($images as $image)
            <div id="editForm{{ $image->id }}" style="display: none;">
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-title center">แก้ไขข้อมูลรูปภาพ</h5>
                    </div>
                    <div class="card-body">
                        <div class="card col-md-8 mx-auto" style="border: 1;">
                            <form action="{{ route('admin.image.update', ['id' => $image->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Edit fields for image details -->
                                <div class="form-group">
                                    <label for="edit_image_name{{ $image->id }}">ชื่อรูปภาพ:</label>
                                    <input type="text" class="form-control" id="edit_image_name{{ $image->id }}"
                                        name="edit_image_name" value="{{ $image->image_name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="current_image{{ $image->id }}">รูปปัจจุบัน:</label>
                                    <img src="{{ asset($image->image_path) }}" alt="{{ $image->image_name }}"
                                        width="100">
                                </div>
                                <div class="form-group">
                                    <label for="image_file">อัปโหลดรูปภาพใหม่ (หากต้องการแทนที่):</label>
                                    <input type="file" class="form-control-file" id="image_file" name="image_path"
                                        accept="image/*">
                                </div>

                                <!-- You can add more fields for editing other image details here -->

                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach --}}


        <!-- Add data form (initially hidden) -->
        <div id="addForm" style="display: none;">
            <h2>เพิ่มข้อมูลรูปภาพ</h2>
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="image_name">ชื่อรูปภาพ:</label>
                    <input type="text" class="form-control" id="image_name" name="image_name" required>
                </div>

                <div class="form-group">
                    <label for="image_file">เลือกไฟล์รูปภาพ:</label>
                    <input type="file" class="form-control-file" id="image_file" name="image_path" accept="image/*"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">บันทึก</button>
            </form>
        </div>
    </div>


    <script>
        let activeEditFormId = null; // Track the active edit form

        function toggleEditForm(imageId, imageName, imagePath) {
            const editForm = document.getElementById(`editForm${imageId}`);

            if (activeEditFormId === imageId) {
                // If the clicked form is already open, close it
                editForm.style.display = 'none';
                activeEditFormId = null;
            } else {
                // Hide the currently active edit form (if any)
                if (activeEditFormId) {
                    const activeEditForm = document.getElementById(`editForm${activeEditFormId}`);
                    if (activeEditForm) {
                        activeEditForm.style.display = 'none';
                    }
                }

                // Show the clicked form
                editForm.style.display = 'block';
                activeEditFormId = imageId;

                // Set image name and display the current image
                document.getElementById(`edit_image_name${imageId}`).value = imageName;
                const currentImage = document.getElementById(`current_image${imageId}`);
                currentImage.src = imagePath;
                currentImage.style.display = 'block';
            }
        }

        function toggleAddForm() {
            // Hide the currently active edit form (if any)
            if (activeEditFormId) {
                const activeEditForm = document.getElementById(`editForm${activeEditFormId}`);
                if (activeEditForm) {
                    activeEditForm.style.display = 'none';
                    activeEditFormId = null;
                }
            }

            // Toggle the add data form
            const addForm = document.getElementById('addForm');
            if (addForm) {
                if (addForm.style.display === 'block') {
                    addForm.style.display = 'none';
                } else {
                    addForm.style.display = 'block';

                    // Scroll to the add data form
                    addForm.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        }
    </script>
@endsection
