numeroPagina=1;

entra=false;
const Busqueda = async(nombreJuego) =>{

try{
    const options =await fetch( `https://api.rawg.io/api/tags?key=a580e38977014c8b9b571daecae598ef`,{
        method:'GET'
    }
    );
    // images="";

    if(options.status===200){
        const options2=await options.json();
// console.log(options2);
options2.results.forEach(element => {
    element.games.forEach(element2 =>{
        if(nombreJuego==element2.name&&entra==false){

           
            entra=true;
           console.log(element2.name);
           return element2.name;
        }
        
       
    })

});

    }
    }catch(error){
        console.log(error);
    }

}


// Busqueda("Grand Theft Auto V");



const cargarImagenesJuegosPorNombre = async(nombreJuego) =>{
    try{
        const options =await fetch( `https://api.rawg.io/api/games?key=a580e38977014c8b9b571daecae598ef&page=${numeroPagina}`,{
            method:'GET'
        }
        );
        // images="";

        if(options.status===200){
            const options2=await options.json();
          
        
            options2.results.forEach(element=>{
                if(element.name==nombreJuego){
                    if(entra==false){
               console.log("entro");
               console.log(element.background_image);
               console.log(element.name);
               entra=true;
                    }
                }
               
                
            })
            if(entra==false){
                numeroPagina++;
                cargarImagenesJuegosPorNombre(nombreJuego);
            }
        }

    } catch(error){
        console.log(error);
    }

}


cargarImagenesJuegosPorNombre("Tom Raider");
// function cargarImagenesJuegosPorNombreDef(NombreJuego){
//     if(entra==false){
//         numeroPagina++;
//         cargarImagenesJuegosPorNombre(NombreJuego);
//     }
// }



