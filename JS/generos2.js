numeroPagina=1;

images="";
const cargarImagenesJuegosPorGenero = async(genero) =>{
    try{
    
    const options =await fetch( `https://api.rawg.io/api/games?key=94724ba87c45468abe5604e556c7366a&page=${numeroPagina}`,{
        method:'GET'
    }
    );
    // images="";
    if(options.status===200){
        const options2=await options.json();
       
        mostrarjuego=true; 
       
        options2.results.forEach(juegos=>{
           
            juegos.genres.forEach(nombregeneros=>{
                if(nombregeneros.name.includes(genero)){
                  
                    console.log(juegos.background_image);
                    
                    
images=images+`<div class="responsive">
<div class="gallery">
  <a target="_blank" href="${juegos.background_image}">
    <img class="" src="${juegos.background_image}" width="400" height="250">
    <p>${juegos.name}</p>
  </a>
</div>
</div>`
            

// document.getElementById('Images').innerHTML=images;
                    
                    



                    
                }
                
                
                    }
               )
            
       
        
            // document.getElementById('Images').innerHTML=images; 
        
            if(images==""){
                numeroPagina++;
                console.log(images+"hola");
                cargarImagenesJuegosPorGenero(genero);
                
            }
            else{
                document.getElementById('Images').innerHTML=images; 
                
            }  
          
            
           }
           
           
           );
      }

     
   
    }catch(error){
        console.log(error);
    }
    }


   
    // cargarImagenesJuegosPorGenero("Racing");
    const btnAnterior=document.getElementById('btnAnterior');
    const btnSiguiente=document.getElementById('btnSiguiente');
  const BtnGeneros= document.querySelectorAll('.genres');
console.log(BtnGeneros);

BtnGeneros.forEach(nombre=>{
   console.log(nombre.id); 
   tiposgeneros=document.getElementById(nombre.id);
   console.log(tiposgeneros);
   tiposgeneros.addEventListener('click',()=>{
    images="";
    numeroPagina=1;
   cargarImagenesJuegosPorGenero(nombre.id);
   
     
    btnAnterior.addEventListener('click',()=>{
        if(numeroPagina>1){
            numeroPagina--;
        cargarImagenesJuegosPorGenero(nombre.id);
        }
        });
    
        btnSiguiente.addEventListener('click',()=>{
            if(numeroPagina<1000){
                numeroPagina++;
        cargarImagenesJuegosPorGenero(nombre.id);
            }
        });
    
   })
})





numeroPagina = 1;
totalJuegos = 0;
newGames = "";

const cargarJuegos = async(platformSelected) => {
    try{
        const options =await fetch( `https://api.rawg.io/api/games?key=d22b44fd751e438f943040e82cf43c0e&page=${numeroPagina}`,{
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








  


// const idGeneros= async(nombreGenero)=>{
//     try{
//         const generos=await fetch('https://api.rawg.io/api/genres?key=d22b44fd751e438f943040e82cf43c0e',{
//             mehtod:'GET',
        
//         })
//         if(generos.status===200){
//             const generos2=await generos.json();
//             // console.log(generos2);
//             generos2.results.forEach(juego=>{
//                 if(nombreGenero==juego.name)
// console.log(juego.id);
//             })
//         }
        
       
//     }
// catch(error){
//     console.log(error);
// }
// }
// idGeneros("Action");
