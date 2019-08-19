<div class="modal fade" id="profile-photo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="border-radius: 5px">
            <div class="modal-body" style="padding: 30px">
                <form method="post" action="{{ route('store.employee.profile.uploadpic', compact('employee')) }}" enctype="multipart/form-data">
                    <img src="{{ $employee->profilePhoto() }}" class="profile-user-img img-responsive img-circle" alt="jigs" style="width: 200px;" > 
                    <div class="form-group" style="padding: 10px 20px">
                        <label>Upload Photo</label>
                        <input type="file" name="photo" id="photo-input">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Upload Photo</button>
                </form>
            </div>
            <div class="modal-footer" style="border: 0; padding: 0;">
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

@push('js')
<script type="text/javascript">
    $(function(){
        photo_modal = $('#profile-photo');
        photo_modal.find('#photo-input').on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    photo_modal.find('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        })
    });
</script>
@endpush