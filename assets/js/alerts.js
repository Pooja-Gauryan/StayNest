function showSuccess(message, redirect = null) {
    Swal.fire({
        icon: "success",
        title: "Success",
        text: message,
        confirmButtonColor: "#0d6efd"
    }).then(() => {
        if (redirect) {
            window.location.href = redirect;
        }
    });
}

function showError(message) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: message,
        confirmButtonColor: "#dc3545"
    });
}

function showSuccess(message){

    Swal.fire({
        icon:"success",
        title:"Success",
        text:message,
        timer:1500,
        showConfirmButton:false
    });

}


function showError(message){

    Swal.fire({
        icon:"error",
        title:"Error",
        text:message
    });

}