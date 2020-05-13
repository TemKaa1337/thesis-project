document.getElementById('button').onclick = addNewFilm;

function addNewFilm(event) {
    event.preventDefault();

    let form = new FormData();
    form.append('filmName', document.getElementById('film_name').value);
    form.append('filmDescription', document.getElementById('film_description').value);
    form.append('dateFrom', document.getElementById('date_shown_from').value);
    form.append('dateTo', document.getElementById('date_shown_to').value);
    form.append('country', document.getElementById('country').value);
    form.append('year', document.getElementById('year').value);
    form.append('filmLength', document.getElementById('length').value);
    form.append('genre', document.getElementById('genre').value);
    form.append('producer', document.getElementById('producer').value);
    form.append('actors', document.getElementById('actors').value);
    form.append('ageRestrictions', document.getElementById('age_restrictions').value);
    form.append('trailer', document.getElementById('trailer').value);
    form.append('previewImage', document.getElementById('upload_film_image_preview_input').files[0]);
    form.append('filmPageImage', document.getElementById('upload_film_image_input').files[0]);

    $.ajax({
        url: '/api/save/new_film',
        type: "POST",
        data: form,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            alert('Фильм успешно добавлен!');
        }
    });
}