<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
    <!-- Bootstrap CSS for general styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .gallery-item {
            flex: 1 1 200px;
            max-width: 200px;
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            display: block;
            border: 2px solid #ccc;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .gallery-item img:hover {
            transform: scale(1.05);
        }

        /* Lightbox styles */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 90%;
        }

        .lightbox:target {
            display: flex;
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2em;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Bootstrap Carousel -->
    <h1>Galleria Fotografica</h1>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            // Generate carousel indicators
            $imageDir = '../media/galleria/';
            $images = glob($imageDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
            foreach ($images as $index => $image) {
                echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $index . '" ';
                if ($index === 0) {
                    echo 'class="active"';
                }
                echo '></li>';
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            // Generate carousel items
            foreach ($images as $index => $image) {
                echo '<div class="carousel-item';
                if ($index === 0) {
                    echo ' active';
                }
                echo '">';
                echo '<img class="d-block w-100" src="' . $image . '" alt="Slide ' . ($index + 1) . '">';
                echo '</div>';
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    
    <section class="gallery">
        <?php
        // Display gallery items
        foreach ($images as $index => $image) {
            echo '<div class="gallery-item">';
            echo '<a href="#lightbox-' . $index . '"><img src="' . $image . '" alt="Gallery Image"></a>';
            echo '</div>';

            // Lightbox div
            echo '<div id="lightbox-' . $index . '" class="lightbox">';
            echo '<a href="#" class="lightbox-close">&times;</a>';
            echo '<img src="' . $image . '" alt="Gallery Image">';
            echo '</div>';
        }
        ?>
    </section>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
