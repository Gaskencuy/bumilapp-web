<div class="modal fade" id="profileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profile Modal</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="" class="rounded-circle" alt="..." height="200">
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <input disabled type="text" value="{{ Auth::User()->name }}" class="form-control input-rounded"
                        placeholder="Input Rounded">
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input disabled type="text" value="{{ Auth::User()->username }}"
                        class="form-control input-rounded" placeholder="Input Rounded">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input disabled type="email" value="{{ Auth::User()->email }}" class="form-control input-rounded"
                        placeholder="Input Rounded">
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
