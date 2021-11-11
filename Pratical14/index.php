<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratical 14</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="task14.css">
</head>

<body>
    <div id="container" class="container-fluid"> </div>
    <script>
        let container = document.getElementById("container");
        let pageno = 1;
        const getdata = async() => {

            fetch(`https://api.themoviedb.org/3/movie/popular?api_key=2093daba66a27dc4a8b953700c36e805&language=en-US&page=${pageno}`)
                .then(response => response.json())
                .then(data => {
                    const {
                        results
                    } = data;

                    results && results.length > 0 && results.map((movieItem) => {

                        var defaultimgpath = "https://image.tmdb.org/t/p/original";
                        var title = movieItem.original_title;
                        if (title == '') {
                            title = movieItem.original_name;
                        }
                        var id = movieItem.id;
                        var image = movieItem.poster_path;
                        var overview = movieItem.overview;
                        var release_date = movieItem.release_date;
                        var moviepage = 'moviepage.php?id=' + id;

                        var div = document.createElement('div');
                        div.className = 'card';
                        div.innerHTML = `
                        <a href='${moviepage}'><img class="cardimg" src="${defaultimgpath + image}"></a>
                        <div class="card-body">
                        <h4 class="cardtitle" style="font-size:16px"><b>${title}</b></h4>   
                        <p class="moviedate">${release_date}</p>
                        </div>`;
                        container.appendChild(div);

                    })
                });
        }
        getdata();
        window.addEventListener('scroll', () => {
            const {
                scrollHeight,
                scrollTop,
                clientHeight
            } = document.documentElement;
            if (scrollTop + clientHeight >= scrollHeight) {
                console.log("bottom");
                pageno++;
                getdata();
            }
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>