import axios from 'axios'

if (document.querySelectorAll('.btnRequest')) {
    const deleteButton = document.querySelectorAll('.btnRequest');

    deleteButton.forEach(element => {

        element.addEventListener('click', function (e) {

            const id = element.getAttribute('data-id');

            e.preventDefault();

            axios.post(`/admin/approvePost/${id}`, {
                    updateValue: this.value,
                })
                .then(data => {
                    console.log(data);

                    window.location.href = "http://localhost:8000/admin/approve"
                })
                .catch(err => {
                    console.log(err);

                })
        })
    })
}
