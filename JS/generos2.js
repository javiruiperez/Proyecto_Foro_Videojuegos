
const cargarGeneros = async(genero) =>{
try{

const options =await fetch( `https://api.rawg.io/api/games?key=d22b44fd751e438f943040e82cf43c0e&page=${numeroPagina}`,{
    method:'GET'
}
);

if(options.status===200){
    const options2=await options.json();
    // console.log(options2);
    options2.results.forEach(juegos=>{
        juegos.genres.forEach(nombregeneros=>{
            if(nombregeneros.name.includes(genero)){
                console.log(nombregeneros.id);
                console.log(juegos.name);
            }
        console.log(options2);
             }
        )
        
      
       
    }
};
}
    catch(error){
        console.log(error);
    }
};




const cargarJuegos = async() =>{
    try{

    const options = await fetch(`https://api.rawg.io/api/games?key=d22b44fd751e438f943040e82cf43c0e&page=${pagina}`,{
        method:'GET'
    }
    );

    if(options.status===200){
        const options2=await options.json();
        cargarConsolas(options2);
        return options2;
    }

    }catch(error){
        console.log(error);
    }

}

const cargarConsolas = async(platformName) =>{
    try{

    const options = await fetch('https://api.rawg.io/api/platforms?key=d22b44fd751e438f943040e82cf43c0e',{
        method:'GET'
    }
    );

    if(options.status===200){
        const options2=await options.json();
        for(let i = 0; i < options2.results.length; i++){
            if(options2.results[i].name === platformName){
                for(let j = 0; j < options2.results[i].games.length; j++){
                    console.log(options2.results[i].games[j].name);
                }
            }
        }
    }

    } catch(error){
        console.log(error);
    }
}

}
cargarGeneros("Shooter");
btnAnterior.addEventListener('click',()=>{
	if(pagina>1){
	pagina--;
	cargarPeliculas();
	}
	});

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


cargarConsolas("Wii");

