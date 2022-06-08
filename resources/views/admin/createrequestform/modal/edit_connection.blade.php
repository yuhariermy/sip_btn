<!--begin: Modal Create Connection-->
<div class="modal fade" id="modal-editConnection" role="dialog">
	<div class="modal-dialog">
        <form role="form" id="formEdit-connection" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="form_id" id="form_id" value="{{$form_id}}">
            <input type="hidden" name="id">

		<div class="modal-content">
				<div class="modal-header">
                    <h4 class="modal-title text-center">Connection Request</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" style="overflow-y: auto; height: 450px">
					<div class="alert bg-danger text-white print-error-msg" style="display:none">
					<ul></ul>
				</div>
					<div class="panel panel-default">
						<div class="panel-body row">
							<div class="col-md-12">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type_connection_id" class="form-control type_connection_id">
                                        <option value="">-- Pilih Type --</option>
                                        @foreach ($type_connections as $type_connection)
                                            <option class="type_connection_{{$type_connection->id}}" value="{{$type_connection->id}}">{{$type_connection->name}}</option>
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
						<div class="panel-heading">
							<h2 class="panel-title">Source</h2>
						</div>
					</div>
                    <div class="panel panel-default">
						<div class="panel-body">
							<div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="source_name" class="form-control" placeholder="Full Name">
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
                    <div class="panel panel-default">
						<div class="panel-heading">
							<h2 class="panel-title">Destination</h2>
						</div>
					</div>
                    <div class="panel panel-default">
						<div class="panel-body">
							<div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="destination_name" class="form-control" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>IP Address</label>
                                        <input type="text" name="destination_ip_address" class="form-control" placeholder="Ip Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div style="display: flex;align-items:center;justify-content:center">
                                            <label>TCP</label>
                                            <input type="checkbox" name="tcp" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div style="display: flex;align-items:center;justify-content:center">
                                            <label>UDP</label>
                                            <input type="checkbox" name="udp" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Port</label>
                                        <input type="text" name="port" class="form-control" placeholder="Port">
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="ubah_connection" >Ubah</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
			</div>
		</div>
        </form>
	</div>
</div>
<!--end::Modal Create Connection-->
@push('js')
<!--begin::Page Vendors(used by this page)-->
<script src="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<!--begin::Page Scripts(used by this page)-->
<script>
$(document).on('click', '.editConnection', function() {
    $("#modal-editConnection").modal('show');
    $(".print-error-msg").addClass("hidden");

    $("#ubah_connection").text("Ubah");
    $("#ubah_connection").prop("disabled", false);
    var data = JSON.parse($(this).attr("data"));

    if(data.type_connection.id == 999) {
        $(".wrapper_other").show();
    } else {
        $(".wrapper_other").hide();
    }

    $(".type_connection_"+ data.type_connection.id).attr("selected",true);
    if(data.udp == 'Y') {
        $("input[name='udp']").val(data.udp).attr("checked",true);
    } else {
        $("input[name='udp']").val(data.udp).attr("checked",false);
    }

    if(data.tcp == 'Y') {
        $("input[name='tcp']").val(data.tcp).attr("checked",true);
    } else {
        $("input[name='tcp']").val(data.tcp).attr("checked",false);
    }

    $("input[name='source_name']").val(data.source_name);
    $("input[name='source_ip_address']").val(data.source_ip_address);
    $("input[name='other']").val(data.other);
    $("input[name='destination_name']").val(data.destination_name);
    $("input[name='destination_ip_address']").val(data.destination_ip_address);
    $("input[name='port']").val(data.port);
    $("input[name='id']").val(data.id);
});
$(document).ready(function(){
    $("#formEdit-connection").on('submit', function(event){
        event.preventDefault();
        let data = $("#formEdit-connection").serialize();
        let form_id = $('#form_id').val();
        let url = '{{ route('detailconnection.update') }}';
        $("#ubah_connection").text("Please wait...");
        $("#ubah_connection").prop("disabled", true);
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
            setTimeout(function(){
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $("#ubah_connection").prop("disabled", false);
                            $("#tambahConnection").modal('hide');
                            swal('Selamat! Data Connection Berhasil di Tambah', {
                                // buttons: true,
                                // timer: 1000,
                                icon: "success",
                            }).then((reload) => {
                                let url = '{{ route("create_request_form.edit", ":slug") }}';
                                url = url.replace(':slug', data.form_id);
                                window.location.href=url;
                            });
                        } else {
                            $("#ubah_connection").prop("disabled", false);
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
