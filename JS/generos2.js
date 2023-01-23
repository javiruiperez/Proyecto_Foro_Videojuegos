const cargarGeneros = async() =>{
try{

const options =await fetch( 'https://api.rawg.io/api/games?key=d22b44fd751e438f943040e82cf43c0e',{
    method:'GET'
}
);

if(options.status===200){
    const options2=await options.json();
    console.log(options2);
}

}catch(error){
    console.log(error);
}
}
cargarGeneros();