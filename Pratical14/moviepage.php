<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="moviepage.css">
</head>

<body>
    <div class="container-fluid" id="main">
        <div class="container" id="container">
            <input type="hidden" id="movieid" value="<?php echo $_GET['id']; ?>">
        </div>
    </div>
    <script>
        var id = document.getElementById('movieid').value;
        var container = document.getElementById('container');
        var maincontainer = document.getElementById('main');

        fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=2093daba66a27dc4a8b953700c36e805&language=en-US`)
            .then(response => response.json())
            .then(data => {
                const results = data;

                var defaultimgpath = "https://image.tmdb.org/t/p/original";
                var image = results.poster_path;
                var title = results.original_title;
                var overview = results.overview;
                var backgroundimage = defaultimgpath + results.backdrop_path;
                maincontainer.style.background = 'linear-gradient(90deg, rgba(0,0,0,0.8267682072829132) 0%, rgba(0,0,0,0.8295693277310925) 100%), url(' + backgroundimage + ')';
                console.log('backgroundimage :>> ', backgroundimage);
                var genres = results.genres;
                data = [];
                genres.map((genres) => {
                    data.push(genres.name);
                })

                function timeConvert(n) {
                    var num = n;
                    var hours = (num / 60);
                    var rhours = Math.floor(hours);
                    var minutes = (hours - rhours) * 60;
                    var rminutes = Math.round(minutes);
                    return rhours + "h" + rminutes + "m";
                }
                console.log('object :>> ', timeConvert(results.runtime));
                var div = document.createElement('div');
                div.className = 'card';
                div.innerHTML = `
                <img src="${defaultimgpath + image}" class="card-img-top" />  
                <div class="card-title">                     
                    <h2 class="title">${title}</h2>
                    <div class="facts">
                        <span class="certification">UA</span>
                        <span class="release">&nbsp&nbsp${results.release_date} (IN)</span>
                        <span class="dot">&nbsp&nbsp&#8226</span>
                        <span class="geners">&nbsp${data.join(', ')}</span>
                        <span class="dot">&nbsp&nbsp&#8226</span>
                        <span class="runtime">&nbsp${timeConvert(results.runtime)}</span>
                    </div>
                    <h4 class="tagline">${results.tagline}</h4>
                    <h3 class="overview">Overview</h3>
                    <p class="text">${overview} </p>
                </div>`;
                container.appendChild(div);
            })
            </script>
</body>

</html>