document.querySelector('form').addEventListener('submit', function(event){
    event.preventDefault();
    var genero = document.querySelector('select[name="genero"]').value;
    var ano = document.querySelector('select[name="ano"]').value;
    var idioma = document.querySelector('select[name="idioma"]').value;
    var searchTerm = document.querySelector('input[name="searchTerm"]').value;

    // Realizar la búsqueda
var results = [];

for (var i=0; i<movies.length; i++) {
  var movie = movies[i];

  // Verificar género
  if (genero && movie.genero !== genero) {
    continue;
  }

  // Verificar año
  if (ano && movie.ano !== ano) {
    continue;
  }

  // Verificar idioma
  if (idioma && movie.idioma !== idioma) {
    continue;
  }

  // Verificar término
  if (searchTerm && movie.title.indexOf(searchTerm) === -1) {
    continue;
  }

  // Agregar a los resultados
  results.push(movie);
}

alert('Buscando por: género=' + genero + ', año=' + ano + ', idioma=' + idioma + ', término=' + searchTerm);
});

console.log(results);