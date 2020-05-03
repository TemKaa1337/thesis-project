document.querySelectorAll('.film_place').forEach((item) => {
    item.onclick = choosePlace;
});

document.getElementById('book_button').onclick = bookPlace;

var chosenPlaces = 0;

function choosePlace(event) {
    if (this.className.includes('free')) {
        if (chosenPlaces == 5) {
            alert('vse nez9!!');
        } else {
            this.className = 'film_place user_busy';
            let row = this.getAttribute('data-row');
            let place = this.getAttribute('data-place');
            chosenPlaces += 1;
        }
    } else if (this.className.includes('user_busy')) {
        this.className = 'film_place free';
        chosenPlaces -= 1;
    } else if (this.className.includes('busy')) {

    }
}

function bookPlace(event) {
    let placesData = [];
    let places = document.querySelectorAll('.user_busy');

    places.forEach((element) => {
        element.className = 'film_place busy';
        placesData.push({
            placeRow: parseInt(element.getAttribute('data-row')),
            placeNumber: parseInt(element.getAttribute('data-place'))
        });
    });

    $.ajax({
        url: '/api/book/places',
        type: "POST",
        data: { 
            places: placesData, 
            filmId: $('meta[name="filmId"]').attr('content'), 
            datetime: $('meta[name="sessionTime"]').attr('content'),
            cinema: $('meta[name="cinema"]').attr('content'),
        },
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
        },
        success: function (data) {
            if (data['result'] == 1) {
                alert('Места успешно забронированы! \n Бронь вы можете увидеть в вашем личном кабинете');
            }
        }
    });
}

