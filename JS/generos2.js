numeroPagina=1;

images="";
 element =document.getElementById("borrar");
 cont=0;
const cargarImagenesJuegosPorGenero = async(genero) =>{
    try{
    
    const options =await fetch( `https://api.rawg.io/api/games?key=a580e38977014c8b9b571daecae598ef&page=${numeroPagina}`,{
        method:'GET'
    }
    );
    // images="";
    
  
    if(options.status===200){
        const options2=await options.json();
       
     console.log(cont+"hola"); 
       if(cont==0){
        element = document.getElementById("borrar");
          element.remove();
          cont++;
       }
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
totalJuegos++;           

// document.getElementById('Images').innerHTML=images;
                    
                    



                    
                }
                
                
                    }
               )
            
       
        
            // document.getElementById('Images').innerHTML=images; 
        
            if(images==""&&totalJuegos<10){
                numeroPagina++;
             
                cargarImagenesJuegosPorGenero(genero);
                
            }
            else{
                console.log(totalJuegos);
                if(totalJuegos<10)
                document.getElementById('Images').innerHTML=images; 
                numeroPagina=1;
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




BtnGeneros.forEach(nombre=>{
   console.log(nombre.id); 
   tiposgeneros=document.getElementById(nombre.id);
   console.log(tiposgeneros);
   tiposgeneros.addEventListener('click',()=>{
  
    images="";
    numeroPagina=1;
    totalJuegos = 0;
    newGames = "";
     element = document.getElementById("borrar");
    // if(element!=null){
    //     element = document.getElementById("borrar");
    //  element.remove();
    //  element=null;
    //    }
   
       
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






totalJuegos = 0;
newGames = "";

const cargarJuegos = async(platformSelected) => {
    try{
        const options =await fetch( `https://api.rawg.io/api/games?key=a580e38977014c8b9b571daecae598ef&page=${numeroPagina}`,{
        method:'GET'
    }
    );

        if(options.status === 200){
            const games = await options.json();
            element = document.getElementById("borrar");
            if(element!=null){
                element = document.getElementById("borrar");
             element.remove();
               }
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
                images="";
               cont++;
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
    totalJuegos = 0; 
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
