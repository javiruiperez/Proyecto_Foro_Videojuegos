const cargarGeneros = async() =>{
	try{
	
		const generos= await fetch(`https://id.twitch.tv/oauth2/token?client_id=98ug9rutl1wpjdanyti97vxgss69k3&client_secret=v9e2wmjga7kq628q741yuhn832hgt0&grant_type=client_credentials`,{
                            method:'POST'});
	 
	console.log("meme");

   
	 
		if(generos.status===200){
			const datosgenero=await generos.json();
		console.log(datosgenero);
        console.log(datosgenero.token_type);
        console.log(datosgenero.access_token);
        const generos2= await fetch(`https://api.igdb.com/v4/games`,{
            method:'POST',
			
            headers:{
				'Access-Control-Allow-Origin':'https://api.igdb.com/v4/games',
                'Client-ID':'98ug9rutl1wpjdanyti97vxgss69k3',
                'Authorization':'Bearer'+datosgenero.access_token,
                'Body':'fields *;'
            }
        }
         
           );
		   const datosgenero2=await generos2.json();
           console.log(datosgenero2);
			
	}
	else if(respuesta.status===401){
		console.log("Pusistes la llave mal");
	}else if(respuesta.status===404){
		console.log("La pelicula que escogistes no existe");
	}else{
		console.log("Hubo un error paranormal");
	}
	
	}catch(error){
		console.log(error);
	}
	
	}
	cargarGeneros();

    //https://rapidapi.com/guides/fetch-api-async-await