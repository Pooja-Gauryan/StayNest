document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".btn-delete").forEach(button => {

        button.addEventListener("click", async function () {

            if (!confirm("Are you sure you want to delete this property?")) {
                return;
            }

            const formData = new FormData();

            formData.append("property_id", this.dataset.id);

            try {

                const response = await fetch(
                    "../backend/api/property/delete.php",
                    {
                        method: "POST",
                        body: formData
                    }
                );

                const result = await response.json();

                alert(result.message);

                if (result.success) {

                    location.reload();

                }

            } catch (error) {

                console.error(error);

                alert("Network Error");

            }

        });

    });

});