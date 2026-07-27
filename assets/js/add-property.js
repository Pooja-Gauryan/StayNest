document.addEventListener("DOMContentLoaded", () => {

    loadAmenities();

    const form = document.getElementById("addPropertyForm");

    if (!form) return;

    form.addEventListener("submit", async function (e) {

        e.preventDefault();

        const submitBtn = form.querySelector(".publish-btn");

        submitBtn.disabled = true;

        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm"></span>
            Publishing...
        `;

        try {

            const formData = new FormData(form);

            console.log("Before Fetch");

const response = await fetch("../backend/api/property/create.php", {
    method: "POST",
    body: formData,
    credentials: "same-origin"
});

console.log("After Fetch");

            const result = await response.json();

            if (result.success) {

                Swal.fire({
                    icon:"success",
                    title:"Success",
                    text:result.message,
                    timer:2000,
                    showConfirmButton:false
                });

form.reset();

            } else {

                Swal.fire({
                    icon:"error",
                    title:"Oops...",
                    text:result.message
                });

            }

        } catch (error) {

            Swal.fire({
                icon:"error",
                title:"Network Error",
                text:"Please try again."
            });

            console.error(error);

        }

        submitBtn.disabled = false;

        submitBtn.innerHTML = `
            <i class="bi bi-cloud-upload"></i>
            Publish Property
        `;

    });

});

async function loadAmenities(){

    try{

        const response=await fetch(

            "../backend/api/amenities/list.php"

        );

        const result=await response.json();

        if(!result.success){

            return;

        }

        const container=document.getElementById(

            "amenitiesContainer"

        );

        container.innerHTML="";

        result.data.forEach(amenity=>{

            container.innerHTML+=`

            <div class="col-md-3">

                <div class="form-check">

                    <input

                    class="form-check-input"

                    type="checkbox"

                    name="amenities[]"

                    value="${amenity.id}"

                    id="amenity${amenity.id}"

                    >

                    <label

                    class="form-check-label"

                    for="amenity${amenity.id}">

                    ${amenity.name}

                    </label>

                </div>

            </div>

            `;

        });

    }

    catch(error){

        console.log(error);

    }

}