$(document).ready(() => {

    $(".champion-modal").click(async (event) => {

        event.preventDefault();

        const href = event.currentTarget.href;

        const response = await axios.get(href);
        if(response.status === 200) {
            $("#champion-modal-content").html(response.data);
            const championViewModal = new bootstrap.Modal(document.getElementById('champion-modal'), {});
            championViewModal.show();
        }

    });

})