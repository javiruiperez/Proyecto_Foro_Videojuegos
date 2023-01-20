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

cargarConsolas("PlayStation 5");