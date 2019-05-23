export function notify(type, msg) {
    $.notify({
        message: msg,
    },{
        element: 'body',
        type: type,
        allow_dismiss: false,
        placement: {
            from: "top",
            align: "center"
        },
        offset: 10,
        spacing: 10,
        z_index: 1051,
        delay: 1000,
        timer: 1000,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
    });
}
