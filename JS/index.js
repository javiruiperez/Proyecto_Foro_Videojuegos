numeroPagina = 1;
images = "";
element = document.getElementById("borrar");
cont = 0;
const APIKEY = "1be85ff8d0924ba09c76e6dea4bddd46";

const cargarImagenesJuegosPorGenero = async (genero) => {
    try {
        const options = await fetch(`https://api.rawg.io/api/games?key=${APIKEY}&page=${numeroPagina}`, {
            method: 'GET',
        }
        );
        if (options.status === 200) {
            const options2 = await options.json();

            if (cont == 0) {
                element = document.getElementById("borrar");
                element.remove();
                cont++;
            }
            //Search games ordered by genres and show the first 8
            options2.results.forEach(juegos => {
                juegos.genres.forEach(nombregeneros => {
                    if (nombregeneros.name.includes(genero)) {
                        images = images + `<div class="responsive">
                            <div class="gallery">
                            <img class="imagen" id=${juegos.id} src="${juegos.background_image}" width="400"    height="250">
                            <p class="tituloJuego">${juegos.name}</p>
                            </a>
                            </div>
                        </div>`
                        totalJuegos++;
                    }
                })

                if (images == "" && totalJuegos < 8) {
                    numeroPagina++;
                    cargarImagenesJuegosPorGenero(genero);
                }
                else {

                    if (totalJuegos < 9) {
                        document.getElementById('Images').innerHTML = images;
                        numeroPagina = 1;
                    }
                }
            });
        }
    } catch (error) {
        console.log(error);
    }
    //include id of game and link of image in the url to use when user click the image
    const imagenImagen = document.querySelectorAll('.imagen');
    imagenImagen.forEach(e => {
        e.addEventListener('click', () => {
            var idJuego = e.id;
            var enlace = e.src;
            var nombre = document.getElementById(e.id).nextElementSibling.innerHTML;
            window.location.href = "../PHP/comentarios/addComments.php" + "?w1=" + idJuego + "&w2=" + enlace + "&w3=" + nombre;
        })
    })
}

const btnAnterior = document.getElementById('btnAnterior');
const btnSiguiente = document.getElementById('btnSiguiente');
const BtnGeneros = document.querySelectorAll('.genres');

BtnGeneros.forEach(nombre => {
    tiposgeneros = document.getElementById(nombre.id);

    tiposgeneros.addEventListener('click', () => {
        Visible();
        BTNSiguiente = document.getElementById("Siguiente");
        BTNSiguiente.addEventListener('click', () => {
            //We initialize these four variables in order to be able to load other page
            images = "";
            totalJuegos = 0;
            newGames = "";
            siguiente();
            cargarImagenesJuegosPorGenero(nombre.id);
        })
        BTNAtras = document.getElementById("Atras");
        BTNAtras.addEventListener('click', () => {
            //We initialize these four variables in order to be able to load other page
            images = "";
            totalJuegos = 0;
            newGames = "";
            atras();
            cargarImagenesJuegosPorGenero(nombre.id);
        })
        //We initialize these four variables in order to be able to load other platform later
        images = "";
        numeroPagina = 1;
        totalJuegos = 0;
        newGames = "";
        element = document.getElementById("borrar");

        cargarImagenesJuegosPorGenero(nombre.id);

        btnAnterior.addEventListener('click', () => {
            if (numeroPagina > 1) {
                numeroPagina--;
                cargarImagenesJuegosPorGenero(nombre.id);
            }
        });

        btnSiguiente.addEventListener('click', () => {
            if (numeroPagina < 1000) {
                numeroPagina++;
                cargarImagenesJuegosPorGenero(nombre.id);
            }
        });
    })
})

function Visible() {
    document.getElementById("Siguiente").style.display = 'inline-block';
    document.getElementById("Atras").style.display = 'inline-block';
    document.getElementById("Botones").style.display = "block";
}
function Invisible() {
    document.getElementById("Siguiente").style.display = 'none';
    document.getElementById("Atras").style.display = 'none';
    document.getElementById("Botones").style.display = "none";
}
function siguiente() {
    numeroPagina++;
}
function atras() {
    numeroPagina--;
}

totalJuegos = 0;
newGames = "";

const cargarJuegos = async (platformSelected) => {
    try {
        const options = await fetch(`https://api.rawg.io/api/games?key=${APIKEY}&page=${numeroPagina}`, {
            method: 'GET'
        }
        );

        if (options.status === 200) {
            const games = await options.json();
            element = document.getElementById("borrar");
            if (element != null) {
                element = document.getElementById("borrar");
                element.remove();
            }

            for (var i = 0; i < games.results.length; i++) {
                for (var j = 0; j < games.results[i].platforms.length; j++) {
                    if (games.results[i].platforms[j].platform.name === platformSelected) {
                        if (totalJuegos >= 8) {
                            break;
                        }
                        let name_game = games.results[i].name;
                        let image_game = games.results[i].background_image;
                        newGames += `<div class="responsive">
                        <div class="gallery">
                            <img class="imagen" id=${games.results[i].id}  src="${image_game}" width="400" height="250">
                            <p class="tituloJuego">${name_game}</p>
                          </a>
                        </div>
                        </div>`
                        totalJuegos++;
                    }
                }
            }

            if (totalJuegos < 8) {
                numeroPagina++;
                cargarJuegos(platformSelected);
            } else {
                document.getElementById("Images").innerHTML = newGames;
                //Initialize these variables in order to be able to load other platform later
                totalJuegos = 0;
                newGames = "";
                numeroPagina = 1;
                images = "";
                cont++;

                const imagenImagen2 = document.querySelectorAll('.imagen');

                imagenImagen2.forEach(i => {
                    i.addEventListener('click', () => {
                        var idJuego = i.id;
                        var enlace = i.src;
                        var nombre = document.getElementById(i.id).nextElementSibling.innerHTML;
                        window.location.href = "../PHP/comentarios/addComments.php" + "?w1=" + idJuego + "&w2=" + enlace + "&w3=" + nombre;
                    })
                })
            }
        }
    } catch (error) {
        console.log(error);
    }
}

let eventPlatform = document.getElementById("selectPlatform");

if (eventPlatform != null) {
    eventPlatform.addEventListener("change", function () {
        let juego = eventPlatform.value;

        totalJuegos = 0;
        numeroPagina = Math.floor(Math.random() * 5 + 1);
        Invisible();
        cargarJuegos(juego);
    })
}


countFunction=1;
const cargarJuegosInicio = async () => {
    if(countFunction === 1){
    //Once the function is called, this prevents to fetch again and do infinite fetches
        try {
            const options = await fetch(`https://api.rawg.io/api/games?key=${APIKEY}&page=${numeroPagina}`, {
                method: 'GET',
            }
            );
            numero = 0;
            totalJuegos = 0;
            if (options.status === 200) {
                const games = await options.json();
                element = document.querySelectorAll('.prede');

                element.forEach(r => {
                    //Show 4 games in the index page
                    for (var i = 0; i < games.results.length; i++) {
                        for (var j = 0; j < games.results[i].platforms.length; j++) {

                            if (totalJuegos >= 4) {
                                break;
                            }
                            let name_game = games.results[i].name;
                            let image_game = games.results[i].background_image;

                            if (numero == totalJuegos && i == numero) {

                                r.id = games.results[i].id;
                                r.src = image_game;
                                console.log(document.getElementById(r.id).nextElementSibling);
                                element2 = document.getElementById(r.id).nextElementSibling;
                                element2.innerHTML = name_game;
                                totalJuegos++;
                            }
                        }
                    }
                    numero++;
                })

                if (totalJuegos < 4 && numero < 4) {
                    numeroPagina++;
                    cargarJuegosInicio();
                }

                element.forEach(m => {
                    m.addEventListener('click', () => {
                        var idJuego = m.id;
                        var enlace = m.src;
                        var nombre = document.getElementById(m.id).nextElementSibling.innerHTML;
                        window.location.href = "../PHP/comentarios/addComments.php" + "?w1=" + idJuego + "&w2=" + enlace    + "&w3=" + nombre;
                    })
                })
            }
        } catch (error) {
            console.log(error);
        }
        countFunction++;
    }
}

const searchBar = document.getElementById("barra_busqueda");
searchBar.addEventListener("keypress", function(e){
    if(e.key === "Enter"){
        var gameName = searchBar.value;
        Busqueda(gameName);
    }
});

numeroPagina = 1;
const Busqueda = async (nombreJuego) => {
    try {
        const options = await fetch(`https://api.rawg.io/api/games?key=${APIKEY}&page=${numeroPagina}`, {
            method: 'GET',
        }
        );

        if (options.status === 200) {
            const options2 = await options.json();
            options2.results.forEach(element => {
                //Function to search for a game in the search bar (theoretically it should work)
                if (nombreJuego == element.name) {
                    //Depending on the location of the user, it will redirect somewhere
                    if(window.location.pathname === "/proyecto/HTML/Index.php"){
                        window.location.href = '../PHP/comentarios/addComments.php?w1='+element.id+'&w2='+element.background_image+'&w3='+element.name;
                    } else 
                        if(window.location.pathname === "/proyecto/PHP/register/registro.php" || window.location.pathname === "/proyecto/PHP/login/checkLogin.php"){
                            window.location.href = '../comentarios/addComments.php?w1='+element.id+'&w2='+element.background_image+'&w3='+element.name;
                    } else if(window.location.pathname === "/proyecto/PHP/addComments.php"){
                        window.location.href = 'addComments.php?w1='+element.id+'&w2='+element.background_image+'&w3='+element.name;
                    }
                } else{
                    numeroPagina++;
                    Busqueda(nombreJuego);
                }
            })
        }
    } catch (error) {
        console.log(error);
    }
}

cargarJuegosInicio();