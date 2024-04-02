// Replace 'myForm' with the ID of your form
const sendPost = document.getElementById('myForm');
const box = document.getElementById('alert');

sendPost.addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData(sendPost);

    box.classList.add('d-none');

    mob.post('/ctrl/packages/mobcontrol/login', formData, function (response) {
        // Lógica a ser executada em caso de sucesso
        console.log(response);
        const data = JSON.parse(response);
        if (data.status == 0) {
            box.classList.remove('d-none');
            box.innerHTML = data.message;
        }
        else {
            window.location.href = '/';
        }
    }, function (error) {
        // Lógica a ser executada em caso de erro
        console.error('POST Error:', error);
    });

});