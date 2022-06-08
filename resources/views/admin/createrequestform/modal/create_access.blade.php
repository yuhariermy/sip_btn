<!--begin: Modal Create Connection-->
<div class="modal fade" id="tambahAccess" role="dialog">
	<div class="modal-dialog">
        <form role="form" id="form-access" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="form_id" id="form_id" value="{{$form_id}}">

		<div class="modal-content">
				<div class="modal-header">
                    <h4 class="modal-title text-center">Access</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" style="overflow-y: auto; height: 300px">
					<div class="alert bg-danger text-white print-error-msg" style="display:none">
					<ul></ul>
				</div>
					<div class="panel panel-default">
						<div class="panel-body row">
							<div class="col-md-12">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type_access_id" class="form-control type_access_id">
                                        <option value="">-- Pilih Type --</option>
                                        @foreach ($type_accesses as $type_access)
                                            <option value="{{$type_access->id}}">{{$type_access->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
							</div>

                            <div class="col-md-12 wrapper_other" style="display: none">
                                <div class="form-group">
                                    <label>Others Comment</label>
                                    <input type="text" name="other" class="form-control other_comment" placeholder="Other Comment">
                                </div>
                            </div>
						</div>
					</div>
                    <div class="panel panel-default">
						<div class="panel-body">
							<div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="full_name" class="form-control" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Server Name</label>
                                        <input type="text" name="server_name" class="form-control" placeholder="Server Name">
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
                    <div class="panel panel-default">
						<div class="panel-body">
							<div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>DB Name</label>
                                        <input type="text" name="db_name" class="form-control" placeholder="DB Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>IP Address</label>
                                        <input type="text" name="source_ip_address" class="form-control" placeholder="Ip Address">
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="simpan_access" >Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
			</div>
		</div>
        </form>
	</div>
</div>
<!--end::Modal Create Connection-->
<!--end::Modal Create Connection-->
@push('js')
<!--begin::Page Vendors(used by this page)-->
<script src="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<!--begin::Page Scripts(used by this page)-->
<script>
$(document).ready(function(){
    $(".type_access_id").on('click', function(){
        let id  = $(this).val();

        if(id == 999) {
            $(".wrapper_other").show();
        } else {
            $(".wrapper_other").hide();
            $(".other_comment").val("");
        }
    });
    $("#form-access").on('submit', function(event){
        event.preventDefault();
        let data = $("#form-access").serialize();
        let form_id = $('#form_id').val();
        let url = '{{ route('detailaccess.store') }}';
        $("#simpan_access").text("Please wait...");
        $("#simpan_access").prop("disabled", true);
        setTimeout(function(){
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $("#simpan_access").text("Tambah    ");
                        $("#simpan_access").prop("disabled", false);
                        $("#tambahAccess").modal('hide');
                        swal('Selamat! Data Access Berhasil di Tambah', {
                            // buttons: true,
                            // timer: 1000,
                            icon: "success",
                        }).then((reload) => {
                            let url = '{{ route("create_request_form.edit", ":slug") }}';
                            url = url.replace(':slug', data.form_id);
                            window.location.href=url;
                        });
                    } else {
                        $("#simpan_access").text("Konfirmasi");
                        $("#simpan_access").prop("disabled", false);
                        printErrorMsg(data.error);
                    }
                },
            });
        }, 1000);
    });
    function printErrorMsg(msg) {
        $(".print-error-msg").removeClass("hidden");
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $(".modal-body").animate({scrollTop: 0}, "fast");
        $.each(msg, function(key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }
});
</script>
@endpush
