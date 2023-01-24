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

//     btnSiguiente.addEventListener('click',()=>{
//         if(numeroPagina<1000){
//             numeroPagina++;
//     cargarImagenesJuegosPorGenero("Shooter");
//         }
//     });


  


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
