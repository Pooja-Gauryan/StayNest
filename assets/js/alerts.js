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