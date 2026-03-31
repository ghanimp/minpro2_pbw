<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Portfolio Ghanii</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'config.php';

$userQuery = "SELECT * FROM users LIMIT 1";
$userResult = mysqli_query($conn, $userQuery);
$user = mysqli_fetch_assoc($userResult);

$experiencesQuery = "SELECT * FROM experiences";
$experiencesResult = mysqli_query($conn, $experiencesQuery);

$skillsQuery = "SELECT * FROM skills";
$skillsResult = mysqli_query($conn, $skillsQuery);

$certificatesQuery = "SELECT * FROM certificates";
$certificatesResult = mysqli_query($conn, $certificatesQuery);
?>

<div id="app">

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark custom-nav">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Ghani</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#certificates">Certificates</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6 text-white">
                    <p class="text-info mb-2">Halo, Saya</p>
                    <h1 class="fw-bold display-4"><?php echo htmlspecialchars($user['name']); ?></h1>
                    <p class="lead"><?php echo htmlspecialchars($user['tagline']); ?></p>
                    <div class="mt-4">
                        <a href="#about" class="btn btn-info px-4 py-2">About Me</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <div class="photo-box">
                        <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" class="hero-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">About Me</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="glass-card p-4">
                        <p><?php echo nl2br(htmlspecialchars($user['about'])); ?></p>
                        <h5 class="mt-4">Experience</h5>
                        <ul>
                            <?php while($exp = mysqli_fetch_assoc($experiencesResult)): ?>
                                <li><?php echo htmlspecialchars($exp['experience_name']); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="glass-card p-4">
                        <h5>Skills</h5>
                        <?php
                        mysqli_data_seek($skillsResult, 0);
                        while($skill = mysqli_fetch_assoc($skillsResult)): 
                        ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span><?php echo htmlspecialchars($skill['skill_name']); ?></span>
                                    <span><?php echo $skill['skill_level']; ?>%</span>
                                </div>
                                <div class="progress modern-progress">
                                    <div class="progress-bar" style="width: <?php echo $skill['skill_level']; ?>%"></div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="certificates" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">Certificates</h2>
            <div class="row g-4">
                <?php 
                mysqli_data_seek($certificatesResult, 0);
                while($cert = mysqli_fetch_assoc($certificatesResult)): 
                ?>
                    <div class="col-md-4">
                        <div class="card modern-card h-100">
                            <img src="<?php echo htmlspecialchars($cert['image']); ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($cert['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($cert['description']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<script>
const { createApp } = Vue

createApp({
    data() {
        return {}
    }
}).mount('#app')
</script>

</body>
</html>

<?php
mysqli_close($conn);
?>