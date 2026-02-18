import Swal from "sweetalert2";
window.Swal = Swal;

document.addEventListener("livewire:navigated", function () {
    Livewire.on("swal", (data) => {
        data = data[0];

        Swal.fire({
            icon: data.icon,
            title: data.title,
            html: data.text,
            showConfirmButton: false,
            timer: 3000,
        }).then(() => {
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        });
    });

    document.addEventListener("click", function (e) {
        if (e.target && e.target.id === "img") {
            let url = e.target.dataset.url;

            Swal.fire({
                showCancelButton: false,
                showConfirmButton: false,
                html: `<img src="${url}" class="w-full mx-auto rounded-xl" loading="lazy" />`,
            });
        }
    });
});
