const cargarJuegos = async(platformSelected) => {
    try{

        const options = await fetch('https://api.rawg.io/api/games?key=d22b44fd751e438f943040e82cf43c0e', {
            method: 'GET'
        }
        );

        if(options.status === 200){
            const games = await options.json();

            for(var i = 0; i < games.results.length; i++){
                for(var j = 0; j < games.results[i].platforms.length; j++){
                    if(games.results[i].platforms[j].platform.name === platformSelected){
                        console.log(games.results[i].name);
                    }
                    
                }
            }
        }

    } catch(error){
        console.log(error);
    }
}

cargarJuegos("PC");

/*const cargarConsolas = async(platformName) =>{
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

cargarConsolas("");*/
