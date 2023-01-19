function filterRecentGames() {
    // Obtener todos los videojuegos de la base de datos
    const games = getGames(); 
    // Ordenar los videojuegos por fecha de lanzamiento
    const sortedGames = games.sort(function(a, b){
      return b.releaseDate - a.releaseDate;
    });
    // Mostrar los videojuegos en orden de mas reciente a mas antiguo
    displayGames(sortedGames);
  }
  
  // Esta función debe ejecutarse al cargar la página
  window.onload = filterRecentGames;

  

  function getScore() {
    //obtiene el número de comentarios de la base de datos
    let comments = db.get('comments');
    
    //multiplica el número de comentarios por 10 para obtener la puntuación actual
    let score = comments * 10;
    
    //actualiza la barra de progreso con la nueva puntuación
    let progressBar = document.querySelector('.progress-bar');
    progressBar.value = score;
    
    //si el usuario alcanza 50 puntos, actualiza su rango
    if(score >= 50) {
      db.update('user', { rank: 'Rango II' });
    }
  }