document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".btn-delete").forEach(button => {

        button.addEventListener("click", async function () {

            const card = this.closest(".col-12");

            const confirmDelete = await Swal.fire({
                title: "Delete Property?",
                text: "This property will be moved to trash.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, Delete",
                cancelButtonText: "Cancel"
            });

            if (!confirmDelete.isConfirmed) {
                return;
            }

            const formData = new FormData();
            formData.append("property_id", this.dataset.id);

            try {

                const response = await fetch("../backend/api/property/delete.php", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();

                if (result.success) {

                    await Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        text: result.message,
                        timer: 1500,
                        showConfirmButton: false
                    });

                    card.remove();
                    location.reload();

                } else {

                    Swal.fire({
                        icon: "error",
                        title: "Oops!",
                        text: result.message
                    });

                }

            } catch (error) {

                console.error(error);

                Swal.fire({
                    icon: "error",
                    title: "Network Error",
                    text: "Please try again."
                });

            }

        });

    });

});