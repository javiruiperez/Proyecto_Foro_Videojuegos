numeroPagina = 1;
totalJuegos = 0;
newGames = "";

const cargarJuegos = async(platformSelected) => {
    try{
        const options =await fetch( `https://api.rawg.io/api/games?key=229705cef01a4e4c879872d1fceb9c08&page=${numeroPagina}`,{
        method:'GET'
    }
    );

        if(options.status === 200){
            const games = await options.json();

            for(var i = 0; i < games.results.length; i++){
                for(var j = 0; j < games.results[i].platforms.length; j++){
                    if(games.results[i].platforms[j].platform.name === platformSelected){
                        if(totalJuegos >= 10){
                            break;
                        }
                        let name_game = games.results[i].name;
                        let image_game = games.results[i].background_image;
                        newGames += `<div class="responsive">
                        <div class="gallery">
                          <a target="_blank" href="${image_game}">
                            <img class="" src="${image_game}" width="400" height="250">
                            <p>${name_game}</p>
                          </a>
                        </div>
                        </div>`
                        totalJuegos++;
                    }
                }
            }
            if(totalJuegos < 10){
                numeroPagina++;
                cargarJuegos(platformSelected);
            } else{
                document.getElementById("Images").innerHTML = newGames;
                //We initialize these three variables in order to be able to load other platform later
                totalJuegos = 0; 
                newGames = "";
                numeroPagina = 1;
            }

        }

    } catch(error){
        console.log(error);
    }
}

let eventPlatform = document.getElementById("selectPlatform");

eventPlatform.addEventListener("change", function(){
    let juego = eventPlatform.value;
    console.log(juego);
    cargarJuegos(juego);
})

 /*MEJORAR PAGINACIÓN, QUE APAREZCA LOS JUEGOS DE CADA PÁGINA PERO EL USUARIO TIENE BOTÓN DE SIGUIENTE PÁGINA*/

 numeroPagina = 1;
 totalJuegos = 0;
 newGames = "";
 
//  const cargarImagenesJuegosPorGenero = async(genreSelected) => {
//      try{
//          const options =await fetch( `https://api.rawg.io/api/games?key=d22b44fd751e438f943040e82cf43c0e&page=${numeroPagina}`,{
//          method:'GET'
//      }
//      );
 
//          if(options.status === 200){
//              const games = await options.json();
 
//              for(var i = 0; i < games.results.length; i++){
//                  for(var j = 0; j < games.results[i].genres.length; j++){
//                      if(games.results[i].genres[j].name === genreSelected){
//                          if(totalJuegos >= 10){
//                              break;
//                          }
//                          let name_game = games.results[i].name;
//                          let image_game = games.results[i].background_image;
//                          newGames += `<div class="responsive">
//                          <div class="gallery">
//                            <a target="_blank" href="${image_game}">
//                              <img class="" src="${image_game}" width="400" height="250">
//                              <p>${name_game}</p>
//                            </a>
//                          </div>
//                          </div>`
//                          totalJuegos++;
//                      }
//                  }
//              }
//              if(totalJuegos < 10){
//                  numeroPagina++;
//                  cargarImagenesJuegosPorGenero(genreSelected);
//              } else{
//                  document.getElementById("platform").innerHTML = newGames;
//                  //We initialize these three variables in order to be able to load other platform later
//                  totalJuegos = 0; 
//                  newGames = "";
//                  numeroPagina = 1;
//              }
 
//          }
 
//      } catch(error){
//          console.log(error);
//      }
//  }
    
//      cargarImagenesJuegosPorGenero("Action");