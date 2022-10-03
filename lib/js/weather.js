document.addEventListener('DOMContentLoaded', function () {
    //Key và base của api lấy địa chỉ
    const api = {
        key: "9d2908c81003444ea908c81003b44ed4",
        base: "https://api.weather.com/v3/location"
    }
    //base lấy thông tin thời tiết bằng địa chỉ trên
    const basew = "https://api.weather.com/v3";

    //sự kiện ô nhập địa chỉ
    const searchbox = document.querySelector('.search-box');
    searchbox.addEventListener('keypress', setQuery);
    document.querySelector('.but').onmousedown = function () {
        getResults(searchbox.value);
    }
    function setQuery(evt) {
        if (evt.keyCode == 13) {
            getResults(searchbox.value);
        }
    }

    //lấy thông tin địa chỉ từ api thành json
    function getResults(query) {
        fetch(`${api.base}/search?query=${query}&locationType=region&language=vi&format=json&apiKey=${api.key}`)
            .then(location => {
                return location.json();
            }).then(getData);
    }
    function getData(location) {
        //lấy thông tin thời tiết về json
        fetch(`${basew}/wx/observations/current?geocode=${location.location.latitude[0]}%2C${location.location.longitude[0]}&units=m&language=vi&format=json&apiKey=${api.key}`)
            .then(weather => {
                return weather.json();
            }).then(displayResults);

        let city = document.querySelector('.location .city');
        city.innerText = `${location.location.address[0]}`;

        //hiển thị thông tin nhiệt độ, ngày tháng...
        function displayResults(weather) {
            let temp = document.querySelector('.current .temp');
            temp.innerHTML = `${weather.temperature}<span>°C</span>`;

            let date = document.querySelector('.location .date');
            date.innerHTML = `${weather.dayOfWeek}, Ngày ${weather.validTimeLocal.slice(8, 10)} Tháng 
            ${weather.validTimeLocal.slice(5, 7)} Năm ${weather.validTimeLocal.slice(0, 4)}`;

            let weather_el = document.querySelector('.current .weather');
            weather_el.innerText = weather.cloudCoverPhrase;

            let hilow = document.querySelector('.hi-low');
            hilow.innerText = `${weather.temperatureMin24Hour}°C - ${weather.temperatureMax24Hour}°C`;
        }

    }
});
