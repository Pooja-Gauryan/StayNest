document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("profileForm");

    if (!form) return;

    form.addEventListener("submit", async function (e) {

        e.preventDefault();

        const formData = new FormData(form);

        const response = await fetch(

            "../backend/api/profile/update.php",

            {

                method: "POST",

                body: formData,

                credentials: "same-origin"

            }

        );

        const result = await response.json();

        alert(result.message);

        if(result.success){

            location.reload();

        }

    });

});