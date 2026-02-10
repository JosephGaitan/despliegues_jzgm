
function loadFilm() {

    let url = new URL(window.location.href);
    let id = url.searchParams.get("id");

    fetch(apiUrl+"/api/films/get_film.php?id="+id, {
        method: 'GET'
    })
    .then((response) => {
        if(response.status==500)
            alert("Se ha producido un error, vuélvelo a intentar, si el problema persiste contacte con el administrador");
        else {
            response.json().then((data) => {
                if(data.status == "OK") {
                    let film = data.data; 
                    document.getElementById("name").innerHTML = film.name;
                    document.getElementById("director").innerHTML = film.director;
                    document.getElementById("classification").innerHTML = film.classification;
                    document.getElementById("img").src=film.img;
                    document.getElementById("plot").innerHTML=film.plot;
                } else
                    alert("Se ha producido un error, vuélvelo a intentar, si el problema persiste contacte con el administrador")
            });
        }
    });
}
//-------------------------------------

document.addEventListener("DOMContentLoaded", function(event) { 
    //Cuando carga la página, llamo al método que obtiene las películas y pinta los resultados
    loadFilm();
});


