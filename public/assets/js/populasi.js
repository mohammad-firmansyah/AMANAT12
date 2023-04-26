
// populasi

let pop_per_ha;
let presentase_pop_per_ha;
$("#aset_luas").on("keyup change",function (e) {
    pop_per_ha = $("#pop_ini").val()/$("#aset_luas").val()
    presentase_pop_per_ha = pop_per_ha/$("#pop_std").val()
    if(!isFinite(pop_per_ha)){
        $("#pop_per_ha").val(0)
    } else {
        $("#pop_per_ha").val(pop_per_ha)

    }
    if(!isFinite(presentase_pop_per_ha)){

        $("#presentase_pop_per_ha").val(0)
    } else {
        $("#presentase_pop_per_ha").val(presentase_pop_per_ha)

    }
    if(isNaN(parseFloat(pop_per_ha))){
        $("#pop_per_ha").val(0)
    } else {
        $("#pop_per_ha").val(pop_per_ha)

    }
    if(isNaN(parseFloat(presentase_pop_per_ha))){

        $("#presentase_pop_per_ha").val(0)
    } else {
        $("#presentase_pop_per_ha").val(presentase_pop_per_ha)

    }
})

$("#pop_pohon_saat_ini").on("keyup change",function (e) {
    pop_per_ha = e.target.value /$("#aset_luas").val()
    presentase_pop_per_ha = pop_per_ha/$("#pop_std").val()
    if(!isFinite(pop_per_ha)){
        $("#pop_per_ha").val(0)
    } else {
        $("#pop_per_ha").val(pop_per_ha)

    }
    if(!isFinite(presentase_pop_per_ha)){

        $("#presentase_pop_per_ha").val(0)
    } else {
        $("#presentase_pop_per_ha").val(presentase_pop_per_ha)

    }
    if(isNaN(parseFloat(pop_per_ha))){
        $("#pop_per_ha").val(0)
    } else {
        $("#pop_per_ha").val(pop_per_ha)

    }
    if(isNaN(parseFloat(presentase_pop_per_ha))){

        $("#presentase_pop_per_ha").val(0)
    } else {
        $("#presentase_pop_per_ha").val(presentase_pop_per_ha)

    }
})

$("#pop_std").on("keyup change",function (e) {
    console.log(e.target.value);
    $("#pop_per_ha").val(pop_per_ha)
    pop_per_ha = $("#pop_pohon_saat_ini").val()/$("#aset_luas").val()
    presentase_pop_per_ha = pop_per_ha/$("#pop_std").val()
    if(!isFinite(pop_per_ha)){
        $("#pop_per_ha").val(0)
    } else {
        $("#pop_per_ha").val(pop_per_ha)

    }
    if(!isFinite(presentase_pop_per_ha)){

        $("#presentase_pop_per_ha").val(0)
    } else {
        $("#presentase_pop_per_ha").val(presentase_pop_per_ha)

    }
    if(isNaN(parseFloat(pop_per_ha))){
        $("#pop_per_ha").val(0)
    } else {
        $("#pop_per_ha").val(pop_per_ha)

    }
    if(isNaN(parseFloat(presentase_pop_per_ha))){

        $("#presentase_pop_per_ha").val(0)
    } else {
        $("#presentase_pop_per_ha").val(presentase_pop_per_ha)

    }
})
