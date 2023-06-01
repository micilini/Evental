$(document).ready(function () {
    let newEvent = true;
    //Menu Toggle Script
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    // For highlighting activated tabs
    $("#tab1").click(function () {
        $(".tabs").removeClass("active1");
        $(".tabs").addClass("bg-light");
        $("#tab1").addClass("active1");
        $("#tab1").removeClass("bg-light");
        cleanForm();
    });
    $("#tab2").click(function () {
        $(".tabs").removeClass("active1");
        $(".tabs").addClass("bg-light");
        $("#tab2").addClass("active1");
        $("#tab2").removeClass("bg-light");
        cleanForm();
    });
    $("#tab3").click(function () {
        $(".tabs").removeClass("active1");
        $(".tabs").addClass("bg-light");
        $("#tab3").addClass("active1");
        $("#tab3").removeClass("bg-light");
        cleanForm();
    });

    //Trick for date input
    const date = new Date();
    let day = date.getDate().toString().padStart(2, "0");
    let month = (date.getMonth() + 1).toString().padStart(2, "0");
    let year = date.getFullYear();
    let dates = year + '-' + month + '-' + day;
    $('input[name=inicio_evento]').prop('min', dates);
    $('input[name=termino_evento]').prop('min', dates);

    //Ajax Functions: New Event

    $('.newEvent').on('submit', function (e) {
        e.preventDefault();
        $('#button-add-event').prop('disabled', true);
        $('#button-add-event').val('Aguarde...');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            headers: {
                'Accept': 'application/json',
            },
            dataType: "json",
            url: (newEvent == true) ? ajaxURL_Add : ajaxURL_Edit,
            data: $('.newEvent').serialize(),
            success: function (data) {
                window.location.reload();
            },
            error: function (error) {
                console.log('API Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Algo de errado aconteceu...',
                    text: error.responseJSON.message
                });
                $('#button-add-event').prop('disabled', false);
                $('#button-add-event').val('CRIAR EVENTO');
            }
        });
    });

    //Modal: SeeEvent

    $(".seeEvent").on("click", function() {
        let dataID = $(this).attr('data-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            headers: {
                'Accept': 'application/json',
            },
            dataType: "json",
            url: ajaxURL_See,
            data: {id_event : dataID},
            success: function (data) {
                //console.log(data);
                console.log(data.infoEvent.start_date_event);
                let startDateSplit = data.infoEvent.start_date_event.split('-');
                let endDateSplit = data.infoEvent.end_date_event.split('-');
                $('#modal-title-event').html(data.infoEvent.title_event);
                $('#modal-description-event').html(data.infoEvent.description_event);
                $('#modal-start-date').html(startDateSplit[2] + '/' + startDateSplit[1] + '/' + startDateSplit[0]);
                $('#modal-end-date').html(endDateSplit[2] + '/' + endDateSplit[1] + '/' + endDateSplit[0]);
                $('#modal-start-hour').html(data.infoEvent.start_hour_event.slice(0, -3));
                $('#modal-end-hour').html(data.infoEvent.end_hour_event.slice(0, -3));
                //window.location.reload();
            },
            error: function (error) {
                //console.log('API Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Algo de errado aconteceu...',
                    text: error.responseJSON.message
                });
                $('#seeEvent').modal('hide');
            }
        });
    });

    //Remove Event

    $(".removeEvent").on("click", function() {
        let dataID = $(this).attr('data-id');
        Swal.fire({
            title: 'Tem certeza que deseja remover este evento?',
            text: "Na versão demo este tipo de ação é irreversível...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Remover',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
              removeEvent(dataID);
            }
        })
    });

    //Ajax Functions: Remove Event

    function removeEvent(dataID){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            headers: {
                'Accept': 'application/json',
            },
            dataType: "json",
            url: ajaxURL_Remove,
            data: {id_event : dataID},
            success: function (data) {
                console.log(data);
                window.location.reload();
            },
            error: function (error) {
                console.log('API Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Algo de errado aconteceu...',
                    text: error.responseJSON.message
                });
            }
        });
    }

    //Edit Event

    $(".editEvent").on("click", function() {
        let dataID = $(this).attr('data-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            headers: {
                'Accept': 'application/json',
            },
            dataType: "json",
            url: ajaxURL_See,
            data: {id_event : dataID},
            success: function (data) {
                //console.log(data);
                newEvent = false;
                $('#event_operation_title').html('Editar um evento');
                $('#button-add-event').val('EDITAR EVENTO');
                $('input[name=id_evento]').val(data.infoEvent.id_event);
                $('input[name=titulo_evento]').val(data.infoEvent.title_event);
                $('input[name=descricao_evento]').val(data.infoEvent.description_event);
                $('input[name=inicio_evento]').val(data.infoEvent.start_date_event);
                $('input[name=termino_evento]').val(data.infoEvent.end_date_event);
                $('input[name=hora_inicio_evento]').val(data.infoEvent.start_hour_event.slice(0, -3));
                $('input[name=hora_final_evento]').val(data.infoEvent.end_hour_event.slice(0, -3));
            },
            error: function (error) {
                //console.log('API Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Algo de errado aconteceu...',
                    text: error.responseJSON.message
                });
            }
        });
    });

    //Clean Form

    function cleanForm(){
        $('#event_operation_title').html('Criar um novo evento');
        $('#button-add-event').val('CRIAR EVENTO');
        newEvent = true;
        $('.newEvent')[0].reset();
    }

})
