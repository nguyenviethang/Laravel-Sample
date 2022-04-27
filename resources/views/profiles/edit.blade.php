   <!-- Modal -->
   <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <form action="{{ route('profile.save') }}" id="editForm" method="POST" enctype="multipart/form-data">
                   @csrf
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin cá nhân</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div id="success" class="alert alert-success" style="display:none"></div>
                   <div id="error" class="alert alert-danger" style="display:none">
                       <ul></ul>
                   </div>
                   <div class="modal-body">
                       <div class="container-fluid">
                           <div class="row g-6 align-items-center">
                               <div class="col-4">
                                   <label for="inputDOB" class="col-form-label">Ngày
                                       sinh</label>
                               </div>
                               <div class="col-8">
                                   <input type="date" id="inputDOB" class="form-control" name="birth_day"
                                       value="{{ date('Y-m-d', strtotime(Auth::user()->birth_day)) }}">
                               </div>
                           </div>
                           <div class="row g-6 align-items-center">
                               <div class="col-4">
                                   <label for="inputPhone" class="col-form-label">Số điện thoại</label>
                               </div>
                               <div class="col-8">
                                   <input type="text" id="inputPhone" class="form-control" name="phone"
                                       value="{{ Auth::user()->phone }}">
                               </div>
                           </div>
                           <div class="row g-6 align-items-center">
                               <div class="col-4">
                                   <label for="inputOldAvatar" class="col-form-label">Ảnh đại diện</label>
                               </div>
                               <input type="text" name="oldAvatar" value="{{ Auth::user()->avatar }}" hidden>
                           </div>
                           <div class="col-8">
                               <img src="{{ asset('images/UserAvatar/'. Auth::user()->avatar) }}" alt="" width="150"
                                   height="150">
                           </div>
                           <div class="row g-6 align-items-center">
                               <div class="col-4">
                                   <label for="inputAvatar" class="col-form-label">Tải ảnh mới</label>
                               </div>
                               <div class="col-8">
                                   <input type="file" id="inputAvatar" name="avatar">
                               </div>
                           </div>
                           <div class="col-8">
                               <img id="imagePreview" width="150" height="150" hidden>
                           </div>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                       <button type="submit" class="btn btn-primary saveButton">Lưu thay đổi</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
