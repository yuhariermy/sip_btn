<script>
    $('.kategori_id').on('change', function(){
       let kategori_id = $(this).val();
       if(kategori_id == 1) {
            $(".pihak_pertama").html("<option value='2'>Fachruddin – Mgr. Asset Mgt. & GA </option>");
       } else if (kategori_id == 2) {
            $(".pihak_pertama").html("<option value='1'>M. Jati Naqosho – Mgr. WH Mgt. & Distribution</option>");
       } else if (kategori_id == 3) {
            $(".pihak_pertama").html("<option value='3'>Erwin Aziz – Mgr. NTE Management & Bussines Assurance</option>");
        }
    });
</script>