   // kondisi awal checking

    if ($("#aset_tipe").val() == 1) {
            $("#row15").removeClass("hidden")
    } else {
        $("#row15").addClass("hidden")

    }

    if ($("#aset_kode_nontan").val() == 8) {
            $("#alat_angkut_row").removeClass("hidden")
    } else {
        $("#alat_angkut_row").addClass("hidden")

    }

    if ($("#aset_jenis").val() == 1) {
        $("#aset_kode_tanaman").removeClass("hidden")
        $("#aset_kode_nontan").addClass("hidden")
        $("#aset_kode_kayu").addClass("hidden")
        $("#row7").removeClass("hidden")
        $("#sistem_tanam_row").removeClass("hidden")
        $("#foto_aset5_col").removeClass("hidden")
        $("#aset_luas_tanaman_col").removeClass("hidden")
        $("#row8").addClass("hidden")
        $("#row10").addClass("hidden")
        $("#row11").addClass("hidden")
        $("#aset_luas_nontan_col").addClass("hidden")
        $("#satuan-luas").addClass("hidden")

    } else if ($("#aset_jenis").val() == 2){

        $("#aset_kode_tanaman").addClass("hidden")
        $("#aset_kode_nontan").removeClass("hidden")
        $("#aset_kode_kayu").addClass("hidden")
        $("#sistem_tanam_row").addClass("hidden")
        $("#foto_aset5_col").addClass("hidden")
        $("#aset_luas_nontan_col").removeClass("hidden")
        $("#row9").addClass("hidden")
        $("#row12").addClass("hidden")
        console.log($("#row12").addClass("hidden"))
        $("#row13").addClass("hidden")
        $("#row11").removeClass("hidden")
        $("#row10").removeClass("hidden")
        $("#aset_luas_tanaman_col").addClass("hidden")
        $("#satuan_luas").removeClass("hidden")


    } else {
        $("#aset_kode_tanaman").addClass("hidden")
        $("#aset_kode_kayu").removeClass("hidden")
        $("#aset_kode_nontan").addClass("hidden")
        $("#sistem_tanam_row").removeClass("hidden")
        $("#row7").removeClass("hidden")
        $("#foto_aset5_col").removeClass("hidden")
        $("#aset_luas_nontan_col").removeClass("hidden")
        $("#row8").addClass("hidden")
        $("#aset_luas_tanaman_col").addClass("hidden")
        $("#row10").addClass("hidden")
        $("#row11").addClass("hidden")
        $("#satuan-luas").removeClass("hidden")
    }

    if ($("#aset_kondisi").val() == 1) {
        $("#row6").addClass("hidden")
    } else {
        $("#row6").removeClass("hidden")

    }

    if($("#sistem_tanam").val() == 1){
            if ($("#aset_kode").val() != 22) {
                $("#row12").removeClass("hidden")
                $("#row13").removeClass("hidden")
            } else {
                $("#row12").addClass("hidden")
                $("#row13").addClass("hidden")
            }
    }

    else {
        $("#row12").addClass("hidden")
        $("#row13").addClass("hidden")
    }


    $("#aset_tipe").change(function (e) {
        if (e.target.value == 1) {
            $("#row15").removeClass("hidden")
        } else {

            $("#row15").addClass("hidden")
        }
    })

    $("#aset_jenis").change(function (e) {
        if (e.target.value == 1) {
            // aset kode
            $("#aset_kode_tanaman").removeClass("hidden")
            $("#aset_kode_kayu").addClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")
            $("#sistem_tanam_row").removeClass("hidden")
            $("#row7").removeClass("hidden")
            $("#row9").removeClass("hidden")
            $("#foto_aset5_col").removeClass("hidden")
            $("#aset_luas_tanaman_col").removeClass("hidden")
            $("#row12").removeClass("hidden")
            $("#row13").removeClass("hidden")

            $("#row10").addClass("hidden")
            $("#row11").addClass("hidden")
            $("#aset_luas_nontan_col").addClass("hidden")


        } else if (e.target.value == 2){
               $("#aset_kode_tanaman").addClass("hidden")
                $("#aset_kode_nontan").removeClass("hidden")
                $("#aset_kode_kayu").addClass("hidden")

                // sistem tanam
                $("#sistem_tanam_row").addClass("hidden")
                $("#foto_aset5_col").addClass("hidden")
                $("#aset_luas_nontan_col").removeClass("hidden")
                $("#row9").addClass("hidden")
                $("#row12").addClass("hidden")
                $("#row13").addClass("hidden")

                $("#row11").removeClass("hidden")
                $("#row10").removeClass("hidden")
                $("#aset_luas_tanaman_col").addClass("hidden")
                $("#satuan_luas").removeClass("hidden")
        } else {
            // aset kode
            $("#aset_kode_tanaman").removeClass("hidden")
            $("#aset_kode_kayu").addClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")
            $("#sistem_tanam_row").removeClass("hidden")
            $("#row7").removeClass("hidden")
            $("#row9").removeClass("hidden")
            $("#foto_aset5_col").removeClass("hidden")
            $("#aset_luas_tanaman_col").removeClass("hidden")
            $("#row12").removeClass("hidden")
            $("#row13").removeClass("hidden")
            $("#row10").addClass("hidden")
            $("#row11").addClass("hidden")
            $("#aset_luas_nontan_col").addClass("hidden")
        }
    })
    $("#aset_kondisi").change(function (e) {
        if (e.target.value == 1) {
            $("#row6").addClass("hidden")

        } else {
            $("#row6").removeClass("hidden")

        }
    })

    $("#aset_kode_nontan").change(function (e) {
        if (e.target.value == 8) {
            $("#alat_angkut_row").removeClass("hidden")
        } else {
            $("#alat_angkut_row").addClass("hidden")
        }
    })

    $("#aset_kode_tanaman").change(function (e) {
        if (e.target.value == 22) {
            $("#row12").addClass("hidden")
            $("#row13").addClass("hidden")
            $("#sistem_tanam_col").addClass("hidden")
        } else {
            $("#row12").removeClass("hidden")
            $("#row13").removeClass("hidden")
            $("#sistem_tanam_col").removeClass("hidden")
        }
    })

    $("#sistem_tanam").change(function (e) {
        if(e.target.value == 1){
            if ($("#aset_kode").val() != 22) {
                $("#row12").removeClass("hidden")
                $("#row13").removeClass("hidden")
            } else {
                $("#row12").addClass("hidden")
                $("#row13").addClass("hidden")
            }
        }

        else if (e.target.value == 2) {
            $("#row12").addClass("hidden")
            $("#row13").addClass("hidden")
        } else {
            $("#row12").addClass("hidden")
            $("#row13").addClass("hidden")
        }
    })

    $("#sistem_tanam").change(function (e) {

    })

    // bast

    $("#file_bast").change(function (e) {

        $("#file_bast_btn").addClass("btn-success")
        $("#file_bast_btn").removeClass("btn-warning")
    })
