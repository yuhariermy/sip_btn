<!--begin: Modal Create Connection-->
<div class="modal fade" id="modal-editAccess" role="dialog">
	<div class="modal-dialog">
        <form role="form" method="POST" id="formEdit-access" enctype="multipart/form-data">
            @csrf
        <input type="hidden" name="form_id" id="form_id" value="{{$form_id}}">
        <input type="hidden" name="id">

		<div class="modal-content">
				<div class="modal-header">
                    <h4 class="modal-title text-center">Ubah Access</h4>
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
                                    <select name="type_access_id" id="type_access_id" class="form-control type_access_id">
                                        <option value="">-- Pilih Type --</option>
                                        @foreach ($type_accesses as $type_access)
                                            <option class="type_access_{{$type_access->id}}" value="{{$type_access->id}}">{{$type_access->name}}</option>
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
				<button type="submit" class="btn btn-primary" id="ubah_access" >Ubah</button>
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
$(document).on('click', '.editAccess', function() {
    $("#modal-editAccess").modal('show');
    $(".print-error-msg").addClass("hidden");

    $("#ubah_access").text("Ubah");
    $("#ubah_access").prop("disabled", false);
    var data = JSON.parse($(this).attr("data"));
    console.log(data.type_access.id);
    console.log(data.id);

    if(data.type_access.id == 3) {
        $(".wrapper_other").show();
    } else {
        $(".wrapper_other").hide();
    }

    $(".type_access_"+ data.type_access.id).attr("selected",true);
    $("input[name='full_name']").val(data.fullname);
    $("input[name='server_name']").val(data.server_name);
    $("input[name='other']").val(data.other);
    $("input[name='db_name']").val(data.db_name);
    $("input[name='source_ip_address']").val(data.ip_address);
    $("input[name='id']").val(data.id);
});
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

    $("#formEdit-access").on('submit', function(event){
        event.preventDefault();
        let data = $("#formEdit-access").serialize();

        let form_id = $('#form_id').val();
        let url = '{{ route('detailaccess.update') }}';

        Swal.fire({
            title: "Anda Yakin?",
            text: "Ingin mengubah data ini ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ubah",
            cancelButtonText: "Batal",
            reverseButtons: true,
            confirmButtonColor: '#d33',
        }).then(function (result) {
            $("#ubah_access").text("Please wait...");
            $("#ubah_access").prop("disabled", true);
            setTimeout(function(){
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $("#ubah_access").text("Tambah    ");
                            $("#ubah_access").prop("disabled", false);
                            $("#modal-editAccess").modal('hide');
                            swal('Selamat! Data Access Berhasil di Ubah', {
                                // buttons: true,
                                // timer: 1000,
                                icon: "success",
                            }).then((reload) => {
                                let url = '{{ route("create_request_form.edit", ":slug") }}';
                                url = url.replace(':slug', data.form_id);
                                window.location.href=url;
                            });
                        } else {
                            $("#ubah_access").prop("disabled", false);
                            printErrorMsg(data.error);
                        }
                    },
                });
            }, 1000);
        });
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
