
const http = new EasyHTTP;

var menus;

//Get Menus
  http.get('http://localhost:8080/wp-json/church_spa/v1/menus_items')
    .then(data => menus = data)
    .then(() => console.log(menus))
    .catch(err => console.log(err));